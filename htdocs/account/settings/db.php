<?php
$host = "sql306.infinityfree.com"; // Your actual host
$dbname = "if0_36374751_account"; // Your actual database name
$user = "if0_36374751"; // Your actual username
$pass = "TpV31tgSYevLN"; // Your actual database password

try {
    // Create the PDO connection
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $user, $pass);
    // Set the PDO error mode to exception to catch errors
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // If there's an error, stop the script and display the error message
    die("Database error: " . $e->getMessage());
}
?>
