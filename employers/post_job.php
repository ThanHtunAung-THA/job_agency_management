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
<?php include '../includes/header-employee.php'; ?>

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
    <h2>Post a New Job</h2>
    <form action="submit_job.php" method="post">
      <div class="form-group">
        <label for="jobTitle">Job Title</label>
        <input type="text" class="form-control" id="jobTitle" name="jobTitle" required>
      </div>
      <div class="form-group">
        <label for="jobDescription">Job Description</label>
        <textarea class="form-control" id="jobDescription" name="jobDescription" rows="4" required></textarea>
      </div>
      <div class="form-group">
        <label for="jobType">Job Type</label>
        <select class="form-control" id="jobType" name="jobType">
          <option>Full-Time</option>
          <option>Part-Time</option>
          <option>Contract</option>
        </select>
      </div>
      <button type="submit" class="btn btn-primary">Post Job</button>
    </form>
  </div>


<?php include '../includes/foot.php'; ?>
</body>
</html>
