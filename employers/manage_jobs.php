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
if (isset($_POST['job_title']) || isset($_POST['job_desc']) || isset($_POST['responsibilities']) || isset($_POST['experience']) || isset($_POST['skills']) || isset($_POST['requirements']) || isset($_POST['salary'])) {
  $job_id = $_POST['job_id'];
  $job_title = $_POST['job_title'];
  $job_desc = $_POST['job_desc'];
  $responsibilities = $_POST['responsibilities'];
  $experience = $_POST['experience'];
  $skills = $_POST['skills'];
  $requirements = $_POST['requirements'];
  $salary = $_POST['salary'];
  $update_query = "UPDATE jobs SET 
    job_desc = ?, 
    responsibilities = ?, 
    experience = ?, 
    skills = ?, 
    requirements = ?, 
    salary = ?
  WHERE id = ? AND employer_id = '$employer_id'";
  $stmt = $conn->prepare($update_query);
  $stmt->bind_param("ssssssi", $job_desc, $responsibilities, $experience, $skills, $requirements, $salary, $job_id);
  if ($stmt->execute()) {
    $success = 'Job updated successfully!';
  } else {
    $error = 'Error updating job: ' . $stmt->error;
  }
}
$db->close();
?>
<?php include '../components/head.php'; ?>
<body style="background-image: linear-gradient(to right, #1f2766, #1f2766);">
<?php include '../navbars/nav__employer.php'; ?>
<?php include '../components/$error_$success.php'; ?>
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
                  <span data-bs-toggle="tooltip" title="Job is pending">
                    <a href="#" class="btn btn-outline-success disabled" aria-disabled="true" style="width: 100px;">Activate</a>
                  </span>
                <?php } elseif ($status == 2) { ?>
                  <a href="deactivate_job.php?id=<?= $job['id'] ?>" class="btn btn-warning" style="width: 100px;">Deactivate</a>
                <?php } ?>
              </div>
              <div class="col-md-4">
                <center>
                  <div class="col-md-4">
                  <?php if ($status == 0) { ?>
                    <button class="btn btn-primary" style="width: 100px;" id="edit-profile-btn" data-toggle="modal" data-target="#edit-job-modal">
                      Edit
                    </button>
                  <?php } else { ?>
                  <span data-bs-toggle="tooltip" title="Cannot edit a pending job or open job">
                    <button class="btn btn-outline-primary disabled" aria-disabled="true" style="width: 100px;">
                      Edit
                    </button>
                  </span>
                  <?php } ?>
                </div>
                </center>
              </div>
              <?php if ($status == 0) { ?>
              <div class="col-md-4">
                <a href="delete_job.php?id=<?= $job['id'] ?>" class="btn btn-danger" style="width: 100px; float:right;">Delete</a>
              </div>
              <?php } else { ?>
              <div class="col-md-4" data-bs-toggle="tooltip" title="Cannot delete a pending job or open job">
                <button class="btn btn-outline-danger disabled" aria-disabled="true" style="width: 100px; float:right;">
                  Delete
                </button>
              </div>
              <?php } ?>
            </div>
          </td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
<!-- Edit Modal -->
<div class="modal fade" id="edit-job-modal" tabindex="-1" role="dialog" aria-labelledby="editProfileModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editProfileModalLabel">Edit Job Listing</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="edit-job-form">
        <input type="hidden" name="job_id" value="<?= $job['id'] ?>">
          <div class="form-group">
            <label for="job_title">Job Title :</label>
            <input type="text" class="form-control" id="job_title" name="job_title" value="<?= htmlspecialchars($job['job_title']) ?>" disabled>
          </div>
          <div class="form-group">
            <label for="job_desc">Job Description :</label>
            <textarea class="form-control" id="job_desc" name="job_desc" rows="6" cols="50"><?= htmlspecialchars($job['job_desc']) ?></textarea>
          </div>
          <div class="form-group">
            <label for="responsibilities">Responsibilities :</label>
            <textarea class="form-control" id="responsibilities" name="responsibilities" rows="6" cols="50"><?= htmlspecialchars($job['responsibilities']) ?></textarea>
          </div>
          <div class="form-group">
            <label for="experience">Experience :</label>
            <textarea class="form-control" id="experience" name="experience" rows="3" cols="50"><?= htmlspecialchars($job['experience']) ?></textarea>
          </div>
          <div class="form-group">
            <label for="skills">Skills :</label>
            <textarea class="form-control" id="skills" name="skills" rows="3" cols="50"><?= htmlspecialchars($job['skills']) ?></textarea>
          </div>
          <div class="form-group">
            <label for="requirements">Requirements :</label>
            <textarea class="form-control" id="requirements" name="requirements" rows="6" cols="50"><?= htmlspecialchars($job['requirements']) ?></textarea>
          </div>
          <div class="form-group">
            <label for="salary">Salary :</label>
            <textarea class="form-control" id="salary" name="salary"><?= htmlspecialchars($job['salary']) ?></textarea>
          </div>
          <button type="submit" class="btn btn-primary">Update Job</button>
        </form>
      </div>
    </div>
  </div>
</div>
<?php include '../components/foot.php'; ?>
</body>
</html>

<script>
  // Add JavaScript to handle the edit profile form submission
  $(document).ready(function() {
    $('#edit-job-form').submit(function(event) {
      event.preventDefault();
      var formData = $(this).serialize();
      $.ajax({
        type: 'POST',
        url: '<?php echo $_SERVER['PHP_SELF']; ?>',
        data: formData,
        success: function(data) {
          // Update the profile information
          $('#popup-message').fadeIn();
          $('#popup-message .success').text('Job data updated successfully');
          // Close the modal
          $('#edit-job-modal').modal('hide');
          // Update the profile information on the page
          $('#job_title-display').text($('#job_title').val());
          $('#job_desc-display').text($('#job_desc').val());
          $('#responsibilities-display').text($('#responsibilities').val());
          $('#experience-display').text($('#experience').val());
          $('#skills-display').text($('#skills').val());
          $('#requirements-display').text($('#requirements').val());
          $('#salary-display').text($('#salary').val());
        },
        error: function(xhr, status, error) {
          // Show an error message
          $('#popup-message').fadeIn();
          $('#popup-message .error').text('Error updating job data: ' + error);
        }
      });
    });
  });
</script>
