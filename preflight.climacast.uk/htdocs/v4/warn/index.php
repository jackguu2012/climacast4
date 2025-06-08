<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Important Notice</title>

  <!-- Import Funnel Display font from Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Funnel+Display:wght@400;700&display=swap" rel="stylesheet">

  <style>
    body {
      margin: 0;
      padding: 0;
      background-color: #fdf8f3;
      font-family: 'Funnel Display', sans-serif;
      color: #2c3e50;
    }

    .container {
      max-width: 860px;
      margin: 60px auto;
      background-color: #ffffff;
      border-radius: 10px;
      box-shadow: 0 10px 30px rgba(0,0,0,0.1);
      padding: 3rem;
      line-height: 1.6;
    }

    h1 {
      font-size: 2.8rem;
      text-align: center;
      color: #e74c3c;
      margin-bottom: 1.5rem;
    }

    .content {
      max-height: 320px;
      overflow-y: auto;
      background-color: #f8f9fa;
      padding: 1.5rem;
      border: 1px solid #ddd;
      border-radius: 6px;
      font-size: 1.05rem;
    }

    .checkbox-container {
      display: flex;
      align-items: center;
      margin-top: 1.8rem;
      font-size: 1rem;
    }

    input[type="checkbox"] {
      width: 18px;
      height: 18px;
      margin-right: 10px;
      cursor: pointer;
    }

    button {
      margin-top: 2rem;
      padding: 0.8rem 2rem;
      font-size: 1.1rem;
      background-color: #cccccc;
      border: none;
      border-radius: 6px;
      color: white;
      cursor: not-allowed;
      transition: background-color 0.3s ease;
    }

    button.enabled {
      background-color: #27ae60;
      cursor: pointer;
    }

    button.enabled:hover {
      background-color: #219150;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>Important Information</h1>
    <div class="content">
      <p>
        You're about to Beta Test ClimaCast v4, the upcoming version of ClimaCast.
        <br /><br />
        The website that you are about to visit isn't yet available to the public since it may not be stable. Only people that sign up as a beta tester are permitted to access this website. Please do not attempt to share the link with anyone.
        <br /><br />
        Security for accounts in Beta is not 100%. Never enter sensitive details until the Official version releases.
        <br /><br />
        By accessing the following website you are:
        <ul>
          <li>Agreeing not to distribute, copy, or misuse any resources provided.</li>
          <li>Acknowledging that actions taken on this platform are your own responsibility.</li>
          <li>Understanding potential data collection and how it's used.</li>
        </ul>
        If you do not agree, please close this window or exit the site.
      </p>
    </div>

    <div class="checkbox-container">
      <input type="checkbox" id="agreeCheckbox" />
      <label for="agreeCheckbox">I agree to the terms and conditions</label>
    </div>

    <button id="proceedBtn" disabled>Proceed</button>
  </div>

  <script>
    const checkbox = document.getElementById("agreeCheckbox");
    const button = document.getElementById("proceedBtn");

    checkbox.addEventListener("change", function () {
      if (checkbox.checked) {
        button.disabled = false;
        button.classList.add("enabled");
      } else {
        button.disabled = true;
        button.classList.remove("enabled");
      }
    });

    button.addEventListener("click", function () {
      window.location.href = "https://preflight.climacast.uk/v4/beta/index5719453.php"; // Update this URL
    });
  </script>
</body>
</html>
