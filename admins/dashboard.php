<?php
session_start();
include '../includes/Database.php';
include '../includes/config.php';

$error = 'hello';
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
    <div class="">
        <div class="">
            <div class="card-header bg-dark">
                <h4 class="text-light">Dashboard Overview</h4>

            </div>



        </div>
    </div>
</div>


<?php include '../components/foot.php'; ?>
</body>
</html>
