<?php
session_start();
include '../includes/Database.php';
include '../includes/config.php';

$error = '';
$success = '';
$db = new Database();
$conn = $db->getConnection();
$employer_id = $_SESSION['user_id'];

$job_query = "SELECT * FROM jobs WHERE employer_id = '$employer_id'";
$job_result = mysqli_query($conn, $job_query);
$job_data = array();
while ($row = mysqli_fetch_assoc($job_result)) {
    $job_data[] = $row;
}

$db->close();
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
<div class="container-fluid">
    <h3 class="card-header bg-dark text-white">Manage Job Listings</h3>
    <table class="table jumbotron">
      <thead>
        <tr>
          <th>#</th>
          <th>Job Title</th>
          <th>Status</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($job_data as $job): ?>
        <tr>
          <td><?= $job['id'] ?></td>
          <td><?= $job['job_title'] ?></td>
          <td>
            <?php
              $status = $job['status'];
              if ($status == 0) {
                echo 'Closed';
              } elseif ($status == 1) {
                echo 'Pending';
              } elseif ($status == 2) {
                echo 'Open';
              }
            ?>
          </td>
          <td>
            <div class="row">
              <div class="col-md-4">
                <?php if ($status == 0) { ?>
                  <a href="activate_job.php?id=<?= $job['id'] ?>" class="btn btn-success" style="width: 100px;">Activate</a>
                <?php } elseif ($status == 1) { ?>
                  <a href="#" class="btn btn-primary disabled" aria-disabled="true" style="width: 100px;">Activate (Pending)</a>
                <?php } elseif ($status == 2) { ?>
                  <a href="deactivate_job.php?id=<?= $job['id'] ?>" class="btn btn-warning" style="width: 100px;">Deactivate</a>
                <?php } ?>
              </div>
              <div class="col-md-4">
                <center><a href="edit_job.php?id=<?= $job['id'] ?>" class="btn btn-primary" style="width: 100px;">Edit</a></center>
              </div>
              <div class="col-md-4">
                <a href="delete_job.php?id=<?= $job['id'] ?>" class="btn btn-danger" style="width: 100px; float:right;">Delete</a>
              </div>
            </div>
          </td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>

<?php include '../includes/foot.php'; ?>
</body>
</html>
