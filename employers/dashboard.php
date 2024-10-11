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
                        <td><?php echo $job['job_title']; ?></td>
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
                        <td><?php echo $applicants_data['applicant_count']; ?> Applied</td>
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

$(document).ready(function() {
$('#jobTable').DataTable({
    dom: 'Bfrtip',
    buttons: [
    'copy', 'csv', 'excel', 'pdf', 'print'
    ]
});
});

</script>

