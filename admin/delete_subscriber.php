<?php
include('../db.php');
$id = $_GET['id'];
$conn->query("DELETE FROM newsletter_emails WHERE id = $id");
header("Location: subscribers.php");
?>
