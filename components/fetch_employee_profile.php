<?php
// Include the necessary files and connect to the database
include '../includes/Database.php';
include '../includes/config.php';

$db = new Database();
$conn = $db->getConnection();

// Get the employee ID from the AJAX request
$employeeId = $_POST['employee_id'];

// Fetch the employee profile information
$profile_query = "SELECT * FROM employees WHERE id = '$employeeId'";
$profile_result = mysqli_query($conn, $profile_query);
$profile_data = mysqli_fetch_assoc($profile_result);

// Display the employee profile information
echo '<p> Name <span style="margin-left: 22px;">:</span> ' . $profile_data['username'] . '</p>';
echo '<p> Role <span style="margin-left: 32px;">:</span> ' . $profile_data['role'] . '</p>';
echo '<p> Email <span style="margin-left: 24px;">:</span> ' . $profile_data['email'] . '</p>';
echo '<p> Phone <span style="margin-left: 18px;">:</span> ' . $profile_data['phone'] . '</p>';
echo '<p> Address <span style="margin-left: 5px;">:</span> ' . $profile_data['address'] . '</p>';
echo '<p> Description <span style="margin-left: 5px;">:</span> ' . $profile_data['description'] . '</p>';
$db->close();
?>
