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

<div class="container">
    <h2>Manage Applications</h2>
    <table class="table table-striped">
      <thead>
        <tr>
          <th>#</th>
          <th>Applicant</th>
          <th>Job Title</th>
          <th>Status</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($applications as $app): ?>
        <tr>
          <td><?= $app['id'] ?></td>
          <td><?= $app['applicant'] ?></td>
          <td><?= $app['job_title'] ?></td>
          <td><?= $app['status'] ?></td>
          <td>
            <a href="view_application.php?id=<?= $app['id'] ?>" class="btn btn-info">View</a>
            <a href="reject_application.php?id=<?= $app['id'] ?>" class="btn btn-danger">Reject</a>
          </td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>

<?php include '../includes/foot.php'; ?>
</body>
</html>
