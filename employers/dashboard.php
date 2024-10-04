<?php
session_start();
include '../includes/Database.php';
include '../includes/config.php';

$error = '';
$success = '';

$db = new Database();
$conn = $db->getConnection();

$employer_id = $_SESSION['user_id'];


// Fetch employer profile information
$employer_query = "SELECT * FROM employers WHERE id = '$employer_id'";
$employer_result = mysqli_query($conn, $employer_query);
$employer_data = mysqli_fetch_assoc($employer_result);

// Fetch job postings
$job_query = "SELECT * FROM jobs WHERE employer_id = '$employer_id'";
$job_result = mysqli_query($conn, $job_query);
$job_data = array();
while ($row = mysqli_fetch_assoc($job_result)) {
    $job_data[] = $row;
}

//when employer posted job, it goes to the jobs.tb with status 1

// Fetch applications
$app_query = "SELECT * FROM applications WHERE employer_id = '$employer_id'";
$app_result = mysqli_query($conn, $app_query);
$app_data = array();
while ($row = mysqli_fetch_assoc($app_result)) {
    $app_data[] = $row;
}

// Close the database connection
mysqli_close($conn);

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
          <li>Number of applications received: <?php echo count($app_data); ?></li>
          <!-- Other overview metrics -->
      </ul>
  </section>
  <section class="job-postings">
      <h2>Job Postings</h2>
      <ul>
          <?php foreach ($job_data as $job) { ?>
              <li>
                  <h3><?php echo $job['job_title']; ?></h3>
                  <p><?php echo $job['job_description']; ?></p>
                  <p>Applications: <?php echo $job['num_applications']; ?></p>
              </li>
          <?php } ?>
      </ul>
  </section>
  <section class="applications">
      <h2>Applications</h2>
      <ul>
          <?php foreach ($app_data as $app) { ?>
              <li>
                  <h3><?php echo $app['applicant_name']; ?></h3>
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
