<?php
session_start();
include '../includes/Database.php';
include '../includes/config.php';

$db = new Database();
$conn = $db->getConnection();

if (isset($_GET['id'])) {
    $job_id = $_GET['id'];
    $employer_id = $_SESSION['user_id'];

    $delete_query = "DELETE FROM jobs WHERE id = ? AND employer_id = ?";
    $stmt = $conn->prepare($delete_query);
    $stmt->bind_param("ii", $job_id, $employer_id);

    if ($stmt->execute()) {
        header('Location: manage_jobs.php');
        exit;
    } else {
        $error = 'Error deleting job: ' . $stmt->error;
        header('Location: manage_jobs.php?error=' . urlencode($error));
        exit;
    }
} else {
    header('Location: manage_jobs.php');
    exit;
}