<?php
session_start();
include '../includes/Database.php';
include '../includes/config.php';

$error = '';
$success = '';

$db = new Database();
$conn = $db->getConnection();

$employerId = $_SESSION['user_id'];



?>

<?php include '../includes/head.php'; ?>
<body style="background-image: linear-gradient(to right, #1f2766, #1f2766);">
<?php include '../includes/nav__employer.php'; ?>

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

<!-- dasboard -->
<div class="jumbotron" style="margin-left: 0px;">
  <center><h2 class="text-primary"> -- Dashboard --</h2></center>

  <div class="container-fluid">
    <div class="row">

      <!-- Main Content -->
      <main role="main" class="col-md-9 col-lg-10" style="margin-left: 7em;">
        <div class="row my-4">
          <div class="col-md-4">
            <div class="card bg-info">
              <div class="card-body">
                <h5 class="card-title">Total Jobs Posted</h5>
                <p class="card-text">5</p>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card bg-success">
              <div class="card-body">
                <h5 class="card-title">New Applications</h5>
                <p class="card-text">12</p>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card bg-warning">
              <div class="card-body">
                <h5 class="card-title">Interviews Scheduled</h5>
                <p class="card-text">3</p>
              </div>
            </div>
          </div>
        </div>
        <!-- Additional Overview Content -->
      </main>
    </div>
  </div>

</div>

<?php include '../includes/foot.php'; ?>
</body>
</html>
