<?php
session_start();
include '../includes/Database.php';

$error = '';
$success = '';

$db = new Database();
$conn = $db->getConnection();

$employeeId = $_SESSION['user_id'];

$employeeId = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT * FROM employees WHERE id = ?");
$stmt->bind_param("i", $employeeId);
$stmt->execute();
$result = $stmt->get_result();
$employeeData = $result->fetch_assoc();

?>

<?php include '../includes/head.php'; ?>
<body style="background-image: linear-gradient(to right, #1f2766, #1f2766);">
<?php include '../includes/header-employee.php'; ?>

<!-- content here -->
<?php if ($error || $success): ?>
  <div id="popup-message" class="popup-message-overlay">
    <div class="popup-message-box">
      <button id="close-popup" class="close-btn">&times;</button>
      <div class="popup-message-content">
        <?php if ($error): ?>
          <div class="error"><?= htmlspecialchars($error); ?></div>
        <?php elseif ($success): ?>
          <div class="success"><?= htmlspecialchars($success); ?></div>
        <?php endif; ?>
      </div>
    </div>
  </div>
<?php endif; ?>

<!-- Profile Section -->
<div class="container mt-5">
  <div class="row">
    <!-- Profile Info Section -->
    <div class="col-md-4 ">
      <div class="profile-card text-center">
          <img src="https://bootdey.com/img/Content/avatar/avatar7.png" class="rounded-circle img-fluid" alt="Profile Picture" width="150">
          <h3><?= $employeeData['username'] ?></h3>
          <p><?= $employeeData['occupation'] ?></p>
          <p><?= $employeeData['address'] ?></p>
          <button class="btn btn-outline-primary buttons">Edit Image</button>
      </div>
    </div>

    <!-- Contact Info Section -->
    <div class="col-md-8">
      <div class="profile-card">
        <h5><span class="span1">Full Name</span> : <span class="span2"><?= $employeeData['username'] ?></span></h5>
        <h5><span class="span1">Email</span> : <span class="span2"><?= $employeeData['email'] ?></span></h5>
        <h5><span class="span1">Phone</span>  : <span class="span2"><?= $employeeData['phone'] ?></span></h5>
        <h5><span class="span1">Address</span>  : <span class="span2"><?= $employeeData['address'] ?></span></h5>
        <h5><span class="span1">Description</span>   : <span class="span2"><?= $employeeData['description'] ?></span></h5> 

        <button class="btn btn-outline-primary buttons">Edit Profile</button>
      </div>
    </div>
  </div>
</div>

<?php include '../includes/foot.php'; ?>
</body>
</html>

