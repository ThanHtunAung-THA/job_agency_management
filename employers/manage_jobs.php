<?php
session_start();
include '../includes/Database.php';
include '../includes/config.php';

$error = '';
$success = '';

$db = new Database();
$conn = $db->getConnection();

$employerId = $_SESSION['user_id'];



?>

<?php include '../includes/head.php'; ?>
<body style="background-image: linear-gradient(to right, #1f2766, #1f2766);">
<?php include '../includes/nav__employer.php'; ?>

<!-- content here -->
<?php if ($error || $success): ?>
  <div id="popup-message" class="popup-message-overlay">
    <div class="popup-message-box">
      <button id="close-popup" class="close-btn">&times;</button>
      <div class="popup-message-content">
        <?php if ($error): ?>
          <div class="error"><?= htmlspecialchars($error); ?></div>
        <?php elseif ($success): ?>
          <div class="success"><?= htmlspecialchars($success); ?></div>
        <?php endif; ?>
      </div>
    </div>
  </div>
<?php endif; ?>

<!-- manage job dashboard -->
<div class="container">
    <h2>Manage Job Listings</h2>
    <table class="table table-striped">
      <thead>
        <tr>
          <th>#</th>
          <th>Job Title</th>
          <th>Status</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($jobs as $job): ?>
        <tr>
          <td><?= $job['id'] ?></td>
          <td><?= $job['title'] ?></td>
          <td><?= $job['status'] ?></td>
          <td>
            <a href="edit_job.php?id=<?= $job['id'] ?>" class="btn btn-primary">Edit</a>
            <a href="delete_job.php?id=<?= $job['id'] ?>" class="btn btn-danger">Delete</a>
          </td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>

<?php include '../includes/foot.php'; ?>
</body>
</html>
