<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: ../auth/login.php');
    exit;
}
?>

<?php include '../includes/header.php'; ?>

<!-- Dashboard content here -->
<h1>Welcome, <?php echo $_SESSION['user_role']; ?>!</h1>

<?php include '../includes/footer.php'; ?>