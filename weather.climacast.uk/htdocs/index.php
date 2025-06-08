<!DOCTYPE html>
<html lang="en">
<head>
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-ECSR2KJCK2"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-ECSR2KJCK2');
</script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="ClimaCast - Your trusted source for accurate weather updates and forecasts.">
    <meta http-equiv="Cache-Control" content="no-store">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Funnel+Display:wght@300..800&family=Sora:wght@100..800&display=swap" rel="stylesheet">
    <title>ClimaCast - Weather Updates</title>
    <style>
        body {
            background-color: #eff2fe;
            font-family: 'Funnel Display', sans-serif;
            margin: 0;
            padding: 0;
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center; /* Center align items */
        }

        header {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-wrap: wrap;
            width: 100%;
            padding: 10px;
        }

        .nav-bar-btn {
            color: black;
            text-decoration: none;
            padding: 10px 20px;
            display: inline-block;
            margin: 10px 5px;
            font-weight: bold;
            transition: background-color 0.2s ease-in-out;
            border-radius: 15px;
        }

        .main-web-content {
            display: flex;
            flex-direction: column;
            justify-content: center;
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
            padding-bottom: 30px;
        }

        .search-div {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        #search-in {
            height: 40px;
            border: 2px solid black;
            border-radius: 12px;
            width: 100%;
            max-width: 400px;
            font-size: 15px;
            padding: 5px; /* Added padding for better input appearance */
        }

        #search-btn {
            margin-top: 10px;
            padding: 10px 20px;
            background-color: #01233d;
            color: white;
            text-decoration: none;
            border-radius: 13px;
            font-weight: bold;
            transition: background-color 0.2s ease-in-out;
        }

        #search-btn:hover {
            background-color: #034c8c;
        }

        .article-container {
            background-color: #dfe6f5;
            border-radius: 20px;
            padding: 20px;
            margin: 20px;
            width: 100%;
            max-width: 800px;
            text-align: center;
        }

        .article-container h1 {
            font-size: 30px;
        }

        .article-container p {
            font-size: 18px;
        }

        .article-container a {
            display: inline-block;
            margin-top: 10px;
            padding: 10px 20px;
            background-color: #01233d;
            color: white;
            text-decoration: none;
            border-radius: 13px;
            font-weight: bold;
        }

        footer {
            background-color: #c9e1ff;
            padding: 15px;
            font-size: 14px;
            font-weight: bold;
            width: 100%;
            text-align: center;
        }

        /* Responsive Styles */
        @media screen and (max-width: 768px) {
            #title {
                font-size: 36px; /* Reduced title size for tablets */
            }

            .article-container h1 {
                font-size: 24px; /* Adjusted article title size */
            }

            .article-container p {
                font-size: 16px; /* Adjusted article paragraph size */
            }

            #search-in {
                max-width: 90%; /* Increased input width on smaller screens */
            }

            #search-btn {
                width: 90%; /* Full-width button on smaller screens */
            }
        }

        @media screen and (max-width: 480px) {
            #title {
                font-size: 28px; /* Further reduced title size for mobile */
            }

            .nav-bar-btn {
                font-size: 12px; /* Reduced button font size */
                padding: 8px; /* Reduced padding for buttons */
            }

            .article-container h1 {
                font-size: 20px; /* Further adjusted article title size */
            }

            .article-container p {
                font-size: 14px; /* Further adjusted article paragraph size */
            }

            #search-in {
                width: 90%; /* Input width adjustment */
            }

            #search-btn {
                width: 90%; /* Button width adjustment */
            }
        }
    </style>
</head>
<body>
    <header>
        <a class="nav-bar-btn" href="https://climacast.uk/main.php">Home</a>
        <a class="nav-bar-btn" href="https://weather.climacast.uk/forecast/">Forecast</a>
        <a class="nav-bar-btn" href="https://weather.climacast.uk/articles/">Articles</a>
        <a class="nav-bar-btn" href="https://weather.climacast.uk/alerts/">Alerts</a>
    </header>

    <div class="main-web-content">
        <h1 id="title">Weather</h1>

        <div class="search-div">
            <h1>Find a forecast...</h1>
            <input id="search-in" placeholder="Search here...">
            <button id="search-btn" onclick="searchWeather()">Search</button>
        </div>

        <div class="article-container">
            <h1>Latest Articles</h1>
            <p>Read our in-depth weather articles to always be ahead of the storm.</p>
            <a href="https://weather.climacast.uk/articles/">Read More</a>
        </div>
    </div>

    <script>
        function searchWeather() {
            let city = document.getElementById("search-in").value.trim();
            if (city) {
                window.location.href = `https://weather.climacast.uk/forecast?location=${encodeURIComponent(city)}`;
            } else {
                alert("Error: Cannot send empty requests. (400)");
            }
        }
    </script>
</body>
</html>
