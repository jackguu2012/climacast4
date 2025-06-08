<?php

session_start();

// Database connection details
$host = "sql306.infinityfree.com";
$db = "if0_36374751_account";
$user = "if0_36374751";
$pass = "TpV31tgSYevLN";

// Create a connection to the database
$conn = new mysqli($host, $user, $pass, $db);

// Check if the connection is successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted and the POST data is set
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize and retrieve email and password from POST data
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $password = isset($_POST['password']) ? trim($_POST['password']) : '';

    // Check if the email and password are empty
    if (empty($email) || empty($password)) {
        echo "Email or password not provided.";
        exit();
    }

    // Prepare and execute the query to check the user
    $stmt = $conn->prepare("SELECT id, name, password_hash, region_code FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    // Check if the email exists in the database
    if ($stmt->num_rows === 1) {
        $stmt->bind_result($id, $name, $hashedPassword, $regionCode);
        $stmt->fetch();

        // Verify the password
        if (password_verify($password, $hashedPassword)) {
            // Password is correct, store session data
            $_SESSION['user_id'] = $id;
            $_SESSION['name'] = $name;
            $_SESSION['region_code'] = $regionCode;

            // Redirect to the dashboard
            header("Location: https://climacast.uk/main.php");
            exit();  // Stop further execution after redirection
        } else {
            // Incorrect password
            echo "Incorrect password. <a href='https://climacast.uk/account/login.html'>Go back</a>";
        }
    } else {
        // No account with that email
        echo "No account with that email. <a href='https://climacast.uk/account/login.html'>Go back</a>";
    }

    // Close the prepared statement
    $stmt->close();
} else {
    // Not a POST request, display the form
    echo "Invalid request.";
}

// Close the database connection
$conn->close();
?>
