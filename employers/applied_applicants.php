<?php
session_start();
include '../includes/Database.php';
include '../includes/config.php';

$error = '';
$success = '';
$db = new Database();
$conn = $db->getConnection();
$employer_id = $_SESSION['user_id'];
// Fetch applications
$applied_query = "SELECT aj.application_date, j.id, j.job_title, ee.id as employee_id, ee.username as employee_name , ee.email as employee_email, ee.role as employee_role
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
foreach ($applied_data as $job) {
    $job_id = $job['id'];
    $job_title = $job['job_title'];
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
                    <h4>
                        <a href="dashboard.php" class="text-light">
                        <i class="fa fa-arrow-circle-left fa-lg"></i>
                        </a>
                    </h4>
                    <h4 class="text-light">
                        <a href="detail_job.php?id=<?= $job_id ?>" class="job-listing-link">
                            <?= $job_title ?>
                        </a>
                    </h4>
                </div>
                <!-- dataTable for applicant list -->
                <div class="d-flex justify-content-between align-items-center card-header bg-dark mt-2">
                    <section class="card bg-dark">
                    <h4 class="card-header text-light">Applicant List</h4>
                    <table id="" class="table table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>Applicant ID</th>
                            <th>Applicant Name</th>
                            <th>Applicant Email</th>
                            <th>Applicant Role</th>
                            <th>Applied Date</th>
                            <th>Profile Detail</th>
                        </tr>
                    </thead>
                    <tbody class="card-body">
                    <?php foreach ($applied_data as $data) { ?>
                        <tr>
                            <td><?php echo $data['employee_id']; ?></td>
                            <td><?php echo $data['employee_name']; ?></td>
                            <td><?php echo $data['employee_email']; ?></td>
                            <td><?php echo $data['employee_role']; ?></td>
                            <td><?php echo $data['application_date']; ?></td>
                            <td>
                                <center><a href="#" class="btn btn-primary" data-employee-id="<?php echo $data['employee_id']; ?>">View Profile</a></center>
                            </td>
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

<?php include '../components/foot.php'; ?>
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
