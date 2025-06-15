<?php
session_start();

$host = "sql306.infinityfree.com";
$db = "if0_36374751_account";
$user = "if0_36374751";
$pass = "TpV31tgSYevLN";



if (!isset($_SESSION['user_id'])) {
    header("Location: https://climacast.uk/status/error/400/401.html");
    exit;
}

$user_id = $_SESSION['user_id'];

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $pdo->prepare("SELECT name, region_code FROM users WHERE id = ?");
    $stmt->execute([$user_id]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user || !isset($user['region_code'])) {
        echo "Unable to determine your location.";
        exit;
    }

    $user_region = $user['region_code'];

    $stmt = $pdo->prepare("SELECT * FROM weather_alerts WHERE active = 1 AND NOW() < expires_at AND region_code = ? ORDER BY expires_at ASC");
    $stmt->execute([$user_region]);
    $alerts = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    echo "Database error: " . $e->getMessage();
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Dashboard</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Funnel+Display:wght@300..800&display=swap" rel="stylesheet">
  <style>
    body {
        font-family: 'Funnel Display', sans-serif;
        background-color: #f7f7f7;
        padding: 20px;
        margin: 0;
        text-align: center;
    }

    h1 {
        color: #333;
        font-size: 24px;
    }

    .alert,
    .weather-box,
    .fallback-style {
        width: 100%;
        max-width: 600px;
        margin: 20px auto;
        padding: 20px;
        border-radius: 21px;
        box-sizing: border-box;
        text-align: left;
    }

    .alert.red { background-color: #db8c8c; }
    .alert.amber { background-color: #ffa600; }
    .alert.yellow { background-color: #fff200; }

    .alert h2 {
        margin: 0;
        font-size: 16px;
        color: #000;
    }

    .alert p {
        margin: 5px 0;
        font-size: 14px;
        color: #000;
    }

.first-user-badge {
  width: 80px;
  height: 80px;
  border: 2px solid #333;
  border-radius: 50%;
  display: flex;
  justify-content: center;
  align-items: center;
  margin: 20px auto;
  background-color: #fff;
  color: #333;
  font-size: 10px;
  font-weight: bold;
  position: relative;
  box-shadow: 0 0 6px rgba(0,0,0,0.2);
}

.circle-text {
  text-align: center;
  width: 100%;
  line-height: 1.1;
  padding: 8px;
}



    .alert a {
        display: inline-block;
        margin-top: 10px;
        padding: 5px 10px;
        background-color: white;
        color: black;
        text-decoration: none;
        border-radius: 8px;
        transition: background-color 0.2s;
        border: 2px solid black;
    }

    .alert a:hover {
        background-color: #c7c7c7;
    }

    .fallback-style {
        background-color: #33a444;
        border: 3.5px solid rgb(1, 98, 38);
        color: white;
    }

    .weather-box {
        background-color: #add8ff;
        border: 3.5px solid #002d57;
        color: #333;
    }

    #loading {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 70px;
        flex-direction: column;
    }

    .spinner {
        width: 50px;
        height: 50px;
        border: 6px solid #f3f3f3;
        border-top: 6px solid #4CAF50;
        border-radius: 50%;
        animation: spin 1s linear infinite;
        margin-bottom: 10px;
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

    .account-container {
        position: fixed;
        top: 15px;
        left: 15px;
        text-align: left;
        display: inline-block;
        z-index: 1000;
    }

    #account-icon {
        width: 30px;
        cursor: pointer;
    }

    .dropdown-menu {
        display: none;
        position: absolute;
        top: 45px;
        left: 0;
        background-color: white;
        border: 2px solid black;
        border-radius: 15px;
        width: 160px;
        z-index: 1000;
        text-align: left;
        padding: 10px;
    }

    .dropdown-menu a {
        display: block;
        padding: 10px 15px;
        text-decoration: none;
        color: black;
        transition: background-color 0.2s;
        margin-bottom: 5px;
        border: 1.5px solid black;
        font-size: 14px;
    }

    .dropdown-menu a:hover {
        background-color: #f1f1f1;
    }

    #anc-1 { border-radius: 15px 15px 3px 3px; }
    #anc-2 { border-radius: 3px; }
    #anc-3 { border-radius: 3px 3px 15px 15px; }

    @media (max-width: 600px) {
        h1 {
            font-size: 20px;
        }

        .alert p,
        .weather-box p {
            font-size: 13px;
        }

        .dropdown-menu a {
            font-size: 13px;
            padding: 8px 12px;
        }

        #account-icon {
            width: 28px;
        }
    }
  </style>
</head>
<body>

<!-- Account Dropdown -->
<div class="account-container">
  <img src="https://climacast.uk/account/account_icon.svg" id="account-icon" alt="Account Icon">
  <div class="dropdown-menu" id="dropdown-menu">
    <a id="anc-1" href="/account/settings">Settings</a>
    <a id="anc-2" href="/account/logout.php">Log Out</a>
    <a id="anc-3" href="/main.php">Back Home</a>
  </div>
</div>

<h1>Welcome, <?= htmlspecialchars($user['name']) ?>.</h1>

<?php if ($user['name'] === 'Sharron Hazel Hambelton'): ?>
  <div class="first-user-badge">
    <span class="circle-text">First User ❤️</span>
  </div>
<?php endif; ?>




<!-- Weather -->
<div id="weather">
  <div id="loading">
    <div class="spinner"></div>
    <h3>Loading your weather info...</h3>
  </div>
</div>

<!-- Alerts -->
<?php if ($alerts): ?>
  <?php foreach ($alerts as $alert): ?>
    <?php $severityClass = strtolower($alert['severity']); ?>
    <div class="alert <?= $severityClass ?>">
      <h2><?= htmlspecialchars($alert['title']) ?></h2>
      <p><strong>Severity:</strong> <?= htmlspecialchars($alert['severity']) ?></p>
      <p><strong>Expires at:</strong> <?= htmlspecialchars($alert['expires_at']) ?></p>
      <a href="https://weather.climacast.uk/alerts/view_alert.php?id=<?= $alert['id'] ?>">View Full Alert</a>
    </div>
  <?php endforeach; ?>
<?php else: ?>
  <div class="fallback-style">
    <h3>No severe weather alerts</h3>
    <?php if (strtolower($user_region) === 'unknown'): ?>
      <p>Location unavailable, change manually in settings.</p>
    <?php else: ?>
      <p>All is well :)</p>
    <?php endif; ?>
  </div>
