<?php
// view_alert.php

$host = "sql306.infinityfree.com";
$db = "if0_36374751_account";
$user = "if0_36374751";
$pass = "TpV31tgSYevLN";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $id = $_GET['id'] ?? null;

    if (!$id) {
        echo "No alert specified.";
        exit;
    }

    $stmt = $pdo->prepare("SELECT * FROM weather_alerts WHERE id = ?");
    $stmt->execute([$id]);
    $alert = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$alert) {
        echo "Alert not found.";
        exit;
    }

} catch (PDOException $e) {
    echo "Database error: " . $e->getMessage();
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title><?= htmlspecialchars($alert['title']) ?> - ClimaCast Alert</title>

<link href="https://fonts.googleapis.com/css2?family=Funnel+Display:wght@300..800&display=swap" rel="stylesheet" />

<style>
    body {
        font-family: 'Funnel Display', sans-serif;
        background-color: #f7f7f7;
        margin: 0;
        padding: 20px;
        display: flex;
        justify-content: center;
        min-height: 100vh;
        box-sizing: border-box;
    }

    .container {
        background-color: white;
        padding: 40px 30px;
        border-radius: 21px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        max-width: 600px;
        width: 100%;
        position: relative;
        box-sizing: border-box;
    }

    .close-button {
        position: absolute;
        top: 20px;
        left: 20px;
        cursor: pointer;
        border: none;
        background: transparent;
        padding: 0;
    }

    .close-button img {
        width: 30px;
        height: 30px;
        display: block;
    }

    h1 {
        margin-top: 0;
        margin-bottom: 15px;
        font-weight: 700;
        font-size: 28px;
        color: #222;
        text-align: center;
    }

    .alert-box {
        border-radius: 21px;
        padding: 25px 30px;
        color: #222;
        text-align: left;
        box-sizing: border-box;
    }

    .red {
        border: 5px solid #db8c8c;
        background-color: #fdeaea;
    }

    .amber {
        border: 5px solid #ffa600;
        background-color: #fff3cd;
    }

    .yellow {
        border: 5px solid #fff200;
        background-color: #fffde7;
    }

    .section {
        margin-bottom: 20px;
    }

    .section p {
        margin: 6px 0;
        white-space: pre-wrap;
        word-break: break-word;
        line-height: 1.5;
        font-size: 16px;
    }

    .section h3 {
        margin-bottom: 8px;
        font-weight: 600;
        color: #444;
        font-size: 18px;
    }

    /* Responsive tweaks */
    @media (max-width: 480px) {
        body {
            padding: 15px;
        }

        .container {
            padding: 30px 20px;
            border-radius: 16px;
        }

        h1 {
            font-size: 22px;
            margin-bottom: 12px;
        }

        .alert-box {
            padding: 20px 22px;
        }

        .section p {
            font-size: 14px;
        }

        .section h3 {
            font-size: 16px;
        }

        .close-button img {
            width: 24px;
            height: 24px;
        }
    }
</style>
</head>
<body>

<div class="container">
    <a onclick="window.history.back()" class="close-button" aria-label="Go back">
        <img src="https://weather.climacast.uk/alerts/close.svg" alt="Close" />
    </a>

    <h1><?= htmlspecialchars($alert['title']) ?></h1>

    <div class="alert-box <?= strtolower($alert['severity']) ?>">
        <div class="section">
            <p><strong>Severity:</strong> <?= htmlspecialchars($alert['severity']) ?></p>
            <p><strong>Region Code:</strong> <?= htmlspecialchars($alert['region_code']) ?></p>
            <p><strong>Expires:</strong> <?= htmlspecialchars($alert['expires_at']) ?></p>
        </div>
        <div class="section">
            <h3>Full Message:</h3>
            <p><?= nl2br(htmlspecialchars($alert['message'])) ?></p>
        </div>
    </div>
</div>

</body>
</html>
