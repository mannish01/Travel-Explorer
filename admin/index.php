<?php
session_start();

// Protect route
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit;
}

// Connect to DB
$conn = new mysqli("localhost", "root", "Manish@123", "mycontactdb");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get stats
$msg_result = $conn->query("SELECT COUNT(*) AS total FROM contact_messages");
$sub_result = $conn->query("SELECT COUNT(*) AS total FROM newsletter_emails");

$msg_count = $msg_result->fetch_assoc()['total'] ?? 0;
$sub_count = $sub_result->fetch_assoc()['total'] ?? 0;

$conn->close();
?>

<?php include('includes/header.php'); ?>

<h2 class="mb-4">Dashboard</h2>

<div class="row">
  <div class="col-md-6 mb-4">
    <div class="card border-primary shadow h-100">
      <div class="card-body">
        <h5 class="card-title">Total Contact Messages</h5>
        <p class="card-text fs-3 fw-bold text-primary"><?= $msg_count ?></p>
        <a href="messages.php" class="btn btn-outline-primary">View Messages</a>
      </div>
    </div>
  </div>

  <div class="col-md-6 mb-4">
    <div class="card border-success shadow h-100">
      <div class="card-body">
        <h5 class="card-title">Newsletter Subscribers</h5>
        <p class="card-text fs-3 fw-bold text-success"><?= $sub_count ?></p>
        <a href="subscribers.php" class="btn btn-outline-success">View Subscribers</a>
      </div>
    </div>
  </div>
</div>

<?php include('includes/footer.php'); ?>
