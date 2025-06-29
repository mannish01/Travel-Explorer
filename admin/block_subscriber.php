<?php
include('../db.php');
$id = $_GET['id'];
$conn->query("UPDATE newsletter_emails SET status = 'blocked' WHERE id = $id");
header("Location: subscribers.php");
?>
