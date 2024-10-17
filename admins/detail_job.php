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
// Check if the job data is found
if (!$row) {
    echo "Job not found!";
    exit;
}
$status = $row['status'];

?>

<?php include '../components/head_admin.php'; ?>
<body>
<?php include '../navbars/nav__admin.php'; ?>
<?php include '../components/$error_$success.php'; ?>

<div class="content ">
    <section class="card bg-dark mb-5">
        
    <h4 class="card-header text-light">
        <a href="jobs.php" class="text-light mr-2">
            <i class="fa fa-arrow-circle-left fa-lg"></i>
        </a>
        Sr.No - 233<?= $row['id']; ?>
        <span class="float-right">
            <small>
            status : 
            <?php 
                if ($status == 0) {
                    echo "<span class='text-danger'>close</span>";
                } elseif ($status == 1) {
                    echo "<span class='text-warning'>pending</span>";
                } elseif ($status == 2) {
                    echo "<span class='text-success'>active</span>";
                }
            ?>
            </small>
            <?php if ($status == 0 || $status == 1) { ?>
                <a href="activate_job.php?id=<?= $row['id'] ?>" class="btn btn-success btn-sm ml-2">Activate</a>
            <?php } elseif ($status == 2) { ?>
                <a href="deactivate_job.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm ml-2">Deactivate</a>
            <?php } ?>
        </span>
    </h4>    
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
</div>

<?php include '../components/foot.php'; ?>
</body>
</html>
