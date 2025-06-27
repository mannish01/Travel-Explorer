<?php

echo "<pre>";
print_r($_POST);
echo "</pre>";

error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database credentials
$host = "localhost";
$username = "root"; // or 'manish' if you set that
$password = "Manish@123";     // leave empty if there's no password
$database = "mycontactdb";

// Create connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$name = $_POST['name'] ?? '';
$email = $_POST['email'] ?? '';
$message = $_POST['message'] ?? '';

// Prepare SQL query
$sql = "INSERT INTO contact_messages (name, email, message) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $name, $email, $message);

// Execute
if ($stmt->execute()) {
    echo "Message sent successfully!";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
