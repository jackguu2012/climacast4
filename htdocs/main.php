<?php
session_start();
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");

$loggedIn = isset($_SESSION['user_id']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="description" content="ClimaCast brings accurate preflight forecasts and safety information directly from our site." />
  <meta http-equiv="Cache-Control" content="no-store" />
  <meta http-equiv="Pragma" content="no-cache" />
  <meta http-equiv="Expires" content="0" />
  <title>ClimaCast - Home</title>
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Funnel+Display:wght@300..800&family=Sora:wght@100..800&display=swap" rel="stylesheet" />
  <script async src="https://www.googletagmanager.com/gtag/js?id=G-ECSR2KJCK2"></script>
  <style>
    body {
      background: #eff2fe;
      font-family: 'Funnel Display', sans-serif;
      margin: 0;
      padding: 0;
      text-align: center;
      display: flex;
      flex-direction: column;
      align-items: center;
    }
    header {
      display: flex;
      justify-content: center;
      align-items: center;
      position: relative;
      padding: 10px 20px;
      width: 100%;
    }
    .nav-center {
      display: flex;
      gap: 10px;
    }
    .nav-bar-btn {
      color: black;
      text-decoration: none;
      padding: 10px 20px;
      font-weight: bold;
      border-radius: 15px;
      transition: background-color 0.2s ease-in-out;
    }
    .nav-bar-btn:hover {
      background-color: #c9e1ff;
    }
    .account-wrapper, .login-wrapper {
      position: absolute;
      left: 30px;
    }
    #account-icon img {
      width: 35px;
      height: 35px;
    }

    #account-icon {
      background: none;
      border: none;
      font-size: 24px;
      cursor: pointer;
    }
    .account-dropdown {
      position: absolute;
      top: 45px;
      right: -45;
      background: white;
      border: 2px solid black;
      border-radius: 15px;
      display: none;
      flex-direction: column;
      z-index: 10;
    }
    .account-dropdown a {
      padding: 10px;
      margin: 3px;
      text-align: left;
      color: black;
      text-decoration: none;
      border-radius: 15px;
      border: 1px solid black;
    }
    .account-dropdown a:hover {
      background: #f0f0f0;
    }

    .main-web-content {
      display: flex;
      flex-direction: column;
      align-items: center;
      padding: 20px;
      width: 100%;
      max-width: 900px;
    }
    #title {
      font-size: 50px;
      color: #01233d;
      margin: 10px 0;
      font-weight: bold;
    }

    #btn-1 {
      border-radius: 15px 15px 5px 5px;
    }
    #btn-2 {
      border-radius: 5px 5px 15px 15px;
    }
    .art-1 {
      background: #dfe6f5;
      border-radius: 20px;
      margin: 20px;
      padding: 20px;
      max-width: 800px;
      width: 100%;
      display: flex;
      flex-direction: column;
      align-items: center;
      text-align: center;
    }
    .art-1 img {
      width: 150px;
      border-radius: 20px;
      margin-bottom: 10px;
    }
    .art-1 h1 {
      font-size: 30px;
    }
    .art-1 p {
      font-size: 18px;
    }
    .art-1 a, #search-btn {
      margin-top: 10px;
      padding: 10px 20px;
      background: #01233d;
      color: white;
      font-weight: bold;
      text-decoration: none;
      border-radius: 13px;
      transition: background-color 0.2s ease-in-out;
    }
    .art-1 a:hover, #search-btn:hover {
      background-color: #034c8c;
    }
    footer {
      background: #c9e1ff;
      padding: 15px;
      margin-top: 20px;
      font-size: 14px;
      font-weight: bold;
      width: 100%;
    }
    #img-season {
      width: 100%;
      max-width: 500px;
      border: 3px solid black;
      border-radius: 21px;
      margin: 20px 0 30px;
    }
    #search-in {
      height: 40px;
      border: 2px solid black;
      border-radius: 12px;
      width: 100%;
      max-width: 400px;
      font-size: 15px;
    }
    .search-div {
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    @media screen and (max-width: 768px) {
      .nav-bar-btn { font-size: 14px; }
      #title { font-size: 36px; }
      .art-1 h1 { font-size: 24px; }
      .art-1 p { font-size: 16px; }
    }
    @media screen and (max-width: 480px) {
      header {
        flex-direction: column;
        align-items: center;
      }
      .nav-center {
        flex-direction: column;
      }
      .nav-bar-btn {
        font-size: 14px;
        padding: 8px;
      }
      #title {
        font-size: 28px;
      }
      .art-1 h1 {
        font-size: 20px;
      }
      .art-1 p {
        font-size: 14px;
      }
      #search-in, #search-btn {
        width: 90%;
      }
    }

    /* Modal Styles */
    .modal-overlay {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(0, 0, 0, 0.6);
      display: none;
      justify-content: center;
      align-items: center;
      z-index: 9999;
    }

    .modal-content {
      background: white;
      border-radius: 20px;
      padding: 30px;
      max-width: 400px;
      text-align: center;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
      animation: popIn 0.3s ease-out;
    }

    .modal-content h2 {
      font-size: 24px;
      margin-bottom: 15px;
    }

    .modal-content p {
      font-size: 16px;
      margin-bottom: 20px;
    }

    #close-modal {
      padding: 10px 20px;
      background: #01233d;
      color: white;
      border: none;
      border-radius: 10px;
      cursor: pointer;
      font-weight: bold;
    }

    #close-modal:hover {
      background: #034c8c;
    }

    @keyframes popIn {
      from { transform: scale(0.8); opacity: 0; }
      to { transform: scale(1); opacity: 1; }
    }
  </style>
