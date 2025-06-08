<?php
$host = "sql306.infinityfree.com"; // Use "sqlXXX.epizy.com" if using InfinityFree
$dbname = "if0_36374751_account";
$username = "if0_36374751";
$password = "TpV31tgSYevLN";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>
<?php
$host = "sql306.infinityfree.com"; // Use "sqlXXX.epizy.com" if using InfinityFree
$dbname = "if0_36374751_account";
$username = "if0_36374751";
$password = "TpV31tgSYevLN";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>
