<?php
session_start();

$host = "sql306.infinityfree.com";
$db = "if0_36374751_account";
$user = "if0_36374751";
$pass = "TpV31tgSYevLN";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ClimaCast Forecast</title>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Funnel+Display&display=swap');

    * {
      box-sizing: border-box;
    }
    body {
      font-family: 'Funnel Display', sans-serif;
      margin: 0;
      padding: 0;
      background: linear-gradient(135deg, #0f2027, #203a43, #2c5364);
      background-attachment: fixed;
      color: #222;
      min-height: 100vh;
    }
    .container {
      max-width: 1200px;
      margin: auto;
      padding: 2rem 1rem;
    }
    .header {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      background: rgba(255, 255, 255, 0.1);
      backdrop-filter: blur(10px);
      color: white;
      padding: 1rem;
      text-align: left;
      z-index: 1000;
    }
    .header button {
      background: rgba(255, 255, 255, 0.2);
      border: none;
      padding: 0.5rem 1.5rem;
      border-radius: 10px;
      color: white;
      cursor: pointer;
      font-size: 1rem;
    }
    h1 {
      font-size: 2.8rem;
      text-align: center;
      margin: 4rem 0 2rem 0;
      color: #fff;
      text-shadow: 1px 1px 4px rgba(0,0,0,0.4);
      position: relative;
    }
    .warning {
      position: absolute;
      top: -20px;
      right: -25px;
      font-size: 2.5rem;
      animation: pulse 1.2s infinite;
      color: red;
    }
    @keyframes pulse {
      0% { transform: scale(1); opacity: 1; }
      50% { transform: scale(1.3); opacity: 0.6; }
      100% { transform: scale(1); opacity: 1; }
    }
    .search-bar {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 10px;
      margin-bottom: 2rem;
    }
    input[type="text"] {
      padding: 0.75rem;
      font-size: 1rem;
      border-radius: 10px;
      border: none;
      width: 260px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.15);
    }
    button {
      padding: 0.75rem 1.5rem;
      font-size: 1rem;
      border: none;
      border-radius: 10px;
      background: #38bdf8;
      color: white;
      cursor: pointer;
      transition: all 0.3s ease-in-out;
    }
    button:hover {
      background: #0284c7;
    }
    .card {
      background: rgba(255, 255, 255, 0.9);
      border-radius: 18px;
      box-shadow: 0 8px 30px rgba(0,0,0,0.1);
      padding: 2rem;
      margin-bottom: 2.5rem;
    }
    .weather-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
      gap: 2rem;
      text-align: center;
    }
    .forecast-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
      gap: 1.5rem;
      margin-top: 1.5rem;
    }
    .forecast-item {
      background: #cffafe;
      border-radius: 14px;
      padding: 1.2rem;
      text-align: center;
      transition: transform 0.3s;
    }
    .forecast-item:hover {
      transform: translateY(-6px);
    }
    .forecast-item strong {
      display: block;
      margin-bottom: 0.5rem;
      color: #0c4a6e;
    }
    .icon {
      display: block;
      margin: 0 auto 0.5rem;
      width: 60px;
    }
    .sun-times {
      margin-top: 1rem;
      display: flex;
      justify-content: space-around;
      font-size: 1rem;
      color: #333;
    }
    #graph {
      max-width: 400px;
      height: 160px;
      margin: 2rem auto 0 auto;
      display: block;
    }
    @media (max-width: 600px) {
      h1 {
        font-size: 2.2rem;
      }
      input[type="text"], button {
        width: 100%;
      }
      .sun-times {
        flex-direction: column;
        align-items: center;
        gap: 0.5rem;
      }
    }
  </style>
