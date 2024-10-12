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

<div class="container card bg-dark mt-5">
  <h3 class="card-header text-white">Post a New Job</h3>
  <form action="" method="post" class="mb-5">
    <!-- Job Details Section -->
    <div class="card-body bg-dark border border-light">
      <h5 class="text-white">Job Details</h5>
      <div class="form-group">
        <label for="jobTitle" class="text-white">Job Title</label>
        <input type="text" class="form-control" id="jobTitle" name="jobTitle" placeholder="e.g., Senior Developer" required>
      </div>
      <div class="form-group">
        <label for="job_Desc" class="text-white">Job Description</label>
        <textarea class="form-control" id="job_Desc" name="job_Desc" rows="4" placeholder="Brief overview of the job"></textarea>
      </div>
      <div class="form-group">
        <label for="responsibilities" class="text-white">Responsibilities</label>
        <textarea class="form-control" id="responsibilities" name="responsibilities" rows="4" placeholder="List of job responsibilities"></textarea>
      </div>
    </div>
    
    <!-- Requirements Section -->
    <div class="card-body bg-dark border border-light mt-2">
      <h5 class="text-white">Requirements</h5>
      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="skills" class="text-white">Preferred Skills</label>
          <textarea class="form-control" id="skills" name="skills" rows="3" placeholder="Required skills"></textarea>
        </div>
        <div class="form-group col-md-6">
          <label for="experience" class="text-white">Experience</label>
          <textarea class="form-control" id="experience" name="experience" rows="3" placeholder="e.g., 3 years of experience"></textarea>
        </div>
      </div>
      <div class="form-group">
        <label for="requirements" class="text-white">Additional Requirements</label>
        <textarea class="form-control" id="requirements" name="requirements" rows="4" placeholder="Any extra qualifications"></textarea>
      </div>
    </div>

    <!-- Job Location and Salary -->
    <div class="card-body bg-dark border border-light mt-2">
      <h5 class="text-white">Other Details</h5>
      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="salary" class="text-white">Salary Range</label>
          <input type="text" class="form-control" id="salary" name="salary" placeholder="e.g., $50,000 - $70,000" required>
        </div>
        <div class="form-group col-md-6">
          <label for="job_location" class="text-white">Job Location</label>
          <input type="text" class="form-control" id="job_location" name="job_location" placeholder="e.g., New York City, Remote">
        </div>
      </div>
    </div>

    <!-- Submit Button -->
    <div class="card-footer text-center">
      <button type="submit" class="btn btn-light mt-3" style="width: 10em; height: 3em !important;">Create Job</button>
    </div>
  </form>
</div>


<?php include '../includes/foot.php'; ?>
</body>
</html>
