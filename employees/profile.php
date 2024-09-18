<?php
session_start();
include '../includes/Database.php';

$error = '';
$success = '';

$db = new Database();
$conn = $db->getConnection();

$employeeId = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT * FROM employees WHERE id = ?");
$stmt->bind_param("i", $employeeId);
$stmt->execute();
$result = $stmt->get_result();
$employeeData = $result->fetch_assoc();

if (isset($_POST['upload_image'])) {
  $employeeId = $_SESSION['user_id'];
  $image = $_FILES['upload_image'];

  // Check if the image is valid
  if ($image['error'] == 0) {
    $imagePath = UPLOAD_PATH . '/' . $employeeId . '/';
    if (!file_exists($imagePath)) {
      mkdir($imagePath, 0777, true);
    }
    $imageName = $image['name'];
    $imageTmpName = $image['tmp_name'];
    $imageSize = $image['size'];
    $imageType = $image['type'];

    // Check if the image is an allowed type
    $allowedTypes = array('image/jpeg', 'image/png', 'image/gif');
    if (in_array($imageType, $allowedTypes)) {
      // Upload the image
      move_uploaded_file($imageTmpName, $imagePath . $imageName);

      // Update the employee's image in the database
      $stmt = $conn->prepare("UPDATE employees SET image = ? WHERE id = ?");
      $stmt->bind_param("si", $imageName, $employeeId);
      $stmt->execute();

      $success = 'Image uploaded successfully!';
    } else {
      $error = 'Invalid image type. Only JPEG, PNG, and GIF are allowed.';
    }
  } else {
    $error = 'Error uploading image. Please try again.';
  }
}

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
        <?php if (!empty($employeeData['image'])): ?>
          <img src="<?php echo UPLOAD_PATH; ?>/<?= $employeeData['id'] ?>/<?= $employeeData['image'] ?>" class="rounded-circle img-fluid" alt="Profile Picture" width="150">
        <?php else: ?>
          <img src="<?php echo ASSETS_URL; ?>/images/default_profile.png" class="rounded-circle img-fluid" alt="Profile Picture" width="150">
          <p><span>*</span></p>
        <?php endif; ?>

          <h3><?= $employeeData['username'] ?></h3>

        <?php if (!empty($employeeData['occupation'])): ?>
          <p><?= $employeeData['occupation'] ?></p>
        <?php else: ?>
          <p><span>*</span><span>Add Your Profession</span><span>*</span></p>
        <?php endif; ?>

        <?php if (!empty($employeeData['address'])): ?>
          <p><?= $employeeData['address'] ?></p>
        <?php else: ?>
          <p><span>*</span><span>Add Your Address</span><span>*</span></p>
        <?php endif; ?>


        <!-- Add a form to upload an image -->
        <button class="btn btn-outline-primary buttons" id="upload-image-btn">Edit Image</button>
          <!-- Modal for image upload -->
          <div id="image-upload-modal" class="modal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Upload Image</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
                    <input type="file" name="upload_image" id="image" style="display: none;">
                    <button class="btn btn-primary" id="upload-btn">Upload Image</button>
                  </form>
                </div>
              </div>
            </div>
          </div>


        </div>
    </div>

    <!-- Contact Info Section -->
    <div class="col-md-8">
      <div class="profile-card">
        <h5><span class="span1">Full Name</span> : <span class="span2"><?= $employeeData['username'] ?></span></h5>
        <h5><span class="span1">Email</span> : <span class="span2"><?= $employeeData['email'] ?></span></h5>
        <h5><span class="span1">Phone</span>  : 
      <?php if (!empty($employeeData['phone'])): ?>
        <span class="span2"><?= $employeeData['phone'] ?></span>
      <?php else: ?>
        <span class="span2"><span>*</span><span>Add Your Phone Number</span><span>*</span></span>
      <?php endif; ?>
    </h5>
    <h5><span class="span1">Address</span>  : 
      <?php if (!empty($employeeData['address'])): ?>
        <span class="span2"><?= $employeeData['address'] ?></span>
      <?php else: ?>
        <span class="span2"><span>*</span><span>Add Your Address</span><span>*</span></span>
      <?php endif; ?>
    </h5>
    <h5><span class="span1">Description</span>   : 
      <?php if (!empty($employeeData['description'])): ?>
        <span class="span2"><?= $employeeData['description'] ?></span>
      <?php else: ?>
        <span class="span2"><span>*</span><span>Add Your Description</span><span>*</span></span>
      <?php endif; ?>
    </h5>
        <button class="btn btn-outline-primary buttons">Edit Profile</button>
      </div>
    </div>
  </div>
</div>

<?php include '../includes/foot.php'; ?>
</body>
</html>

<script>
  $(document).ready(function() {
    $('#upload-image-btn').on('click', function() {
      $('#image-upload-modal').modal('show');
    });

    $('#upload-btn').on('click', function() {
      $('#image').trigger('click');
    });

    $('#image').on('change', function() {
      $(this).closest('form').submit();
    });
  });
</script>