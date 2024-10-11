<?php
session_start();
include '../includes/Database.php';
include '../includes/config.php';

$error = '';
$success = '';

$db = new Database();
$conn = $db->getConnection();
$employer_Id = $_SESSION['user_id'];
$employer_Name = $_SESSION['user_name'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $jobTitle = $_POST['jobTitle'];
  $jobDesc = $_POST['job_Desc'];
  $responsibilities = $_POST['responsibilities'];
  $experience = $_POST['experience'];
  $skills = $_POST['skills'];
  $requirements = $_POST['requirements'];
  $salary = $_POST['salary'];
  $job_location = $_POST['job_location'];
  $status = 1; //pending state

  $query = "INSERT INTO jobs (job_title, job_desc, responsibilities, experience, skills, requirements, salary, job_location, employer, employer_id, status)
         VALUES ('$jobTitle', '$jobDesc', '$responsibilities', '$experience', '$skills', '$requirements', '$salary', '$job_location', '$employer_Name', '$employer_Id', $status)";

  if ($conn->query($query) === TRUE) {
    $success = "Job posted successfully!";
  } else {
    $error = "Error posting job: " . $conn->error;
  }
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

<div class="container card bg-dark">
    <h3 class="card-header  text-white">Post a New Job</h3>
    <form action="" method="post" class="mb-5">
      <div class="form-group card-header  text-white">
        <label for="jobTitle">Job Title</label>
        <input type="text" class="form-control" id="jobTitle" name="jobTitle" required>
      </div>
      <div class="form-group card-header  text-white">
        <label for="job_Desc">Job Description</label>
        <textarea class="form-control" id="job_Desc" name="job_Desc" rows="5"></textarea>
      </div>
      <div class="form-group card-header  text-white">
        <label for="responsibilities">Job responsibilities</label>
        <textarea class="form-control" id="responsibilities" name="responsibilities" rows="5"></textarea>
      </div>
      <div class="form-group card-header  text-white">
        <label for="experience">Experience</label>
        <textarea class="form-control" id="experience" name="experience" rows="5"></textarea>
      </div>
      <div class="form-group card-header  text-white">
        <label for="skills">Your prefered skills</label>
        <textarea class="form-control" id="skills" name="skills" rows="5"></textarea>
      </div>
      <div class="form-group card-header  text-white">
        <label for="requirements">Your prefered requirements</label>
        <textarea class="form-control" id="requirements" name="requirements" rows="5"></textarea>
      </div>
      <div class="form-group card-header  text-white">
        <label for="salary">Range of salary</label>
        <input type="text" class="form-control" id="salary" name="salary" required>
      </div>
      <div class="form-group card-header  text-white">
        <label for="job_location">Job location</label>
        <textarea class="form-control" id="job_location" name="job_location" rows="5"></textarea>
      </div>
      <div class="form-group card-header text-white">
        <button type="submit" class="btn btn-primary btn-jobs mt-2">Create Job</button>
      </div>
    </form>
  </div>


<?php include '../includes/foot.php'; ?>
</body>
</html>
