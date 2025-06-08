<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Goodbye from CCast</title>
  <link href="https://fonts.googleapis.com/css2?family=Funnel+Display:wght@400;600;700&display=swap" rel="stylesheet">
  <style>
    body {
      margin: 0;
      font-family: 'Funnel Display', Tahoma, Geneva, Verdana, sans-serif;
      background: linear-gradient(135deg, #e0f2ff, #c9dfff);
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      color: #333;
    }

    .container {
      background: #fff;
      padding: 2rem 2.5rem;
      border-radius: 20px;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
      text-align: center;
      max-width: 420px;
      width: 100%;
    }

    h1 {
      font-size: 2rem;
      color: #1e40af;
      margin-bottom: 0.5rem;
    }

    p {
      font-size: 1rem;
      color: #555;
      margin-bottom: 1.5rem;
    }

    .buttons {
      display: flex;
      flex-direction: column;
      gap: 0.75rem;
    }

    .buttons a {
      text-decoration: none;
      padding: 0.75rem;
      border-radius: 8px;
      font-weight: 500;
      transition: background 0.3s ease;
    }

    .home {
      background-color: #1e40af;
      color: white;
    }

    .home:hover {
      background-color: #1a3699;
    }

    .feedback {
      background-color: #e5e7eb;
      color: #1f2937;
    }

    .feedback:hover {
      background-color: #d1d5db;
    }

    @media (min-width: 480px) {
      .buttons {
        flex-direction: row;
        justify-content: center;
      }

      .buttons a {
        flex: 1;
        text-align: center;
      }
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>Sorry to See You Go</h1>
    <p>Your CCast account has been successfully deleted. We're sad to see you leave.</p>
    <div class="buttons">
      <a href="/" class="home">Return to Homepage</a>
      <a href="/reportaproblem" class="feedback">Leave Feedback</a>
    </div>
  </div>
</body>
</html>
