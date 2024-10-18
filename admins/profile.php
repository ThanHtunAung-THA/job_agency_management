<!-- under development for further system process -->
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

// to handle the edit profile image submission ========================= //
if(isset($_FILES['imgupload'])) {
  $image = $_FILES['imgupload']['name'];
  $target = UPLOAD_PATH . basename($image);
  $q = "UPDATE employees SET image = '$image' WHERE id = '$employeeId'";
  $conn->query($q);
  move_uploaded_file($_FILES['imgupload']['tmp_name'], $target);

  header("location: profile.php"); // Redirect to profile page
  exit;
}

// to handle the edit profile form submission
if (isset($_POST['username']) || isset($_POST['role']) || isset($_POST['phone']) || isset($_POST['address']) || isset($_POST['description'])) {
  $username = $_POST['username'];
  $role = $_POST['role'];
  $phone = $_POST['phone'];
  $address = $_POST['address'];
  $description = $_POST['description'];

  $q = "UPDATE employees SET username = '$username', role = '$role', phone = '$phone', address = '$address', description = '$description' WHERE id = '$employeeId'";
  $conn->query($q);

  // Update the session variables
  $_SESSION['username'] = $username;
  $_SESSION['role'] = $role;
  $_SESSION['phone'] = $phone;
  $_SESSION['address'] = $address;
  $_SESSION['description'] = $description;
}

 $db->close();
?>
<?php include '../components/head_admin.php'; ?>
<body style="">
<?php include '../navbars/nav__admin.php'; ?>
<?php include '../components/$error_$success.php'; ?>

<div class="content">

<!-- Profile Section -->
<div class="container ">
  <div class="row">
    <!-- Profile Info Section -->
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
        
        <!-- Username -->
        <h3 class="text-dark"><?= $employeeData['username'] ?></h3>
        
        <!-- Role -->
        <p class="text-muted">
          <?php if (!empty($employeeData['role'])): ?>
            <?= $employeeData['role'] ?>
          <?php else: ?>
            <i><span class="text-danger">*</span> describe your position</i>
          <?php endif; ?>
        </p>

        <!-- Address -->
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
        <form id="image-upload-form" enctype="multipart/form-data">
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
        <form id="edit-profile-form">
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

<script>
  // Add JavaScript to handle the image upload form submission
  $(document).ready(function() {
    $('#image-upload-form').submit(function(event) {
      event.preventDefault();
      var formData = new FormData(this);
      $.ajax({
        type: 'POST',
        url: '<?php echo $_SERVER['PHP_SELF']; ?>',
        data: formData,
        contentType: false,
        cache: false,
        processData: false,
        success: function(data) {
          // Update the thumbnail preview
          var thumbnail = $('#image-upload-modal .thumbnail-preview img');
          thumbnail.attr('src', '<?php echo UPLOAD_PATH; ?>/' + data);
          // Close the modal
          $('#image-upload-modal').modal('hide');
          // Show a success message
          $('#popup-message').fadeIn();
          $('#popup-message .success').text('Image uploaded successfully');
        },
        error: function(xhr, status, error) {
          // Show an error message
          $('#popup-message').fadeIn();
          $('#popup-message .error').text('Error uploading image: ' + error);
        }
      });
    });
  });

  // Add JavaScript to handle the edit profile form submission
  $(document).ready(function() {
    $('#edit-profile-form').submit(function(event) {
      event.preventDefault();
      var formData = $(this).serialize();
      $.ajax({
        type: 'POST',
        url: '<?php echo $_SERVER['PHP_SELF']; ?>',
        data: formData,
        success: function(data) {
          // Update the profile information
          $('#popup-message').fadeIn();
          $('#popup-message .success').text('Profile updated successfully');
          // Close the modal
          $('#edit-profile-modal').modal('hide');
          // Update the profile information on the page
          $('#username-display').text($('#username').val());
          $('#email-display').text($('#email').val());
          $('#role-display').text($('#role').val());
          $('#phone-display').text($('#phone').val());
          $('#address-display').text($('#address').val());
          $('#description-display').text($('#description').val());
        },
        error: function(xhr, status, error) {
          // Show an error message
          $('#popup-message').fadeIn();
          $('#popup-message .error').text('Error updating profile: ' + error);
        }
      });
    });
  });
</script>
