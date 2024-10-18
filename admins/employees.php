<?php
session_start();
include '../includes/Database.php';
include '../includes/config.php';

$error = '';
$success = '';
$db = new Database();
$conn = $db->getConnection();
$employee_id = $_SESSION['user_id'];

// Retrieve employees data
$sql_employee = "SELECT * FROM employees";
$results_employee = $conn->query($sql_employee);
while ($row_employee = mysqli_fetch_assoc($results_employee)) {
    $employee_data[] = $row_employee;
}

?>
<?php include '../components/head_admin.php'; ?>
<body>
<?php include '../navbars/nav__admin.php'; ?>
<?php include '../components/$error_$success.php'; ?>

<div class="content">
            <section class="card bg-dark">
                <h4 class="card-header text-light">Employee List</h4>
                <table id="jobTable" class="table table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>Employee ID</th>
                            <th>Employee Name</th>
                            <th>Employee Email</th>
                            <th>Employee Phone/th>
                            <th>Employee Role</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($employee_data as $employee) { 
                        
                    ?>
                        <tr>
                            <td><?php echo $employee['id']; ?></td>
                            <td>
                                <a href="#" class="job-listing-link" data-employee-id="<?php echo $employee['id']; ?>">
                                    <?php echo $employee['username']; ?>
                                </a>
                            </td>
                            <td>
                                <?php echo $employee['email']; ?>
                            </td>
                            <td>
                                <?php echo $employee['phone']; ?>
                            </td>
                            <td><?php echo $employee['role']; ?></td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </section>

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
<?php $db->close();?>

<script>
$(document).ready(function() {
    $('.job-listing-link[data-employee-id]').on('click', function() {
        var employeeId = $(this).data('employee-id');
        $.ajax({
            type: 'POST',
            url: '../components/fetch_employee_profile.php', // create a new PHP file to handle this request
            data: { employee_id: employeeId },
            success: function(response) {
                $('#employee-profile-content').html(response);
                $('#employeeProfileModal').modal('show');
            }
        });
    });
});
</script>
