<?php
session_start();
include '../includes/Database.php';
include '../includes/config.php';

$error = '';
$success = '';

$db = new Database();
$conn = $db->getConnection();

$employer_id = $_SESSION['user_id'];

// Fetch job postings
$job_query = "SELECT * FROM jobs WHERE employer_id = '$employer_id'";
$job_result = mysqli_query($conn, $job_query);
$job_data = array();
while ($row = mysqli_fetch_assoc($job_result)) {
    $job_data[] = $row;
}

//when employer posted job, it goes to the jobs.tb with status 1

// Fetch applications
$applied_query = "SELECT aj.*, j.job_title, ee.username as employee_name
FROM applied_jobs aj 
JOIN jobs j ON aj.job_id = j.id 
JOIN employees ee ON ee.id = aj.employee_id
JOIN employers e ON j.employer_id = e.id 
WHERE e.id = '$employer_id'";

$applied_result = mysqli_query($conn, $applied_query);
$applied_data = array();
while ($row = mysqli_fetch_assoc($applied_result)) {
    $applied_data[] = $row;
}



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

<nav>

</nav>
<main>
  <section class="dashboard-overview">
      <h2>Dashboard Overview</h2>
      <ul>
          <li>Number of job postings: <?php echo count($job_data); ?></li>
          <li>Number of applications received: <?php echo count($applied_data); ?></li>
          <!-- Other overview metrics -->
      </ul>
  </section>
  <section class="job-postings">
      <h2>Job Postings</h2>
      <ul>
          <?php foreach ($job_data as $job) { ?>
              <li>
                  <h3><?php echo $job['job_title']; ?></h3>
                  <p><?php echo $job['job_desc']; ?></p>
                    <?php
                    // Count the number of applications for this job
                    $applicants_query = "SELECT COUNT(*) as applicant_count FROM applied_jobs WHERE job_id = '$job[id]'";
                    $applicants_result = mysqli_query($conn, $applicants_query);
                    $applicants_data = mysqli_fetch_assoc($applicants_result);
                    ?>
                  <p>Applications: <?php echo $applicants_data['applicant_count']; ?></p>
              </li>
          <?php } ?>
      </ul>
  </section>
  <section class="applications">
      <h2>Applications</h2>
      <ul>
          <?php foreach ($applied_data as $app) { ?>
              <li>
                  <h3><?php echo $app['employee_name']; ?></h3>
                  <p>Job Title: <?php echo $app['job_title']; ?></p>
                  <p>Status: <?php echo $app['status']; ?></p>
              </li>
          <?php } ?>
      </ul>
  </section>
  <!-- Other dashboard components -->
</main>

<?php include '../includes/foot.php'; ?>
</body>
</html>

<?php 
// Close the database connection
$db->close();
?>