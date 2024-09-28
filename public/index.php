<?php
session_start();
include '../includes/config.php';
?>

<?php include '../includes/head.php'; ?>
<body>

<?php include '../includes/nav.php'; ?>

<!-- slider section -->
<?php include '../components/slider.php'; ?>
<!-- end slider section -->

<!-- category section -->
<?php include '../components/category.php'; ?>
<!-- end category section -->

<!-- about section -->
<?php include '../components/about.php'; ?>
<!-- end about section -->

<!-- job section -->
<?php include '../components/jobs_recent.php'; ?>
<!-- end job section -->

<!-- info section -->
<?php include '../components/contact.php'; ?>
<!-- end info_section -->

<?php include '../includes/footer.php'; ?>

<?php include '../includes/foot.php'; ?>
</body>
</html>
