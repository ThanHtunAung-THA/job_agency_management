<?php
session_start();
include '../includes/Database.php';
include '../includes/config.php';

$error = '';
$success = '';
$db = new Database();
$conn = $db->getConnection();
$employerId = $_SESSION['user_id'];

$stmt = $conn->prepare("SELECT * FROM employers WHERE id = ?");
$stmt->bind_param("i", $employerId);
$stmt->execute();
$result = $stmt->get_result();
$employerData = $result->fetch_assoc();

 $db->close();
?>
<?php include '../components/head.php'; ?>
<body style="background-image: linear-gradient(to right, #1f2766, #1f2766);">
<?php include '../navbars/nav__employer.php'; ?>
<?php include '../components/$error_$success.php'; ?>
<div class="container ">
  <div class="row">
    <div class="col-md-5">
      <div class="card shadow-sm p-4 text-center">
      <div class="card-body">
        <!-- Profile Image -->
        <?php if (!empty($employerData['company_logo'])): ?>
          <img src="../uploads/<?= $employerData['company_logo'] ?>" class="img-fluid rounded-circle mb-3" alt="Profile Picture" width="150" height="150">
        <?php else: ?>
          <img src="../assets/images/default_profile.png" class="img-fluid rounded-circle mb-3" alt="Profile Picture" width="150" height="150">
          <p class="text-muted"><i><span class="text-danger">*</span> add image</i></p>
        <?php endif; ?>
        <h3 class="text-dark"><?= $employerData['username'] ?></h3>
        <p class="text-muted">
          <?php if (!empty($employerData['company_name'])): ?>
            <?= $employerData['company_name'] ?>
          <?php else: ?>
            <i><span class="text-danger">*</span> describe your company name</i>
          <?php endif; ?>
        </p>
        <p class="text-muted">
          <?php if (!empty($employerData['company_address'])): ?>
            <?= $employerData['company_address'] ?>
          <?php else: ?>
            <i><span class="text-danger">*</span> describe your company address</i>
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
              <strong class="text-primary" >Person In Charge <span style="margin-left: 23px;">:</span></strong>
              <span class="text-dark"><?= htmlspecialchars($employerData['username']) ?></span>
            </li>
            <li class="mb-3">
              <strong class="text-primary">In Charge Email <span style="margin-left: 35px;">:</span></strong>
              <span class="text-dark"><?= htmlspecialchars($employerData['email']) ?></span>
            </li>
            <li class="mb-3">
              <strong class="text-primary">Company Name <span style="margin-left: 35px;">:</span></strong>
              <?php if (!empty($employerData['company_name'])): ?>
                <span class="text-dark"><?= htmlspecialchars($employerData['company_name']) ?></span>
              <?php else: ?>
                <span class="text-muted"><i><span class="text-danger">*</span> describe your position</i></span>
              <?php endif; ?>
            </li>
            <li class="mb-3">
              <strong class="text-primary">Company Phone <span style="margin-left: 30px;">:</span></strong>
              <?php if (!empty($employerData['company_phone'])): ?>
                <span class="text-dark"><?= htmlspecialchars($employerData['company_phone']) ?></span>
              <?php else: ?>
                <span class="text-muted"><i><span class="text-danger">*</span> describe your company phone number</i></span>
              <?php endif; ?>
            </li>
            <li class="mb-3">
              <strong class="text-primary">Company Address <span style="margin-left: 15px;">:</span></strong>
              <?php if (!empty($employerData['company_address'])): ?>
                <span class="text-dark"><?= htmlspecialchars($employerData['company_address']) ?></span>
              <?php else: ?>
                <span class="text-muted"><i><span class="text-danger">*</span> describe your address</i></span>
              <?php endif; ?>
            </li>
            <li class="mb-3">
              <strong class="text-primary">Company Info <span style="margin-left: 50px;">:</span></strong>
              <?php if (!empty($employerData['company_detail'])): ?>
                <span class="text-dark"><?= htmlspecialchars($employerData['company_detail']) ?></span>
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
            <?php if (!empty($employerData['company_logo'])): ?>
              <img src="../uploads/<?= $employerData['company_logo']; ?>" alt="Current Profile Picture" class="img-thumbnail" width="100">
            <?php else: ?>
              <img src="../assets/images/default_profile.png" alt="Default Profile Picture" class="img-thumbnail" width="100">
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
            <label for="username">In Charge Name :</label>
            <input type="text" class="form-control" id="username" name="username" value="<?= htmlspecialchars($employerData['username']) ?>">
          </div>
          <div class="form-group">
            <label for="email">In Charge Email :</label>
            <input type="email" class="form-control" id="email" name="email" value="<?= htmlspecialchars($employerData['email']) ?>">
          </div>
          <div class="form-group">
            <label for="cName">Company Name :</label>
            <input type="text" class="form-control" id="cName" name="cName" value="<?= htmlspecialchars($employerData['company_name']) ?>">
          </div>
          <div class="form-group">
            <label for="cPhone">Company Phone :</label>
            <input type="text" class="form-control" id="cPhone" name="cPhone" value="<?= htmlspecialchars($employerData['company_phone']) ?>">
          </div>
          <div class="form-group">
            <label for="cAddress">Company Address :</label>
            <textarea class="form-control" id="address" name="cAddress"><?= htmlspecialchars($employerData['company_address']) ?></textarea>
          </div>
          <div class="form-group">
            <label for="cDetail">Company Info :</label>
            <textarea class="form-control" id="cDetail" name="cDetail"><?= htmlspecialchars($employerData['company_detail']) ?></textarea>
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
