<?php
session_start();
include '../includes/Database.php';
include '../includes/config.php';

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

 $db->close();
?>
<?php include '../components/head.php'; ?>
<body style="background-image: linear-gradient(to right, #1f2766, #1f2766);">
<?php include '../navbars/nav__employee.php'; ?>
<?php include '../components/$error_$success.php'; ?>
<div class="container ">
  <div class="row">
    <div class="col-md-5">
      <div class="card shadow-sm p-4 text-center">
      <div class="card-body">
        <!-- Profile Image -->
        <?php if (!empty($employeeData['image'])): ?>
          <img src="<?php echo UPLOAD_PATH; ?>/<?= $employeeData['image'] ?>" class="img-fluid rounded-circle mb-3" alt="Profile Picture" width="150" height="150">
        <?php else: ?>
          <img src="<?php echo ASSETS_URL; ?>/images/default_profile.png" class="img-fluid rounded-circle mb-3" alt="Profile Picture" width="150" height="150">
          <p class="text-muted"><i><span class="text-danger">*</span> add image</i></p>
        <?php endif; ?>
        <h3 class="text-dark"><?= $employeeData['username'] ?></h3>
        <p class="text-muted">
          <?php if (!empty($employeeData['role'])): ?>
            <?= $employeeData['role'] ?>
          <?php else: ?>
            <i><span class="text-danger">*</span> describe your position</i>
          <?php endif; ?>
        </p>
        <p class="text-muted">
          <?php if (!empty($employeeData['address'])): ?>
            <?= $employeeData['address'] ?>
          <?php else: ?>
            <i><span class="text-danger">*</span> describe your address</i>
          <?php endif; ?>
        </p>
        <!-- Edit Image Button -->
        <button class="btn btn-outline-primary btn-tr" id="upload-btn" data-toggle="modal" data-target="#image-upload-modal">
          Edit Image
        </button>
      </div>
      </div>
    </div>
    <!-- Contact Info Section -->
    <div class="col-md-7">
      <div class="card shadow-sm p-4">
        <div class="card-body">
          <h5 class="card-title">Profile Information</h5>
          <hr>
          <ul class="list-unstyled">
            <li class="mb-3">
              <strong class="text-primary">Full Name : </strong>
              <span class="text-dark"><?= htmlspecialchars($employeeData['username']) ?></span>
            </li>
            <li class="mb-3">
              <strong class="text-primary">Email : </strong>
              <span class="text-dark"><?= htmlspecialchars($employeeData['email']) ?></span>
            </li>
            <li class="mb-3">
              <strong class="text-primary">Role : </strong>
              <?php if (!empty($employeeData['role'])): ?>
                <span class="text-dark"><?= htmlspecialchars($employeeData['role']) ?></span>
              <?php else: ?>
                <span class="text-muted"><i><span class="text-danger">*</span> describe your position</i></span>
              <?php endif; ?>
            </li>
            <li class="mb-3">
              <strong class="text-primary">Phone : </strong>
              <?php if (!empty($employeeData['phone'])): ?>
                <span class="text-dark"><?= htmlspecialchars($employeeData['phone']) ?></span>
              <?php else: ?>
                <span class="text-muted"><i><span class="text-danger">*</span> describe your phone number</i></span>
              <?php endif; ?>
            </li>
            <li class="mb-3">
              <strong class="text-primary">Address : </strong>
              <?php if (!empty($employeeData['address'])): ?>
                <span class="text-dark"><?= htmlspecialchars($employeeData['address']) ?></span>
              <?php else: ?>
                <span class="text-muted"><i><span class="text-danger">*</span> describe your address</i></span>
              <?php endif; ?>
            </li>
            <li class="mb-3">
              <strong class="text-primary">Description : </strong>
              <?php if (!empty($employeeData['description'])): ?>
                <span class="text-dark"><?= htmlspecialchars($employeeData['description']) ?></span>
              <?php else: ?>
                <span class="text-muted"><i><span class="text-danger">*</span> describe about you</i></span>
              <?php endif; ?>
            </li>
          </ul>
          <!-- Edit Profile Button -->
          <div class="text-center mt-4">
            <button class="btn btn-outline-primary btn-tr" id="edit-profile-btn" data-toggle="modal" data-target="#edit-profile-modal">
              Edit Profile
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Image Upload Modal -->
<div class="modal fade" id="image-upload-modal" tabindex="-1" role="dialog" aria-labelledby="imageUploadModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="imageUploadModalLabel">Upload Profile Image</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="image-upload-form" action="profile_update.php" method="POST" enctype="multipart/form-data">
          <div class="thumbnail-preview mb-3">
            <?php if (!empty($employeeData['image'])): ?>
              <img src="<?php echo UPLOAD_PATH; ?>/<?= $employeeData['image']; ?>" alt="Current Profile Picture" class="img-thumbnail" width="100">
            <?php else: ?>
              <img src="<?php echo ASSETS_URL; ?>/images/default_profile.png" alt="Default Profile Picture" class="img-thumbnail" width="100">
            <?php endif; ?>
          </div>

          <input type="file" id="imgupload" name="imgupload" class="form-control-file" accept="image/*">
          <button type="submit" class="btn btn-primary mt-3">Upload Image</button>
          
        </form>
      </div>
    </div>
  </div>
</div>
<!-- Edit Profile Modal -->
<div class="modal fade" id="edit-profile-modal" tabindex="-1" role="dialog" aria-labelledby="editProfileModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editProfileModalLabel">Edit Profile</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="edit-profile-form" action="profile_update.php" method="POST">
          <div class="form-group">
            <label for="username">Full Name :</label>
            <input type="text" class="form-control" id="username" name="username" value="<?= htmlspecialchars($employeeData['username']) ?>">
          </div>
          <div class="form-group">
            <label for="email">Email :</label>
            <input type="email" class="form-control" id="email" name="email" value="<?= htmlspecialchars($employeeData['email']) ?>" disabled>
          </div>
          <div class="form-group">
            <label for="role">Role :</label>
            <input type="text" class="form-control" id="role" name="role" value="<?= htmlspecialchars($employeeData['role']) ?>">
          </div>
          <div class="form-group">
            <label for="phone">Phone:</label>
            <input type="text" class="form-control" id="phone" name="phone" value="<?= htmlspecialchars($employeeData['phone']) ?>">
          </div>
          <div class="form-group">
            <label for="address">Address:</label>
            <textarea class="form-control" id="address" name="address"><?= htmlspecialchars($employeeData['address']) ?></textarea>
          </div>
          <div class="form-group">
            <label for="description">Description:</label>
            <textarea class="form-control" id="description" name="description"><?= htmlspecialchars($employeeData['description']) ?></textarea>
          </div>
          <button type="submit" class="btn btn-primary">Update Profile</button>
        </form>
      </div>
    </div>
  </div>
</div>
<?php include '../components/foot.php'; ?>
</body>
</html>
