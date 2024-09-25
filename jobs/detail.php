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

// Check if the "Apply job" button has been clicked
if (isset($_POST['apply_job'])) {
    if (!isset($_SESSION['user_id'])) {
        $error = "Please log in to apply for this job.";
    } 
}
?>

<?php include '../includes/head.php'; ?>
<body style="background-image: linear-gradient(to right, #1f2766, #1f2766);">
<?php include '../includes/header.php'; ?>
<!-- content here -->
<?php if ($error): ?>
    <div id="popup-message" class="popup-message-overlay">
        <div class="popup-message-box">
            <button id="close-popup" class="close-btn">&times;</button>
            <div class="popup-message-content">
                <div class="error"><?= htmlspecialchars($error); ?></div>
            </div>
        </div>
    </div>
<?php endif; ?>

<div class="jumbotron" style="margin-left: 0px;">
    <h3>Detail of Job Sr.No - 233<?= $row['id']; ?></h3>

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


                <?php if (isset($_SESSION['user_id'])): ?>
                    <form action="apply-job.php" method="post">
                        <input type="hidden" name="job_id" value="<?= $job_id ?>">
                        <input type="hidden" name="user_id" value="<?= $_SESSION['user_id'] ?>">
                        <button class="btn btn-success btn-apply" type="submit">Apply job</button>
                    </form>
                <?php else: ?>
                    <form method="post">
                        <input type="hidden" name="apply_job" value="1">
                        <button class="btn btn-success btn-apply" type="submit">Apply job</button>
                    </form>                
                <?php endif; ?>                 
                <a href="jobs.php" class="btn btn-secondary">Views All Jobs</a>
            </div>
        </div>
    </div>

</section>

</div>
<!-- content here -->

<?php include '../includes/foot.php'; ?>
</body>
</html>