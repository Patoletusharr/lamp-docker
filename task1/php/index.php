<?php
$host = 'mysql';
$user = 'root';
$pass = 'rootpassword';
$dbname = 'test_db';

// Create connection
$conn = new mysqli($host, $user, $pass, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

echo "Hello, World! Your MySQL connection is successful.";
?>

