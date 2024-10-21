<?php
session_start();
include '../includes/Database.php';
include '../includes/config.php';

$error = '';
$success = '';
$db = new Database();
$conn = $db->getConnection();
// Get the job id from the URL
$job_id = $_GET['id'];
// Retrieve the job data from the database
$query = "SELECT * FROM jobs WHERE id = ?";
$stmt = $conn->prepare($query);
if (!$stmt) {
    echo "Error preparing query: " . $conn->error;
    exit;
}
$stmt->bind_param('i', $job_id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
if (!$row) {
    echo "Job not found!";
    exit;
}
if (isset($_POST['apply_job'])) {
    if (!isset($_SESSION['user_id'])) {
        $error = "Please log in to apply for this job.";
    } 
}
?>
<?php include '../components/head.php'; ?>
<body style="background-image: linear-gradient(to right, #1f2766, #1f2766);">
<?php include '../navbars/nav__employer.php'; ?>
<?php include '../components/$error_$success.php'; ?>
<div class="jumbotron" style="margin-left: 0px;">
    <section class="card bg-dark mb-5">
        <h4 class="card-header text-light">
            <a href="dashboard.php" class="text-light">
                <i class="fa fa-arrow-circle-left fa-lg"></i>
            </a>    
            <span class="float-right">Detail of Job Sr.No - 233<?= $row['id']; ?></span>
        </h4>
        <section class="mt-5 mb-5">
            <div class="container">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title"><?= $row['job_title']; ?></h4>
                        <div class="card-text">
                            <b>Job Description : </b><br>
                            <?= $row['job_desc']; ?><br><br>
                            <b>Location :</b><br>
                            <?= $row['job_location']; ?><br><br>
                            <b>Responsibilities :</b><br>
                            <?= $row['responsibilities']; ?><br><br>
                            <b>Requirements :</b><br>
                            <?= $row['requirements']; ?><br><br>
                            <b>Skills :</b><br>
                            <?= $row['skills']; ?><br><br>
                            <b>Experience :</b><br>
                            <?= $row['experience']; ?><br><br>
                            <b>Salary :</b><br>
                            <?= $row['salary']; ?><br><br>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </section>
</div>
<?php include '../components/foot.php'; ?>
</body>
</html>
