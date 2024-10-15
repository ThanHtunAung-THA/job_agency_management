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


$db->close();
?>
<?php include '../components/head_admin.php'; ?>
<body style="">
<?php include '../navbars/nav__admin.php'; ?>
<?php include '../components/$error_$success.php'; ?>

<div class="content" id="content">
    <h1>Employees Content Area</h1>
    <p>This is the main content area. Your page content goes here.</p>
</div>


<?php include '../components/foot.php'; ?>
</body>
</html>
