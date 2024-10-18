<?php
// Include the necessary files and connect to the database
include '../includes/Database.php';
include '../includes/config.php';

$db = new Database();
$conn = $db->getConnection();

// Get the employer ID from the AJAX request
$employerId = $_POST['employer_id'];

// Fetch the employer profile information
$profile_query = "SELECT * FROM employers WHERE id = '$employerId'";
$profile_result = mysqli_query($conn, $profile_query);
$profile_data = mysqli_fetch_assoc($profile_result);

// Display the employer profile information
echo '<p> Name <span style="margin-left: 22px;">:</span> ' . $profile_data['username'] . '</p>';
echo '<p> Email <span style="margin-left: 24px;">:</span> ' . $profile_data['email'] . '</p>';
echo '<p> Company <span style="">:</span> ' . $profile_data['company_name'] . '</p>';
echo '<p> Phone <span style="margin-left: 18px;">:</span> ' . $profile_data['company_phone'] . '</p>';
echo '<p> Address <span style="margin-left: 5px;">:</span> ' . $profile_data['company_address'] . '</p>';
echo '<p> Description <span style="margin-left: 5px;">:</span> ' . $profile_data['company_detail'] . '</p>';
// Add more profile information as needed

// Close the database connection
$db->close();
?>