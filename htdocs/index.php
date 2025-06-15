<?php
session_start();
$loggedIn = isset($_SESSION['user']); 

if (isset($_SESSION['user_id'])) {
    header("Location: /main.php");
    exit;
}
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
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag() { dataLayer.push(arguments); }
    gtag('js', new Date());
    gtag('config', 'G-ECSR2KJCK2');
  </script>
  <style>
    body {
      background: #eff2fe;
      font-family: 'Funnel Display', sans-serif;
      margin: 0; padding: 0;
      text-align: center;
      display: flex;
      flex-direction: column;
      align-items: center;
    }
    header {
      display: flex;
      justify-content: center;
      align-items: center;
      flex-wrap: wrap;
      width: 100%;
      padding: 10px;
      position: relative;
    }
    .nav-bar-btn {
      color: black;
      text-decoration: none;
      padding: 12px 25px;
      margin: 12px 8px;
      font-weight: bold;
      border-radius: 18px;
      transition: background-color 0.2s ease-in-out;
    }
    .nav-bar-btn:hover {
      background-color: #c9e1ff;
    }
    #logo { width: 120px; margin: 12px auto; }
    .main-web-content {
      display: flex; flex-direction: column;
      align-items: center; padding: 20px;
      width: 100%; max-width: 900px;
    }
    #title {
      font-size: 70px; color: #01233d;
      margin: 20px 0; font-weight: bold;
    }
    #subtitle {
        color: grey;
        font-size: 40px;
    }
    .art-1 {
      background: #dfe6f5;
      border-radius: 20px;
      margin: 30px; padding: 30px;
      max-width: 800px; width: 100%;
      display: flex; flex-direction: column;
      align-items: center; text-align: center;
    }
    .art-1 img {
      width: 200px; border-radius: 20px;
      margin-bottom: 20px;
    }
    .art-1 h1 { font-size: 34px; }
    .art-1 p { font-size: 22px; margin-bottom: 20px; }
    .art-1 a, #search-btn {
      margin-top: 15px;
      padding: 12px 25px;
      background: #01233d;
      color: white; font-weight: bold;
      text-decoration: none;
      border-radius: 13px;
      transition: background-color 0.2s ease-in-out;
    }
    .art-1 a:hover, #search-btn:hover {
      background-color: #034c8c;
    }
    footer {
      background: #c9e1ff;
      padding: 15px; margin-top: 30px;
      font-size: 14px; font-weight: bold;
      width: 100%;
    }
    #img-season {
      width: 100%; max-width: 600px;
      border: 3px solid black;
      border-radius: 21px;
      margin: 30px 0;
    }
    #search-in {
      height: 45px;
      border: 2px solid black;
      border-radius: 12px;
      width: 100%; max-width: 450px;
      font-size: 16px;
    }
    .search-div {
      display: flex; flex-direction: column;
      align-items: center;
    }
    .account-wrapper {
      position: relative;
      margin-left: 10px;
    }
    #account-icon {
      background: none;
      border: none;
      font-size: 26px;
      cursor: pointer;
    }
    .account-dropdown {
      position: absolute;
      top: 35px;
      right: 0;
      background: white;
      border: 1px solid #ccc;
      border-radius: 8px;
      display: none;
      flex-direction: column;
      z-index: 10;
    }
    .account-dropdown a {
      padding: 12px;
      text-align: left;
      color: black;
    }
    .account-dropdown a:hover {
      background: #f0f0f0;
    }

    @media screen and (max-width: 768px) {
      .nav-bar-btn { font-size: 14px; }
      #title { font-size: 46px; }
      .art-1 h1 { font-size: 28px; }
      .art-1 p { font-size: 18px; }
    }
    @media screen and (max-width: 480px) {
      .nav-bar-btn { font-size: 12px; padding: 8px; border-radius: 10px; }
      #title { font-size: 36px; }
      .art-1 h1 { font-size: 24px; }
      .art-1 p { font-size: 16px; }
      #search-in, #search-btn { width: 90%; }
    }
  </style>
</head>
<body>
  <header>

      <a class="nav-bar-btn" href="https://climacast.uk/account/login.php">Log In</a>
      <a class="nav-bar-btn" href="https://climacast.uk/main.php">Continue without an account</a>

  </header>

  <div class="main-web-content">
    <h1 id="title">Personal, powerful weather insights</h1>
    <div class="art-1">
      <h1>Discover ClimaCast</h1>
      <p>Sign up and start using ClimaCast today!</p>
    </div>
  <script>
    document.getElementById("search-in").addEventListener("keypress", e => {
      if (e.key === "Enter") searchpreflight();
    });

    function searchpreflight() {
      const city = document.getElementById("search-in").value.trim();
      if (city)
        location.href = `https://preflight.climacast.uk/forecast/?location=${encodeURIComponent(city)}`;
      else alert("Error: Cannot send empty requests. (400)");
    }

    const accountIcon = document.getElementById("account-icon");
    if (accountIcon) {
      accountIcon.addEventListener("click", () => {
        const dropdown = document.getElementById("account-dropdown");
        dropdown.style.display = dropdown.style.display === "flex" ? "none" : "flex";
      });
    }
  </script>
</body>
</html>
