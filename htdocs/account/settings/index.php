<?php
session_start();
require_once "db.php"; // Your DB connection file

$user_id = $_SESSION['user_id'] ?? null;
if (!$user_id) {
    header("Location: login.php");
    exit;
}

$success = $error = "";

$regions = [
    ["name" => "Scotland", "code" => "SCO"],
    ["name" => "North East", "code" => "NE"],
    ["name" => "North West", "code" => "NW"],
    ["name" => "Yorkshire", "code" => "YH"],
    ["name" => "West Midlands", "code" => "WM"],
    ["name" => "East Midlands", "code" => "EM"],
    ["name" => "South West", "code" => "SW"],
    ["name" => "South East", "code" => "SE"],
    ["name" => "London", "code" => "LON"],
    ["name" => "East England", "code" => "EE"],
    ["name" => "Wales", "code" => "WLS"],
    ["name" => "Northern Ireland", "code" => "NI"]
];

try {
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        if (isset($_POST["save_settings"])) {
            $new_name = trim($_POST["name"]);
            $new_region = $_POST["region_code"];
            $new_email = trim($_POST["email"]);

            if ($new_name && filter_var($new_email, FILTER_VALIDATE_EMAIL) && in_array($new_region, array_column($regions, 'code'))) {
                $stmt = $pdo->prepare("UPDATE users SET name = ?, region_code = ?, email = ? WHERE id = ?");
                $stmt->execute([$new_name, $new_region, $new_email, $user_id]);
                $success = "Settings updated successfully.";
            } else {
                $error = "Please fill in all fields correctly.";
            }
        } elseif (isset($_POST["delete_account"])) {
            $stmt = $pdo->prepare("DELETE FROM users WHERE id = ?");
            $stmt->execute([$user_id]);
            session_destroy();
            header("Location: https://climacast.uk/account/sorry");
            exit;
        }
    }

    $stmt = $pdo->prepare("SELECT name, region_code, email FROM users WHERE id = ?");
    $stmt->execute([$user_id]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    die("Database error: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Account Settings - ClimaCast</title>
<link rel="preconnect" href="https://fonts.googleapis.com" />
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
<link href="https://fonts.googleapis.com/css2?family=Funnel+Display:wght@300..800&display=swap" rel="stylesheet" />
<style>
  body {
    font-family: 'Funnel Display', sans-serif;
    max-width: 500px;
    margin: 40px auto;
    padding: 0 20px;
    background: #f9f9f9;
  }
  h1, h2 {
    color: #003947;
  }
  h2 {
    border-bottom: 1px solid #ddd;
    padding-bottom: 8px;
    margin-bottom: 20px;
  }
  form {
    background: #fff;
    padding: 25px 20px;
    border-radius: 15px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    margin-bottom: 30px;
  }
  label {
    display: block;
    margin: 12px 0 6px;
    font-weight: 600;
  }
  input[type="text"],
  input[type="email"],
  select {
    width: 100%;
    padding: 10px 12px;
    border-radius: 15px;
    border: 3px solid black;
    font-size: 15px;
    box-sizing: border-box;
  }
  button {
    background-color: rgb(175, 223, 255);
    border: 3px solid rgb(0, 57, 71);
    color: #003947;
    font-size: 16px;
    font-weight: 700;
    width: 100%;
    padding: 12px;
    border-radius: 15px;
    cursor: pointer;
    margin-top: 12px;
    transition: background-color 0.3s ease;
  }
  button:hover {
    background-color: rgb(135, 193, 235);
  }
  .danger-button {
    background-color: #e74c3c;
    border: none;
    color: white;
  }
  .danger-button:hover {
    background-color: #c0392b;
  }
  .success {
    color: green;
    font-weight: 700;
    margin-bottom: 20px;
    text-align: center;
  }
  .error {
    color: red;
    font-weight: 700;
    margin-bottom: 20px;
    text-align: center;
  }
  #back-arr {
    display: inline-block;
    margin-bottom: 25px;
    color: #007BFF;
    cursor: pointer;
    font-weight: 600;
    text-decoration: none;
  }
  #back-arr:hover {
    text-decoration: underline;
  }
</style>
</head>
<body>

<h1>Account Settings</h1>
<a href="https://climacast.uk/account/user_dashboard.php" id="back-arr">&larr; Back to dashboard</a>

<?php if ($success): ?>
  <p class="success"><?= htmlspecialchars($success) ?></p>
<?php elseif ($error): ?>
  <p class="error"><?= htmlspecialchars($error) ?></p>
<?php endif; ?>

<form method="POST" novalidate>
  <h2>Profile Info</h2>
  <input type="hidden" name="save_settings" value="1" />

  <label for="name">Name</label>
  <input type="text" id="name" name="name" required value="<?= htmlspecialchars($user['name']) ?>" />

  <label for="region_code">Region</label>
  <select id="region_code" name="region_code" required>
    <option value="" disabled>-- Select Region --</option>
    <?php foreach ($regions as $region): ?>
      <option value="<?= $region['code'] ?>" <?= ($user['region_code'] === $region['code']) ? 'selected' : '' ?>>
        <?= $region['name'] ?>
      </option>
    <?php endforeach; ?>
  </select>

  <label for="email">Email</label>
  <input type="email" id="email" name="email" required value="<?= htmlspecialchars($user['email']) ?>" />

  <button type="submit">Save Changes</button>
</form>

<form method="POST" onsubmit="return confirm('Are you sure you want to delete your account? This cannot be undone.');">
  <h2>Danger Zone</h2>
  <input type="hidden" name="delete_account" value="1" />
  <button type="submit" class="danger-button">Delete Account</button>
</form>

</body>
</html>