<?php endif; ?>


<script>
const weatherBox = document.getElementById("weather");

function displayWeather(data) {
    if (!data || !data.main) {
        weatherBox.innerHTML = "<p>Unable to fetch weather data.</p>";
        return;
    }

    weatherBox.innerHTML = `
        <div class="weather-box">
            <h2>Current weather in: ${data.name}</h2>
            <p><strong>${data.weather[0].main}</strong> - ${data.weather[0].description}</p>
            <p>🌡️ Temp: <strong>${Math.round(data.main.temp)}</strong>°C</p>
            <p>💧 Humidity: <strong>${data.main.humidity}</strong>%</p>
            <p>🌬️ Wind: <strong>${Math.round(data.wind.speed * 2.237 * 10) / 10}</strong> mph</p>
        </div>
    `;
}

function fetchWeather(lat, lon) {
    const apiKey = "bd6108ff1e9f7b330f95463b07e60836";
    const url = `https://api.openweathermap.org/data/2.5/weather?lat=${lat}&lon=${lon}&appid=${apiKey}&units=metric`;

    fetch(url)
        .then(response => response.json())
        .then(data => displayWeather(data))
        .catch(err => {
            console.error(err);
            weatherBox.innerHTML = "<p>Failed to load weather data.</p>";
        });
}

function getLocationAndWeather() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(
            position => {
                const { latitude, longitude } = position.coords;
                fetchWeather(latitude, longitude);
            },
            error => {
                console.error(error);
                weatherBox.innerHTML = "<p>Location permission denied. Weather unavailable.</p>";
            }
        );
    } else {
        weatherBox.innerHTML = "<p>Geolocation not supported by this browser.</p>";
    }
}

getLocationAndWeather();

const icon = document.getElementById('account-icon');
const menu = document.getElementById('dropdown-menu');

icon.addEventListener('click', () => {
    menu.style.display = (menu.style.display === 'block') ? 'none' : 'block';
});

window.addEventListener('click', (e) => {
    if (!document.querySelector('.account-container').contains(e.target)) {
        menu.style.display = 'none';
    }
});
</script>

</body>
</html>
