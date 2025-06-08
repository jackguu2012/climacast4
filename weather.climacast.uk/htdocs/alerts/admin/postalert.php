<?php
$host = "sql306.infinityfree.com";
$db = "if0_36374751_account";
$user = "if0_36374751";
$pass = "TpV31tgSYevLN";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $title = $_POST['title'];
        $message = $_POST['message'];
        $severity = $_POST['severity'];
        $expires_at = $_POST['expires_at'];
        $active = isset($_POST['active']) ? 1 : 0;
        $region_code = $_POST['region_code'];

        $stmt = $pdo->prepare("INSERT INTO weather_alerts (title, message, severity, expires_at, active, region_code) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([$title, $message, $severity, $expires_at, $active, $region_code]);

        $success = "Alert posted successfully!";
    }
} catch (PDOException $e) {
    $error = "Database error: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Post Weather Alert</title>
  <link href="https://fonts.googleapis.com/css2?family=Funnel+Display:wght@400;600;700&display=swap" rel="stylesheet" />
  <style>
    * {
      box-sizing: border-box;
    }
    body {
      font-family: 'Funnel Display', sans-serif;
      background-color: #f7f7f7;
      margin: 0;
      padding: 0;
      display: flex;
      justify-content: center;
      align-items: flex-start;
      min-height: 100vh;
    }

    .container {
      background: white;
      margin: 30px 20px;
      padding: 25px;
      border-radius: 16px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.05);
      width: 100%;
      max-width: 600px;
    }

    h1 {
      text-align: center;
      font-size: 28px;
      margin-bottom: 20px;
      color: #01233d;
    }

    .message {
      padding: 10px 15px;
      border-radius: 8px;
      margin-bottom: 20px;
      font-weight: 600;
    }

    .message.success {
      background-color: #e0f2f1;
      color: #00695c;
    }

    .message.error {
      background-color: #fdecea;
      color: #c62828;
    }

    form {
      display: flex;
      flex-direction: column;
    }

    label {
      margin: 8px 0 4px;
      font-size: 14px;
      color: #333;
    }

    input, textarea, select {
      padding: 12px;
      font-size: 15px;
      border: 1px solid #ccc;
      border-radius: 8px;
      margin-bottom: 16px;
      width: 100%;
    }

    button {
      padding: 12px;
      font-size: 16px;
      background-color: #01233d;
      color: white;
      border: none;
      border-radius: 8px;
      font-weight: 600;
      cursor: pointer;
      transition: background-color 0.3s ease-in-out;
    }

    button:hover {
      background-color: #034c8c;
    }

    @media (max-width: 480px) {
      .container {
        padding: 20px;
      }
      h1 {
        font-size: 22px;
      }
      input, textarea, select {
        font-size: 14px;
        padding: 10px;
      }
      button {
        font-size: 15px;
        padding: 10px;
      }
    }
  </style>
</head>
<body>

<div class="container">
  <h1>Post a New Weather Alert</h1>

  <?php if (isset($success)): ?>
    <div class="message success"><?= htmlspecialchars($success) ?></div>
  <?php elseif (isset($error)): ?>
    <div class="message error"><?= htmlspecialchars($error) ?></div>
  <?php endif; ?>

  <form method="POST" action="postalert.php">
    <label for="title">Alert Title:</label>
    <input type="text" name="title" id="title" required>

    <label for="message">Alert Message:</label>
    <textarea name="message" id="message" rows="5" required></textarea>

    <label for="severity">Severity:</label>
    <select name="severity" id="severity" required>
      <option value="Red">Red</option>
      <option value="Amber">Amber</option>
      <option value="Yellow">Yellow</option>
    </select>

    <label for="expires_at">Expiry Date & Time:</label>
    <input type="datetime-local" name="expires_at" id="expires_at" required>

    <label for="region_code">Region:</label>
    <select name="region_code" id="region_code" required>
      <option value="SCO">Scotland</option>
      <option value="NE">North East</option>
      <option value="NW">North West</option>
      <option value="YH">Yorkshire</option>
      <option value="WM">West Midlands</option>
      <option value="EM">East Midlands</option>
      <option value="SW">South West</option>
      <option value="SE">South East</option>
      <option value="LON">London</option>
      <option value="EE">East England</option>
      <option value="WLS">Wales</option>
      <option value="NI">Northern Ireland</option>
    </select>

    <label>
      <input type="checkbox" name="active" checked> Make alert active immediately
    </label>

    <button type="submit">Post Alert</button>
  </form>
</div>

</body>
</html>
