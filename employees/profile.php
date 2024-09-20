<?php
session_start();
include '../includes/Database.php';
include '../includes/head.php';

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

// ====================== img uploading ========================= //
if(isset($_FILES['imgupload'])) {
  $image = $_FILES['imgupload']['name'];
  $target = UPLOAD_PATH . basename($image);

  $q = "UPDATE employees SET image = '$image' WHERE id = '$employeeId'";
  $conn->query($q);

  move_uploaded_file($_FILES['imgupload']['tmp_name'], $target);

  // $success = 'Image uploaded successfully';
  
  
}

 $db->close();
?>

<?php  ?>
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
          <img src="<?php echo UPLOAD_PATH; ?>/example-image-path" class="rounded-circle img-fluid" alt="Profile Picture" width="150">
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
        <!-- <button class="btn btn-outline-primary buttons" id="upload-btn">Edit Image</button> -->
        
        <!-- Modify the upload button to trigger the modal -->
        <button class="btn btn-outline-primary buttons" id="upload-btn" data-toggle="modal" data-target="#image-upload-modal">Edit Image</button>

      </div>
    </div>
    <!-- Add a modal for image uploading -->
    <div class="modal fade" id="image-upload-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Upload Profile Image</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form id="image-upload-form" enctype="multipart/form-data">
              <input type="file" id="imgupload" name="imgupload" accept="image/*">
              <div class="thumbnail-preview">
                <?php if (!empty($employeeData['image'])): ?>
                  <img src="<?php echo UPLOAD_PATH; ?>/<?php echo $employeeData['image']; ?>" alt="Current Profile Picture" width="100">
                <?php else: ?>
                  <img src="<?php echo ASSETS_URL; ?>/images/default_profile.png" alt="Default Profile Picture" width="100">
                <?php endif; ?>
              </div>
              <button type="submit" class="btn btn-primary">Upload Image</button>
            </form>
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

<!-- Add JavaScript to handle the image upload form submission -->
<script>
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
</script>
