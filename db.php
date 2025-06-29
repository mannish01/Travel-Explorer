<?php
$host = 'localhost';
$user = 'root';
$password = 'Manish@123';  // ⬅️ Replace with your actual MySQL root password
$database = 'mycontactdb';          // ⬅️ Replace with your database name

// Create connection
$conn = new mysqli($host, $user, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
