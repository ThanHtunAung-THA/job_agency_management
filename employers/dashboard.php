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

//when employer posted job, it goes to the jobs.tb with status 1

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

<?php include '../includes/head.php'; ?>
<body style="background-image: linear-gradient(to right, #1f2766, #1f2766);">
    <?php include '../includes/nav__employer.php'; ?>

    <div class="container-fluid mt-4">
        <div class="row">
            <div class="col-md-12">
                <?php if ($error || $success): ?>
                    <div class="alert alert-<?php echo ($error) ? 'danger' : 'success'; ?> alert-dismissible fade show" role="alert">
                        <?php echo htmlspecialchars($error ? $error : $success); ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php endif; ?>

                <div class="d-flex justify-content-between align-items-center mb-3 card-header bg-dark">
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

                <div class="row">
                    <!-- Job Postings Section -->
                    <div class="col-md-6">
                        <section class="card bg-dark job-postings">
                            <h3 class="card-header text-light">Job Postings</h3>
                            <div class="card-head">
                                <?php foreach ($job_data as $job) { ?>
                                    <div class="card bg-light mb-3">
                                        <div class="card-header font-weight-bold"><?php echo $job['job_title']; ?></div>
                                        <div class="card-body">
                                            <p class="card-text"><?php echo $job['job_desc']; ?></p>
                                            <?php
                                            // Count applications for this job
                                            $applicants_query = "SELECT COUNT(*) as applicant_count FROM applied_jobs WHERE job_id = '$job[id]'";
                                            $applicants_result = mysqli_query($conn, $applicants_query);
                                            $applicants_data = mysqli_fetch_assoc($applicants_result);
                                            ?>
                                            <p class="card-text">
                                                <small class="text-muted">Post-status: 
                                                    <?php 
                                                        if ($job['status'] == 0) {
                                                            echo "Closed"; 
                                                        }
                                                        if ($job['status'] == 1) {
                                                            echo "Pending"; 
                                                        }
                                                        if ($job['status'] == 2) {
                                                            echo "Opening"; 
                                                        }
                                                    ?>
                                                </small>
                                                </p>
                                            <p class="card-text"><small class="text-muted">Applications: <?php echo $applicants_data['applicant_count']; ?></small></p>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </section>
                    </div>

                    <!-- Applications Section -->
                    <div class="col-md-6">
                        <section class="card bg-dark applications">
                            <h3 class="card-header text-light">Applications</h3>
                            <div class="card-head">
                                <?php foreach ($applied_data as $app) { ?>
                                    <div class="card bg-light mb-3">
                                        <div class="card-header font-weight-bold"><?php echo $app['employee_name']; ?></div>
                                        <div class="card-body">
                                            <p class="card-text">Job Title: <?php echo $app['job_title']; ?></p>
                                            <p class="card-text"><small class="text-muted">Status: <?php echo $app['status']; ?></small></p>
                                            <a href="#" class="btn btn-primary btn-jobs" data-employee-id="<?php echo $app['employee_id']; ?>">View Profile</a>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>

<!-- Employee Profile Modal -->
<div class="modal fade" id="employeeProfileModal" tabindex="-1" role="dialog" aria-labelledby="employeeProfileModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="employeeProfileModalLabel">Employee Profile</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Employee profile information will be displayed here -->
                <div id="employee-profile-content"></div>
            </div>
        </div>
    </div>
</div>

<?php include '../includes/foot.php'; ?>
</body>
</html>

<?php 
// Close the database connection
$db->close();
?>

<script>
$(document).ready(function() {
    $('.btn-primary[data-employee-id]').on('click', function() {
        var employeeId = $(this).data('employee-id');
        $.ajax({
            type: 'POST',
            url: 'fetch_employee_profile.php', // create a new PHP file to handle this request
            data: { employee_id: employeeId },
            success: function(response) {
                $('#employee-profile-content').html(response);
                $('#employeeProfileModal').modal('show');
            }
        });
    });
});
</script>