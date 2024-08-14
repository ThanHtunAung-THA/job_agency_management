<?php 
session_start(); 
include '../includes/Database.php';
// Create a new Database instance
$db = new Database();
$conn = $db->getConnection();

?>

<?php include '../includes/head.php'; ?>
<body>
<?php include '../includes/header.php'; ?>

<!-- content here -->
<h1>employee</h1>

<?php include '../includes/footer.php'; ?>
<?php include '../includes/foot.php'; ?>
</body>
</html>