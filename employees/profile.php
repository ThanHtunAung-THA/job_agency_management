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
                    <h3>John Doe</h3>
                    <p>Full Stack Developer</p>
                    <p>Bay Area, San Francisco, CA</p>
                    <button class="btn btn-outline-primary buttons">Edit Image</button>
                </div>
            </div>

            <!-- Contact Info Section -->
            <div class="col-md-8">
                <div class="profile-card">
                    <h5>Full Name: <span>Kenneth Valdez</span></h5>
                    <h5>Email: <span>fip@jukmuh.al</span></h5>
                    <h5>Phone: <span>(239) 816-9029</span></h5>
                    <h5>Address: <span>Bay Area, San Francisco, CA</span></h5>
                    <button class="btn btn-outline-primary buttons">Edit Profile</button>
                </div>

                 
            </div>
        </div>
    </div>

<?php include '../includes/foot.php'; ?>
</body>
</html>

