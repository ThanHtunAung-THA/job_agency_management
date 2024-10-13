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
<?php include '../includes/head.php'; ?>
<body style="background-image: linear-gradient(to right, #1f2766, #1f2766);">
<?php include '../includes/nav__admins.php'; ?>

fasdfsf


<?php include '../includes/foot.php'; ?>
</body>
</html>
