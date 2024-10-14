<?php
session_start();
include '../includes/Database.php';
include '../includes/config.php';

$error = '';
$success = '';

$db = new Database();
$conn = $db->getConnection();

$employer_id = $_SESSION['user_id'];

$db->close();
?>
<?php include 'head.php'; ?>
<body style="">
<?php include 'nav__admins.php'; ?>

<div class="content">
    <h1>Main Content Area</h1>
    <p>This is the main content area. Your page content goes here.</p>
</div>


<?php include 'foot.php'; ?>
</body>
</html>
