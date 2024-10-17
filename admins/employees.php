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

            <section class="container bg-dark">
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
                                <a href="detail_job.php?id=<?= $job['id']; ?>" class="job-listing-link">
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

<?php include '../components/foot.php'; ?>
</body>
</html>
<?php $db->close();?>
