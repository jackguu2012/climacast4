<?php
session_start();

// DB credentials
$host = "sql306.infinityfree.com";
$db = "if0_36374751_account";
$user = "if0_36374751";
$pass = "TpV31tgSYevLN";

$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    try {
        $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $email = trim($_POST["email"]);
        $password = $_POST["password"];

        if (empty($email) || empty($password)) {
            $error = "Please fill in all fields.";
        } else {
            $stmt = $pdo->prepare("SELECT id, name, password_hash FROM users WHERE email = ?");
            $stmt->execute([$email]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user && password_verify($password, $user['password_hash'])) {
                $_SESSION["user_id"] = $user["id"];
                $_SESSION["user_name"] = $user["name"];
                header("Location: https://climacast.uk/main.php");
                exit;
            } else {
                $error = "Invalid email or password.";
            }
        }
    } catch (PDOException $e) {
        $error = "Server error: " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta http-equiv="Cache-Control" content="no-store" />
  <meta http-equiv="Pragma" content="no-cache" />
  <meta http-equiv="Expires" content="0" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Login</title>
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Funnel+Display:wght@300..800&family=Sora:wght@100..800&display=swap" rel="stylesheet" />
  <style>
    body {
      font-family: 'Funnel Display', sans-serif;
      margin: 0;
      min-height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      background-color: #f2f2f2;
      padding: 20px;
    }

    .main-content {
      background: white;
      border-radius: 20px;
      padding: 30px 20px;
      max-width: 400px;
      width: 100%;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
      text-align: center;
    }

    h1 {
      font-size: 24px;
      margin-bottom: 10px;
    }

    p {
      font-size: 14px;
      color: #555;
      margin-bottom: 20px;
    }

    input {
      width: 100%;
      height: 40px;
      margin: 10px 0;
      padding: 0 10px;
      border-radius: 15px;
      border: 3px solid black;
      font-size: 14px;
      box-sizing: border-box;
    }

    button {
      border: 3px solid rgb(0, 57, 71);
      width: 100%;
      height: 40px;
      border-radius: 15px;
      background-color: rgb(175, 223, 255);
      font-size: 16px;
      margin-top: 10px;
      cursor: pointer;
    }

    button:hover {
      background-color: rgb(145, 200, 235);
    }

    .error {
      color: red;
      margin-bottom: 15px;
    }

    a {
      display: inline-block;
      margin-top: 15px;
      color: #007BFF;
      text-decoration: none;
      font-size: 14px;
    }

    a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>
  <div class="main-content">
    <h1>Login to ClimaCast</h1>
    <p>Enter your email and password to access your account.</p>

    <?php if (!empty($error)): ?>
      <div class="error"><?php echo htmlspecialchars($error); ?></div>
    <?php endif; ?>

    <form method="POST" action="">
      <input type="email" name="email" required placeholder="Email" value="<?php echo isset($email) ? htmlspecialchars($email) : ''; ?>" />
      <input type="password" name="password" required placeholder="Password" />
      <button type="submit">Log In</button>
      <a href="https://climacast.uk/account/signup.php">Don't have an account? Sign up here.</a>
    </form>
  </div>
</body>
</html>
