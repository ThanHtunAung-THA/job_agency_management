<?php
session_start();
include '../includes/Database.php';

$db = new Database();
$conn = $db->getConnection();

if (isset($_POST['job_id']) && isset($_POST['user_id'])) {
  $jobId = $_POST['job_id'];
  $employeeId = $_POST['user_id'];

  // Check if the employee has already applied for the job
  $sql = "SELECT * FROM applied_jobs WHERE employee_id = $employeeId AND job_id = $jobId";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
    echo "You have already applied for this job.";
    exit;
  }

  // Insert a new record into the applied_jobs table
  $sql = "INSERT INTO applied_jobs (employee_id, job_id, application_date) VALUES ($employeeId, $jobId, NOW())";
  if ($conn->query($sql) === TRUE) {
    echo "success";
  } else {
    echo "Error applying for job: " . $conn->error;
  }
} else {
  echo "Invalid request.";
}
?>