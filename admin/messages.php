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

$result = $conn->query("SELECT * FROM contact_messages ORDER BY id DESC");
?>

<?php include('includes/header.php'); ?>

<h2 class="mb-4">Contact Messages</h2>

<table class="table table-bordered table-hover my-5">
  <thead class="table-dark">
    <tr>
      <th>ID</th>
      <th>Name</th>
      <th>Email</th>
      <th>Message</th>
      <th>Submitted At</th>
    </tr>
  </thead>
  <tbody>
    <?php while ($row = $result->fetch_assoc()): ?>
      <tr>
        <td><?= $row['id'] ?></td>
        <td><?= htmlspecialchars($row['name']) ?></td>
        <td><?= htmlspecialchars($row['email']) ?></td>
        <td><?= nl2br(htmlspecialchars($row['message'])) ?></td>
        <td><?= $row['created_at'] ?></td>
      </tr>
    <?php endwhile; ?>
  </tbody>
</table>

<?php include('includes/footer.php'); ?>
