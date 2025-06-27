<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Connect to database
$conn = new mysqli("localhost", "root", "Manish@123", "mycontactdb");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Sanitize and get email
$email = $_POST['email'] ?? '';

if (!empty($email)) {
    // Insert into DB
    $stmt = $conn->prepare("INSERT IGNORE INTO newsletter_emails (email) VALUES (?)");
    $stmt->bind_param("s", $email);

    if ($stmt->execute()) {
        // Send email
        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = $_ENV['MAIL_USERNAME'];
            $mail->Password   = $_ENV['MAIL_PASSWORD'];
            $mail->SMTPSecure = 'tls';
            $mail->Port       = 587;

            $mail->setFrom($_ENV['MAIL_USERNAME'], 'Travel Explorer');
            $mail->addAddress($email);
            $mail->Subject = 'Thanks for subscribing!';
            $mail->Body    = 'Welcome to our newsletter. Stay tuned for travel updates!';

            $mail->send();
            echo "Subscription successful. Email sent.";
        } catch (Exception $e) {
            echo "Subscription saved, but email failed: {$mail->ErrorInfo}";
        }
    } else {
        echo "Error saving subscription.";
    }

    $stmt->close();
} else {
    echo "Email is required.";
}

$conn->close();
?>