</head>
<body>
  <div class="header">
    <a href="https://weather.climacast.uk/">
      <button>Back</button>
    </a>
  </div>
  <div id="root" class="container"></div>
  <canvas id="graph"></canvas>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script>
    const apiKey = '30bad5af0334b4ee038affadcf9c44c1';
    const root = document.getElementById('root');
    const urlParams = new URLSearchParams(window.location.search);
    const initialCity = urlParams.get('location') || 'New York';
    const state = {
      city: initialCity,
      weather: null,
      forecast: [],
      pollution: null
    };

    function fetchWeather() {
      const city = state.city;
      fetch(`https://api.openweathermap.org/data/2.5/weather?q=${city}&appid=${apiKey}&units=metric`)
        .then(r => r.json())
        .then(weather => {
          state.weather = weather;
          return Promise.all([
            fetch(`https://api.openweathermap.org/data/2.5/forecast?q=${city}&appid=${apiKey}&units=metric`).then(r => r.json()),
            fetch(`https://api.openweathermap.org/data/2.5/air_pollution?lat=${weather.coord.lat}&lon=${weather.coord.lon}&appid=${apiKey}`).then(r => r.json())
          ]);
        })
        .then(([forecast, pollution]) => {
          state.forecast = forecast.list.filter((_, i) => i % 8 === 0);
          state.pollution = pollution.list[0];
          render();
          renderChart();
        })
        .catch(err => {
          alert('Error fetching weather data.');
          console.error(err);
        });
    }

    function handleInput(e) {
      state.city = e.target.value;
    }

    function formatTime(ts) {
      return new Date(ts * 1000).toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
    }

    function render() {
      const { city, weather, forecast, pollution } = state;

      root.innerHTML = `
        <h1>🌤️ ClimaCast Forecast <a href="https://weather.climacast.uk/warnings"><span class="warning"></span></a></h1>
        <div class="search-bar">
          <input type="text" value="${city}" placeholder="Enter city name" oninput="handleInput(event)">
          <button onclick="fetchWeather()">Search</button>
        </div>

        ${weather ? `
          <div class="card">
            <div class="weather-grid">
              <div><strong>Location</strong><div>${weather.name}</div></div>
              <div><strong>Temperature</strong><div>${Math.round(weather.main.temp)}°C</div></div>
              <div><strong>Humidity</strong><div>${weather.main.humidity}%</div></div>
              <div><strong>Wind</strong><div>${Math.round(weather.wind.speed * 2.237)} mph</div></div>
            </div>
            <div class="sun-times">
              <div>🌅 Sunrise: ${formatTime(weather.sys.sunrise)}</div>
              <div>🌇 Sunset: ${formatTime(weather.sys.sunset)}</div>
            </div>
          </div>` : ''}

        ${forecast.length ? `
          <div class="card">
            <h2>5-Day Forecast</h2>
            <div class="forecast-grid">
              ${forecast.map(item => `
                <div class="forecast-item">
                  <strong>${new Date(item.dt_txt).toLocaleDateString()}</strong>
                  <img class="icon" src="https://openweathermap.org/img/wn/${item.weather[0].icon}@2x.png" alt="${item.weather[0].description}" />
                  <div>${item.main.temp.toFixed(1)}°C</div>
                  <div>${item.weather[0].main}</div>
                </div>
              `).join('')}
            </div>
          </div>` : ''}
      `;
    }

    function renderChart() {
      const ctx = document.getElementById('graph').getContext('2d');
      const labels = state.forecast.map(item => new Date(item.dt_txt).toLocaleDateString());
      const temps = state.forecast.map(item => item.main.temp);

      if (window.weatherChart) window.weatherChart.destroy();

      window.weatherChart = new Chart(ctx, {
        type: 'line',
        data: {
          labels: labels,
          datasets: [
            {
              label: 'Temperature (°C)',
              data: temps,
              fill: true,
              borderColor: '#f87171',
              backgroundColor: 'rgba(248, 113, 113, 0.2)',
              tension: 0.4
            }
          ]
        },
        options: {
          responsive: true,
          plugins: {
            legend: { position: 'top' },
            title: { display: true, text: 'Temperature Trend (Daily)' }
          }
        }
      });
    }

    window.handleInput = handleInput;
    window.fetchWeather = fetchWeather;

    fetchWeather();
  </script>
</body>
</html>