<?php
session_start();
include '../includes/Database.php';
include '../includes/config.php';

$db = new Database();
$conn = $db->getConnection();

if (isset($_GET['id'])) {
  $job_id = $_GET['id'];
  $q = "UPDATE jobs SET status = 0 WHERE id = $job_id";
  $conn->query($q);

  // Update the session variables
  $_SESSION['status'] = 0;

  // Redirect back to the manage job listings page
  header('Location: manage_jobs.php');
  exit;
}