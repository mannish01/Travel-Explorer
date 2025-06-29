<?php
session_start();

// Hardcoded login credentials (you can upgrade this later to database-based login)
$admin_email = 'xyz@travel.com';
$admin_password = '12345';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    if ($email === $admin_email && $password === $admin_password) {
        $_SESSION['admin_logged_in'] = true;
        header("Location: index.php");
        exit;
    } else {
        $error = 'Invalid email or password.';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Admin Login - Travel Explorer</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  
</head>
<body class="bg-light">

<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-md-5">
      <div class="card shadow">
        <div class="card-body">
          <h3 class="card-title text-center mb-4 fs-1 fw-bold">Admin Login</h3>
          <?php if (!empty($error)): ?>
            <div class="alert alert-danger"><?= $error ?></div>
          <?php endif; ?>

          <form method="post">
            <div class="mb-3">
              <label for="email" class="form-label fs-5">Email</label>
              <input type="email" class="form-control" id="email" name="email" required placeholder="Enter email">
            </div>
            <div class="mb-3">
              <label for="password" class="form-label fs-5">Password</label>
              <input type="password" class="form-control" id="password" name="password" required placeholder="Enter password">
            </div>
            <button type="submit" class="btn btn-primary w-100">Login</button>
          </form>
        </div>
      </div>
      <p class="text-center mt-3 text-muted">Travel Explorer © <?= date('Y') ?></p>
    </div>
  </div>
</div>

</body>
</html>
