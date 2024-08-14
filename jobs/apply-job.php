<?php
session_start();
include '../includes/Database.php';

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
    // Remove the exit; statement
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
?>

<?php include '../includes/head.php'; ?>
<body style="background-image: linear-gradient(to right, #1f2766, #1f2766);">
<?php include '../includes/header.php'; ?>

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



<?php include '../includes/foot.php'; ?>
</body>
</html>