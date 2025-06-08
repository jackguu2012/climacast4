<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Funnel+Display:wght@300..800&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
  <title>Introducing ClimaCast 4</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }
    body {
      font-family: 'Funnel Display', sans-serif;
      background: #0e0e2c;
      color: white;
      overflow-x: hidden;
    }
    header {
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      flex-direction: column;
      text-align: center;
      background: radial-gradient(circle, #1a1a40 0%, #0e0e2c 100%);
    }
    header h1 {
      font-size: 3rem;
      animation: slideIn 1s ease-out forwards;
      opacity: 0;
    }
    header p {
      font-size: 1.2rem;
      margin-top: 1rem;
      color: #aaa;
      animation: fadeIn 2s ease forwards;
      opacity: 0;
    }
    section {
      padding: 4rem 2rem;
      max-width: 1000px;
      margin: auto;
    }
    .section-title {
      font-size: 2rem;
      margin-bottom: 1rem;
    }
    .feature {
      margin-bottom: 1rem;
      opacity: 0;
      transform: translateY(40px);
      transition: all 0.6s ease;
    }
    .feature.visible {
      opacity: 1;
      transform: translateY(0);
    }
    .timeline-item {
      border-left: 2px solid #555;
      padding-left: 1rem;
      margin-bottom: 1rem;
      position: relative;
    }
    .cta {
      background: #00aaff;
      color: white;
      padding: 1rem 2rem;
      border-radius: 8px;
      font-weight: bold;
      display: inline-block;
      text-decoration: none;
      margin-top: 2rem;
      transition: transform 0.2s ease;
      animation: pulse 2s infinite;
    }
    .cta:hover {
      transform: scale(1.05);
    }

    #beta-test-btn {
        text-decoration: none;
        color: white;
        margin-top: 90px;
        padding: 10px;
        border-radius: 15px;
        border: 3px solid white;
    }

    @keyframes slideIn {
      from { transform: translateY(50px); opacity: 0; }
      to { transform: translateY(0); opacity: 1; }
    }

    @keyframes fadeIn {
      from { opacity: 0; }
      to { opacity: 1; }
    }

    @keyframes pulse {
      0%, 100% { transform: scale(1); }
      50% { transform: scale(1.05); }
    }
  </style>
</head>
<body>
  <header>
    <h1>Introducing ClimaCast 4</h1>
    <p>Your forecast. Your way. - Expected this summer.</p>
    <a href="https://forms.gle/Nm6JoGyrvMeoNu7v5" id="beta-test-btn">Start Testing</a>
  </header>

  <section>
    <h2 class="section-title">🚀 What's New?</h2>
    <div class="feature">✔ User accounts & personal dashboards</div>
    <div class="feature">✔ UK-wide weather warnings</div>
    <div class="feature">✔ Updated weather forecast page</div>
  </section>

  <section>
    <h2 class="section-title">📅 Our progress</h2>
    <div class="timeline-item"><strong style="color: green">Done </strong><strong>4.0.1(d)</strong> — First developer release of v4, including most of the account pages.</div>
    <div class="timeline-item"><strong style="color: green">Done </strong><strong>4.0.2(d)</strong> — Reimagining weather alerts.</div>
    <div class="timeline-item"><strong style="color: green">Done </strong><strong>4.0.3(d)</strong> — Developing ClimaCast Preflight, our web app for Testing our products.</div>
    <div class="timeline-item"><strong style="color: green">Done </strong><strong>4.0.4(d)</strong> — Integrating WeatherAPI into User Dashboards. More dashboard visual improvements.</div>
    <div class="timeline-item"><strong style="color: green">Done </strong><strong>4.0.5(d)</strong> — Making page improvments related to accounts.</div>
    <div class="timeline-item"><strong style="color: green">Done </strong><strong>4.0.6(d)</strong> — Geolocation in the forecast page and improvements to generic forecasts.</div>
    <div class="timeline-item"><strong style="color: green">Done </strong><strong>4.0.7(d)</strong> — Making weather warnings a standalone page and linking to WarnAPI.</div>
    <div class="timeline-item"><strong style="color: green">Done </strong><strong>4.0.8(d)</strong> — Working on feedback and reporting systems.</div>
    <div class="timeline-item"><strong style="color: green">Done </strong><strong>4.0.9(d)</strong> — Working on Permenant Articles with safety information during severe weather.</div>
    <div class="timeline-item"><strong style="color: green">Done </strong><strong>4.0.10(d)</strong> — Accessibility improvements.</div>
    <br>
    <div class="timeline-item"><strong style="color: yellow">In progress </strong><strong>4.0alpha-1</strong> — Alpha testing phase begins.</div>
    <div class="timeline-item"><strong>4.0alpha-2+</strong> — Bug fix package(s) release.</div>
    <br>
    <div class="timeline-item"><strong>4.0beta-1</strong> — Public testing phase begins.</div>
    <div class="timeline-item"><strong>4.0beta-2+</strong> — Bug fix package(s) release. Take main site offline for RC.</div>
    <br>
    <div class="timeline-item"><strong>4.0RC-1</strong> — Divert links back to main domain. </div>
    <div class="timeline-item"><strong>4.0RC-2</strong> — The Ready-for-Release version of v4. (Release Candidate).</div>
    <br>
    <div class="timeline-item"><strong>4.0</strong> — Released to public on main domain.</div>
    <div class="timeline-item"><p style="color: rgb(169, 169, 169);">This timeline is still very much in development, things are subject to change.</p></div>
  </section>

  <section style="text-align: center">
    <h2 class="section-title">🌟 Join the Journey</h2>
    <p>Follow along as we build the future of weather awareness together.</p>
    <a href="#" class="cta">Join the WhatsApp Channel</a>
  </section>

  <script>
    const features = document.querySelectorAll('.feature');
    const observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.classList.add('visible');
        }
      });
    }, { threshold: 0.1 });

    features.forEach(feature => {
      observer.observe(feature);
    });
  </script>
</body>
</html>
