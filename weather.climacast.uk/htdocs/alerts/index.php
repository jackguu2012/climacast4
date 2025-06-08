<?php
$host = "sql306.infinityfree.com";
$db = "if0_36374751_account";
$user = "if0_36374751";
$pass = "TpV31tgSYevLN";

$regionNames = [
    "SCO" => "Scotland", "NE" => "North East", "NW" => "North West", "YH" => "Yorkshire",
    "WM" => "West Midlands", "EM" => "East Midlands", "SW" => "South West", "SE" => "South East",
    "LON" => "London", "EE" => "East England", "WLS" => "Wales", "NI" => "Northern Ireland"
];

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $pdo->query("SELECT * FROM weather_alerts ORDER BY 
        FIELD(severity, 'Red', 'Amber', 'Yellow'), 
        created_at DESC");
    $alerts = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Database error: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>UK Weather Alerts</title>
<link href="https://fonts.googleapis.com/css2?family=Funnel+Display:wght@400;600;700&display=swap" rel="stylesheet">
<style>
  body {
    margin: 0;
    padding: 20px;
    font-family: 'Funnel Display', sans-serif;
    background-color: #f5f5f5;
    color: #333;
  }
  h1 {
    text-align: center;
    font-weight: 700;
    font-size: 36px;
    color: #01233d;
    margin-bottom: 30px;
  }
  .alert {
    background: white;
    border-left: 10px solid #ccc;
    padding: 18px 20px;
    margin-bottom: 20px;
    border-radius: 8px;
    box-shadow: 0 2px 6px rgba(0,0,0,0.05);
  }
  .alert.red { border-left-color: #DD877E; }
  .alert.amber { border-left-color: #FAAB00; }
  .alert.yellow { border-left-color: #EFFF00; }
  .alert h2 {
    font-size: 20px;
    margin: 0 0 10px;
    color: #01233d;
  }
  .alert p {
    margin: 0 0 10px;
    line-height: 1.5;
  }
  .meta {
    font-size: 14px;
    color: #666;
    margin-bottom: 10px;
  }
  .view-link {
    text-decoration: none;
    color: #0366d6;
    font-weight: 600;
  }
  .view-link:hover {
    text-decoration: underline;
  }
</style>
</head>
<body>
<h1>Current Weather Alerts</h1>
<?php foreach ($alerts as $alert):
  $severity = strtolower($alert['severity']);
  $region = $regionNames[$alert['region_code']] ?? $alert['region_code'];
  $id = htmlspecialchars($alert['id']);
  $fullMessage = htmlspecialchars($alert['message']);
  $preview = mb_strimwidth($fullMessage, 0, 30, "...");
?>
<div class="alert <?= $severity ?>">
  <h2><?= htmlspecialchars($alert['title']) ?></h2>
  <p><?= nl2br($preview) ?></p>
  <div class="meta">Region: <?= htmlspecialchars($region) ?> | Expires: <?= htmlspecialchars($alert['expires_at']) ?></div>
  <a class="view-link" href="https://weather.climacast.uk/alerts/view_alert.php?id=<?= $id ?>">View More</a>
</div>
<?php endforeach; ?>
</body>
</html>
