<?php

require_once 'config.php';

// VERY SIMPLE database connection for beginners

$host = "localhost";      // database server
$dbname = "agroscan_db";   // database name
$username = "root";        // database username (default for XAMPP)
$password = "";            // database password (empty for XAMPP)

try {
    // Connect to database
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    
    // Set error mode to exception so we can catch errors
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Optional: Uncomment next line to test if connection works
    // echo "Connected successfully!";
    
} catch(PDOException $e) {
    // If connection fails, show error and stop
    die("Connection failed: " . $e->getMessage());
}
?>