<?php
session_start();
include '../includes/Database.php';
include '../includes/config.php';

$error = '';
$success = '';
$db = new Database();
$conn = $db->getConnection();
$employer_id = $_SESSION['user_id'];

// Retrieve employers data
$sql_employer = "SELECT * FROM employers";
$results_employer = $conn->query($sql_employer);
while ($row_employer = mysqli_fetch_assoc($results_employer)) {
    $employer_data[] = $row_employer;
}

?>
<?php include '../components/head_admin.php'; ?>
<body>
<?php include '../navbars/nav__admin.php'; ?>
<?php include '../components/$error_$success.php'; ?>

<div class="content">
            <section class="card bg-dark">
                <h4 class="card-header text-light">Employer List</h4>
                <table id="jobTable" class="table table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>Employer ID</th>
                            <th>Employer Name</th>
                            <th>Employer Email</th>
                            <th>Employer Phone</th>
                            <th>Employer Company</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($employer_data as $employer) { 
                        
                    ?>
                        <tr>
                            <td><?php echo $employer['id']; ?></td>
                            <td>
                                <a href="detail_job.php?id=<?= $job['id']; ?>" class="job-listing-link">
                                    <?php echo $employer['username']; ?>
                                </a>
                            </td>
                            <td>
                                <?php echo $employer['email']; ?>
                            </td>
                            <td>
                                <?php echo $employer['company_phone']; ?>
                            </td>
                            <td><?php echo $employer['company_name']; ?></td>
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
