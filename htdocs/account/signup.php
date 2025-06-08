<?php
$host = "sql306.infinityfree.com";
$db = "if0_36374751_account";
$user = "if0_36374751";
$pass = "TpV31tgSYevLN";

$error = "";
$name = $email = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    try {
        $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $name = trim($_POST["name"]);
        $email = trim($_POST["email"]);
        $password = $_POST["password"];
        $region_code = trim($_POST["region_code"]);

        if (empty($name) || empty($email) || empty($password)) {
            $error = "Please fill in all fields.";
        } else {
            $stmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE email = ?");
            $stmt->execute([$email]);

            if ($stmt->fetchColumn() > 0) {
                $error = "An account with this email already exists.";
            } else {
                $password_hash = password_hash($password, PASSWORD_DEFAULT);
                $stmt = $pdo->prepare("INSERT INTO users (name, email, password_hash, region_code) VALUES (?, ?, ?, ?)");
                $stmt->execute([$name, $email, $password_hash, $region_code]);
                header("Location: https://climacast.uk/account/login.php");
                exit;
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
  <meta charset="UTF-8">
  <meta http-equiv="Cache-Control" content="no-store">
  <meta http-equiv="Pragma" content="no-cache">
  <meta http-equiv="Expires" content="0">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign Up</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Funnel+Display:wght@300..800&family=Sora:wght@100..800&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Funnel Display', sans-serif;
      margin: 0;
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
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
    <h1>Create a ClimaCast account</h1>
    <p>If you do not allow location access, personalised alerts will be disabled.</p>

    <?php if (!empty($error)): ?>
      <div class="error"><?php echo htmlspecialchars($error); ?></div>
    <?php endif; ?>

    <form id="signupForm" method="POST" action="">
      <input type="text" name="name" required placeholder="Full Name" value="<?php echo htmlspecialchars($name); ?>">
      <input type="email" name="email" required placeholder="Email" value="<?php echo htmlspecialchars($email); ?>">
      <input type="password" name="password" required placeholder="Password">
      <input type="hidden" name="region_code" id="region_code">
      <button type="submit">Sign Up</button>
      <a href="https://climacast.uk/account/login.php">Already have an account? Log in</a>
    </form>
  </div>

  <script>
    const regions = [
      { name: "Scotland", code: "SCO", latMin: 55.0, latMax: 59.5, lonMin: -7.5, lonMax: -1.0 },
      { name: "North East", code: "NE", latMin: 54.5, latMax: 55.5, lonMin: -2.5, lonMax: -1.0 },
      { name: "North West", code: "NW", latMin: 53.0, latMax: 55.0, lonMin: -4.0, lonMax: -2.0 },
      { name: "Yorkshire", code: "YH", latMin: 53.5, latMax: 54.5, lonMin: -2.0, lonMax: -0.5 },
      { name: "West Midlands", code: "WM", latMin: 52.0, latMax: 53.5, lonMin: -3.0, lonMax: -1.0 },
      { name: "East Midlands", code: "EM", latMin: 52.0, latMax: 53.5, lonMin: -1.5, lonMax: 0.5 },
      { name: "South West", code: "SW", latMin: 50.2, latMax: 52.0, lonMin: -5.5, lonMax: -2.0 },
      { name: "South East", code: "SE", latMin: 50.5, latMax: 52.0, lonMin: -1.5, lonMax: 1.0 },
      { name: "London", code: "LON", latMin: 51.3, latMax: 51.7, lonMin: -0.5, lonMax: 0.2 },
      { name: "East England", code: "EE", latMin: 51.7, latMax: 53.0, lonMin: 0.0, lonMax: 1.5 },
      { name: "Wales", code: "WLS", latMin: 51.5, latMax: 53.5, lonMin: -5.5, lonMax: -2.5 },
      { name: "Northern Ireland", code: "NI", latMin: 54.0, latMax: 55.2, lonMin: -8.0, lonMax: -5.3 },
    ];

    document.getElementById('signupForm').addEventListener('submit', function (e) {
      e.preventDefault();

      navigator.geolocation.getCurrentPosition(position => {
        const { latitude, longitude } = position.coords;
        let regionCode = "UNKNOWN";

        for (const region of regions) {
          if (latitude >= region.latMin && latitude <= region.latMax &&
              longitude >= region.lonMin && longitude <= region.lonMax) {
            regionCode = region.code;
            break;
          }
        }

        document.getElementById("region_code").value = regionCode;
        this.submit();
      }, () => {
        document.getElementById("region_code").value = "UNKNOWN";
        this.submit();
      });
    });
  </script>
</body>
</html>
