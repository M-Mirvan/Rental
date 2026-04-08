<?php
$host = 'localhost';
$db   = 'rental'; // <--- MAKE SURE THIS IS YOUR ACTUAL DATABASE NAME
$user = 'root';
$pass = ''; 
$charset = 'utf8mb4';

try {
    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
    $conn = new PDO($dsn, $user, $pass);
    
    // Set error mode so you can see what goes wrong
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    exit;
}
?>