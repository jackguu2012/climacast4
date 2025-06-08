<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Code Redirect</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f0f4f8;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
    }

    .form-container {
      background: #ffffff;
      padding: 2rem;
      border-radius: 8px;
      box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
      width: 100%;
      max-width: 400px;
      text-align: center;
    }

    input[type="text"] {
      padding: 0.5rem;
      font-size: 1rem;
      width: 80%;
      margin-bottom: 1rem;
      border: 1px solid #ccc;
      border-radius: 4px;
    }

    button {
      padding: 0.5rem 1.5rem;
      font-size: 1rem;
      color: #fff;
      background-color: #007BFF;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }

    button:hover {
      background-color: #0056b3;
    }

    .error {
      color: red;
      margin-top: 1rem;
    }
  </style>
</head>
<body>
  <div class="form-container">
    <h2>Enter Your 7-Digit Code</h2>
    <form id="codeForm">
      <input type="text" id="codeInput" maxlength="7" placeholder="e.g. aB1cDe2" required />
      <br />
      <button type="submit">Submit</button>
      <div id="errorMsg" class="error"></div>
    </form>
  </div>

<script>
  const codeToUrlMap = {
    "bX9zQp2": "https://preflight.climacast.uk/v4/warn",
    // Add more codes and URLs here
  };

  document.getElementById("codeForm").addEventListener("submit", function (e) {
    e.preventDefault();
    const code = document.getElementById("codeInput").value.trim();
    const errorMsg = document.getElementById("errorMsg");

    const redirectUrl = codeToUrlMap[code];
    if (redirectUrl) {
      window.location.href = redirectUrl;
    } else {
      errorMsg.textContent = "Invalid code. Please try again.";
    }
  });
</script>

</body>
</html>
