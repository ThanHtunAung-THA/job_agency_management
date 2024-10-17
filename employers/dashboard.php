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
// Fetch applications
$applied_query = "SELECT aj.status, j.job_title, ee.id as employee_id, ee.username as employee_name
    FROM applied_jobs aj
    JOIN jobs j ON aj.job_id = j.id
    JOIN employees ee ON ee.id = aj.employee_id
    JOIN employers e ON j.employer_id = e.id
    WHERE e.id = '$employer_id'";
$applied_result = mysqli_query($conn, $applied_query);
$applied_data = array();
while ($row = mysqli_fetch_assoc($applied_result)) {
    $applied_data[] = $row;
}
?>

<?php include '../components/head.php'; ?>
<body style="background-image: linear-gradient(to right, #1f2766, #1f2766);">
<?php include '../navbars/nav__employer.php'; ?>
<?php include '../components/$error_$success.php'; ?>

    <div class="container-fluid mt-4">
        <div class="row">
            <div class="col-md-12">
                <div class="d-flex justify-content-between align-items-center card-header bg-dark">
                    <h4 class="text-light">Dashboard Overview</h4>
                    <ul class="list-inline text-light">
                        <li class="list-inline-item">
                            <span>Job Postings: <strong><?php echo count($job_data); ?></strong></span>
                        </li>
                        <li class="list-inline-item">
                            <span>Applications: <strong><?php echo count($applied_data); ?></strong></span>
                        </li>
                    </ul>
                </div>
                <!-- dataTable for posted job list -->
                <div class="d-flex justify-content-between align-items-center card-header bg-dark mt-2">
                    <section class="card bg-dark">
                    <h4 class="card-header text-light">Posted Job List</h4>
                    <table id="jobTable" class="table table-bordered" style="width:100%">
                    <thead>
                        <tr>
                        <th>Job ID</th>
                        <th>Job Title</th>
                        <th>Job Status</th>
                        <th>Applicants</th>
                        <th>Posted Date</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($job_data as $job) { 
                        // Count applications for this job
                        $applicants_query = "SELECT COUNT(*) as applicant_count FROM applied_jobs WHERE job_id = '$job[id]'";
                        $applicants_result = mysqli_query($conn, $applicants_query);
                        $applicants_data = mysqli_fetch_assoc($applicants_result);
                    ?>
                        <tr>
                        <td><?php echo $job['id']; ?></td>
                        <td>
                            <a href="detail_job.php?id=<?= $job['id']; ?>" class="job-listing-link">
                                <?php echo $job['job_title']; ?>
                            </a>
                        </td>
                        <td>
                            <?php 
                            if ($job['status'] == 0) {
                                echo "Job is closed";
                            } elseif ($job['status'] == 1) {
                                echo "Job is pending for approval";
                            } elseif ($job['status'] == 2) {
                                echo "Job is opening";
                            }
                            ?>
                        </td>
                        <td>
                           <a href="applied_applicants.php?id=<?= $job['id']; ?>" class="job-listing-link">
                                <?php echo $applicants_data['applicant_count']; ?> Applied
                           </a>
                        </td>
                        <td><?php echo $job['created_at']; ?></td>
                        </tr>
                    <?php } ?>
                    </tbody>
                    </table>
                    </section>
                </div>
            </div>
        </div>
    </div>

<?php include '../components/foot.php'; ?>
</body>
</html>

<?php 
// Close the database connection
$db->close();
?>

<script>
</script>
