<?php
session_start();
include '../includes/Database.php';
include '../includes/config.php';

$error = '';
$success = '';
$db = new Database();
$conn = $db->getConnection();
$employer_id = $_SESSION['user_id'];

// Jobs Data
$sql_job = "SELECT * FROM jobs";
$results_job = $conn->query($sql_job);
$job_data = [];
while ($row_job = mysqli_fetch_assoc($results_job)) {
    $job_data[] = $row_job;
}
// Employers Data
$sql_employer = "SELECT * FROM employers";
$results_employer = $conn->query($sql_employer);
$employer_data = [];
while ($row_employer = mysqli_fetch_assoc($results_employer)) {
    $employer_data[] = $row_employer;
}
// Employees Data
$sql_employee = "SELECT * FROM employees";
$results_employee = $conn->query($sql_employee);
$employee_data = [];
while ($row_employee = mysqli_fetch_assoc($results_employee)) {
    $employee_data[] = $row_employee;
}
// Convert PHP arrays to JSON format
$job_count = count($job_data);
$employer_count = count($employer_data);
$employee_count = count($employee_data);
?>
<?php include '../components/head_admin.php'; ?>
<body>
<?php include '../navbars/nav__admin.php'; ?>
<?php include '../components/$error_$success.php'; ?>
<div class="content card">
    <section class="card bg-dark">
        <h4 class="card-header text-light">Overview Chart List</h4>
        <canvas id="dashboardChart" style="width: 100%; height: 500px;" class="bg-light"></canvas>
    </section>
</div>
<?php include '../components/foot.php'; ?>
<!-- Include Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// Get data from PHP (number of jobs, employees, and employers)
const jobCount = <?php echo $job_count; ?>;
const employerCount = <?php echo $employer_count; ?>;
const employeeCount = <?php echo $employee_count; ?>;
// Create the chart
let dashboardChart; // Declare the chart variable
function createChart() {
    const ctx = document.getElementById('dashboardChart').getContext('2d');
    dashboardChart = new Chart(ctx, {
        type: 'bar', // Bar chart
        data: {
            labels: ['Jobs', 'Employers', 'Employees'], // Labels for each category
            datasets: [{
                label: 'Overview',
                data: [jobCount, employerCount, employeeCount], // Data for each category
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(75, 192, 192, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(75, 192, 192, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true, // Makes the chart responsive
            // maintainAspectRatio: false, // Allows the chart to fill the container's dimensions
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
}
// Call createChart() initially to create the chart
createChart();
</script>
</body>
</html>
<?php $db->close(); ?>
