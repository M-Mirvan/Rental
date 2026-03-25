
<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);

$username = "root";
$password = "";

try {
    $conn = new PDO(
        "mysql:host=localhost;dbname=rental;charset=utf8mb4",
        $username,
        $password
    );
    
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>