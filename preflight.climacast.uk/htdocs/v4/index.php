<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Introducing ClimaCast 4</title>
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Funnel+Display:wght@300..800&family=Poppins:wght@100..900&display=swap" rel="stylesheet" />
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
    <p><b>Your forecast. Your way.</b></p>
    <p>Coming for registered Beta Testers in June │ Coming to the Public later this Summer. </p>
    <a href="https://forms.gle/Nm6JoGyrvMeoNu7v5" id="beta-test-btn" target="_blank" rel="noopener">Start Testing</a>
  </header>

  <section>
    <h2 class="section-title">☁️ Reimagined Forecasts.</h2>
    <p class="feature">ClimaCast 4 builds on the technologies implemented into v3 to improve forecasts and make them more advanced and useful.</p>
    <p class="feature">You'll now see other statistics - like humidity, sunrise/sunset and wind speed - instead of just conditions and temperature.</p>
  </section>

  <section>
    <h2 class="section-title">✈️ Preflight, it's here.</h2>
    <p class="feature">ClimaCast Preflight has been successfully implemented into both the development, communication and testing of ClimaCast 4 and is an important part of v4's development.</p>
    <p class="feature">Preflight allows anybody to sign up and test new ClimaCast features which may be put into action in the future. Try it out by clicking "Start Testing" at the top of the page.</p>
  </section>

  <section>
    <h2 class="section-title">⚡ Personal, powerful.</h2>
    <p class="feature">ClimaCast 4 makes finding weather results more personal and powerful.</p>
    <p class="feature">We've taken a big step forward for ClimaCast by implementing Accounts. You can sign up for an account and use ClimaCast in a more personalised way.</p>
  </section>

  <section>
    <h2 class="section-title">⚠️ Improved Warnings.</h2>
    <p class="feature">We've made a lot of changes to warnings, since we wanted them to be more personalised to the user. You'll now recieve warnings for your area in your Dashboard.</p>
  </section>

	<section>
    <h2 class="section-title">📄 Safety Articles.</h2>
    <p class="feature">To benefit the new warning system, we've introduced and written Safety Articles. These contain information needed for each major warning subject. More will be added soon.</p>
  </section>

	<section>
    <h2 class="section-title">🔒 Privacy = Priority</h2>
    <p class="feature">Your data is always encrypted and stored securely when collected. Accounts are the only ClimaCast service needing personal information.</p>
  </section>
  

  <section style="text-align: center;">
    <h2 class="section-title">🌟 Join the Journey</h2>
    <p>Follow along as we build the future of weather awareness together.</p>
    <a href="https://climacast.uk/channel" class="cta">Join the WhatsApp Channel</a>
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