</head>
<body>
  <header>
    <div class="nav-center">
      <a class="nav-bar-btn" href="https://weather.climacast.uk">Weather</a>
      <a class="nav-bar-btn" href="https://climacast.uk/reportaproblem">Report a Problem</a>
    </div>

    <?php if ($loggedIn): ?>
      <div class="account-wrapper">
        <button id="account-icon"><img src="https://climacast.uk/account/account_icon.svg" alt="Account"></button>
        <div class="account-dropdown" id="account-dropdown">
          <a id="btn-1" href="https://climacast.uk/account/user_dashboard.php/">Dashboard</a>
          <a id="btn-2" href="https://climacast.uk/account/logout.php">Logout</a>
        </div>
      </div>
    <?php else: ?>
      <div class="login-wrapper">
        <a class="nav-bar-btn" href="https://climacast.uk/account/login.php">Log In</a>
      </div>
    <?php endif; ?>
  </header>

  <div class="main-web-content">
    <h1 id="title">Welcome to ClimaCast 4</h1>
    <img id="img-season" src="https://climacast.uk/source/home/spring2.jpg" alt="Looks like there's an issue. Try reloading the page." />

    <div class="search-div">
      <h1>Find a forecast...</h1>
      <input id="search-in" placeholder="Search here..." />
      <button id="search-btn" onclick="searchpreflight()">Search</button>
    </div>

    <div class="art-1">
      <h1>What's your weather?</h1>
      <p>Go to your dashboard to find out!</p>
      <a href="https://climacast.uk/account/user_dashboard.php">Dashboard</a>
    </div>
  </div>

  <!-- Modal HTML -->
  <div id="welcome-modal" class="modal-overlay">
    <div class="modal-content">
      <h2>Feedback</h2>
      <p>If you have a minute, could you possibly leave some feedback? It'd help us out a lot.</p>
      <button id="close-modal">Close</button>
      <a href="https://climacast.uk/reportaproblem">
        <button id="close-modal" href="https://climacast.uk/reportaproblem">Sure!</button>
      </a>
    </div>
  </div>

  <script>
    document.getElementById("search-in").addEventListener("keypress", e => {
      if (e.key === "Enter") searchpreflight();
    });

    function searchpreflight() {
      const city = document.getElementById("search-in").value.trim();
      if (city)
        location.href = `https://weather.climacast.uk/forecast/index.php?location=${encodeURIComponent(city)}`;
      else alert("Error: Cannot send empty requests. (400)");
    }

    const accountIcon = document.getElementById("account-icon");
    if (accountIcon) {
      accountIcon.addEventListener("click", () => {
        const dropdown = document.getElementById("account-dropdown");
        dropdown.style.display = dropdown.style.display === "flex" ? "none" : "flex";
      });
    }

    // Modal logic
    window.addEventListener("load", () => {
      if (!localStorage.getItem("3welcomeModalShown")) {
        document.getElementById("welcome-modal").style.display = "flex";
        localStorage.setItem("3welcomeModalShown", "true");
      }

      document.getElementById("close-modal").addEventListener("click", () => {
        document.getElementById("welcome-modal").style.display = "none";
      });
    });
  </script>
</body>
</html>
