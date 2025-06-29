<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit;
}

$conn = new mysqli("localhost", "root", "Manish@123", "mycontactdb");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$result = $conn->query("SELECT * FROM newsletter_emails ORDER BY id DESC");
?>

<?php include('includes/header.php'); ?>

<h2 class="mb-4">Newsletter Subscribers</h2>

<table class="table table-bordered table-hover">
  <thead class="table-dark">
    <tr>
      <th>ID</th>
      <th>Email</th>
      <th>Subscribed At</th>
      <th>Status</th>
      <th>Actions</th>
    </tr>
  </thead>
  <tbody>
    <?php while ($row = $result->fetch_assoc()): ?>
      <tr>
        <td><?= $row['id'] ?></td>
        <td><?= htmlspecialchars($row['email']) ?></td>
        <td><?= $row['subscribed_at'] ?></td>
        <td><?= ucfirst($row['status']) ?></td>
        <td>
          <?php if ($row['status'] === 'active'): ?>
            <a href="block_subscriber.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Block</a>
          <?php else: ?>
            <span class="text-muted">Blocked</span>
          <?php endif; ?>
          <a href="delete_subscriber.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Delete this subscriber?')">Delete</a>
        </td>
      </tr>
    <?php endwhile; ?>
  </tbody>
</table>

<?php include('includes/footer.php'); ?>
