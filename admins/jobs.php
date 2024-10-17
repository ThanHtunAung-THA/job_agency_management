<?php
session_start();
include '../includes/Database.php';
include '../includes/config.php';

$error = '';
$success = '';
$db = new Database();
$conn = $db->getConnection();
$employer_id = $_SESSION['user_id'];

// Retrieve jobs data
$sql_job = "SELECT * FROM jobs";
$results_job = $conn->query($sql_job);
while ($row_job = mysqli_fetch_assoc($results_job)) {
    $job_data[] = $row_job;
}

?>
<?php include '../components/head_admin.php'; ?>
<body>
<?php include '../navbars/nav__admin.php'; ?>
<?php include '../components/$error_$success.php'; ?>

<div class="content">
    <section class="card bg-dark">
        <div class="">
        <h4 class="card-header text-light">Job List</h4>
        <table id="jobTable" class="table table-bordered" style="width:100%;">
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
        </div>
    </section>
</div>

<?php include '../components/foot.php'; ?>
</body>
</html>
<?php $db->close();?>
