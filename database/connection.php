
<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);

// This part looks for 'Environment Variables' on a real server.
// If it doesn't find them (like on your laptop), it uses the "?? 'fallback'" values.
$host     = getenv('DB_HOST')     ?? 'localhost';
$dbname   = getenv('DB_NAME')     ?? 'rental';
$username = getenv('DB_USER')     ?? 'root';
$password = getenv('DB_PASS')     ?? ''; // Keep empty for XAMPP

try {
    $conn = new PDO(
        "mysql:host=$host;dbname=$dbname;charset=utf8mb4",
        $username,
        $password
    );
    
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Connected successfully!"; // Uncomment to test
    
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
