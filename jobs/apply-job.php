<?php
session_start();
include '../includes/Database.php';
include '../includes/config.php';


$error = '';
$success = '';

$db = new Database();
$conn = $db->getConnection();

if (isset($_POST['job_id']) && isset($_POST['user_id'])) {
  $jobId = $_POST['job_id'];
  $employeeId = $_POST['user_id'];

  // Check if the employee has already applied for the job
  $sql = "SELECT * FROM applied_jobs WHERE employee_id = $employeeId AND job_id = $jobId";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
    $error = "You have already applied for this job.";
  } else {
    // Insert a new record into the applied_jobs table
    $sql = "INSERT INTO applied_jobs (employee_id, job_id, application_date) VALUES ($employeeId, $jobId, NOW())";
    if ($conn->query($sql) === TRUE) {
      $success = "success";
    } else {
      $error = "Error applying for job: " . $conn->error;
    }
  }
} else {
  $error = "Invalid request.";
}

// Retrieve the list of applied jobs for the current employee
$sql = "SELECT aj.application_date, aj.status, j.ID, j.job_title, j.responsibilities, j.salary FROM applied_jobs aj INNER JOIN jobs j ON aj.job_id = j.ID WHERE aj.employee_id = $employeeId";
$result = $conn->query($sql);
if ($result !== false) {
    while ($row = $result->fetch_assoc()) {
        $appliedJobs[] = $row;
    }
} else {
    echo "Error: " . $conn->error;
}
?>

<?php include '../includes/head.php'; ?>
<body style="background-image: linear-gradient(to right, #1f2766, #1f2766);">
<?php include '../includes/nav.php'; ?>

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

<!-- Applied Job List -->
<div class="jumbotron" style="margin-left: 0px;">

  <table class="table">
    <thead>
      <tr>
        <th class="tb-s">Sr. No.</th>
        <th class="tb-l">Job Title</th>
        <th class="tb-m">Application Date</th>
        <th class="tb-l">Responsiblity</th>
        <th class="tb-m">Salary</th>
        <th class="tb-s">Detail</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($appliedJobs as $job): ?>
        <tr>
          <td class="tb-s"><?= $job['ID']; ?></td>
          <td class="tb-l"><?= $job['job_title']; ?></td>
          <td class="tb-m"><?= $job['application_date']; ?></td>
          <td class="tb-l"><?= substr($job['responsibilities'], 0, 200); ?>...</td>
          <td class="tb-m"><?= $job['salary']; ?></td>
          <td class="tb-s"><center><a href="<?php echo JOBS_URL; ?>/detail.php?id=<?= urlencode($job['ID']); ?>" class="btn btn-primary">Detail</a></center></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
  <center><a href="<?php echo EMPLOYEE_URL; ?>/dashboard.php" class="btn btn-primary btn-lg">Go to Dashboard</a></center>
</div>

<?php include '../includes/foot.php'; ?>
</body>
</html>
