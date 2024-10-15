<?php
session_start();
include '../includes/Database.php';
include '../includes/config.php';

$error = '';
$success = '';
$db = new Database();
$conn = $db->getConnection();
$employeeId = $_SESSION['user_id'];
// Retrieve the list of applied jobs for the current employee
$stmt = $conn->prepare("SELECT aj.application_date, aj.status, j.ID, j.job_title, j.responsibilities, j.salary FROM applied_jobs aj INNER JOIN jobs j ON aj.job_id = j.ID WHERE aj.employee_id = ?");
$stmt->bind_param("i", $employeeId);
$stmt->execute();
$result = $stmt->get_result();
$appliedJobs = array();
while ($row = $result->fetch_assoc()) {
  $appliedJobs[] = $row;
}
?>

<?php include '../components/head.php'; ?>
<body style="background-image: linear-gradient(to right, #1f2766, #1f2766);">
<?php include '../navbars/nav__employee.php'; ?>
<?php include '../components/$error_$success.php'; ?>

<!-- Applied Job List -->
<div class="jumbotron" style="margin-left: 0px;">
  <center><h2 class="text-primary"> -- Dashboard --</h2></center>
  <h4 class="text-primary">Applied Jobs</h4>
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
</div>

<?php include '../components/foot.php'; ?>
</body>
</html>
