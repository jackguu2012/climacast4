<?php
// DB credentials
$host = "sql306.infinityfree.com";
$db = "if0_36374751_account";
$user = "if0_36374751";
$pass = "TpV31tgSYevLN";

// Initialize error message
$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    try {
        $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Collect and sanitize inputs
        $name = trim($_POST["name"]);
        $email = trim($_POST["email"]);
        $password = $_POST["password"];
        $region_code = trim($_POST["region_code"]);

        // Basic validation
        if (empty($name) || empty($email) || empty($password) || empty($region_code)) {
            $error = "Please fill in all fields.";
        } else {
            // Check for duplicate email
            $stmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE email = ?");
            $stmt->execute([$email]);
            if ($stmt->fetchColumn() > 0) {
                $error = "An account with this email already exists.";
            } else {
                // Hash and insert
                $password_hash = password_hash($password, PASSWORD_DEFAULT);
                $stmt = $pdo->prepare("INSERT INTO users (name, email, password_hash, region_code) VALUES (?, ?, ?, ?)");
                $stmt->execute([$name, $email, $password_hash, $region_code]);

                // Redirect on success
                header("Location: https://climacast.uk/account/login.html");
                exit;
            }
        }
    } catch (PDOException $e) {
        $error = "Database error: " . $e->getMessage();
    }
}
?>
