<?php
// Include the Database class
// include '../../includes/config.php';
include '../../classes/Database.php';

// Initialize variables
$error = '';
$success = '';

// Create a new Database instance
$db = new Database();
$conn = $db->getConnection();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'];
    $image = $_FILES['image']['name'];
    $target = UPLOAD_PATH . basename($image);

    // Validate form data
    if (empty($username) || empty($email) || empty($password) || empty($role) || empty($image)) {
        $error = 'All fields are required.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Invalid email format.';
    } elseif (strlen($password) < 6) {
        $error = 'Password must be at least 6 characters long.';
    } elseif (!move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
        $error = 'Failed to upload image.';
    } else {
        // Hash password
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        // Prepare SQL query
        $query = "INSERT INTO users (username, email, password, role, image) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('sssss', $username, $email, $hashed_password, $role, $image);

        // Execute query
        if ($stmt->execute()) {
            $success = 'Registration successful!';
        } else {
            $error = 'Error: ' . $stmt->error;
        }

        // Close statement
        $stmt->close();
    }
}

// Close database connection
$db->close();
?>

<?php include '../../includes/header.php'; ?>

<section class="p-3 p-md-4 p-xl-5">

    <?php if ($error): ?>
        <div class="error"><?= htmlspecialchars($error); ?></div>
    <?php elseif ($success): ?>
        <div class="success"><?= htmlspecialchars($success); ?></div>
    <?php endif; ?>

  <div class="container">
    <div class="row">
      <div class="col-12 col-md-6 bsb-tpl-bg-platinum">
        <div class="d-flex flex-column justify-content-between h-100 p-3 p-md-4 p-xl-5">
          <h3 class="m-0">Welcome!</h3>
          <img class="img-fluid rounded mx-auto my-4" loading="lazy" src="" width="245" height="80" alt="sign in Logo">
          <p class="mb-0">Already had an account? <a href="login.php" class="link-secondary text-decoration-none">Sign in now</a></p>
        </div>
      </div>
      <div class="col-12 col-md-6 bsb-tpl-bg-lotion">
        <div class="p-3 p-md-4 p-xl-5">
          <div class="row">
            <div class="col-12">
              <div class="mb-5">
                <h3>Register</h3>
              </div>
            </div>
          </div>
          <form method="POST">
            <div class="row gy-3 gy-md-4 overflow-hidden">
              <div class="col-12">
                <label for="username" class="form-label">Email <span class="text-danger">*</span></label>
                <input type="username" class="form-control" name="username" id="username" placeholder="John Weed" required>
              </div>
              <div class="col-12">
                <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                <input type="email" class="form-control" name="email" id="email" placeholder="name@example.com" required>
              </div>
              <div class="col-12">
                <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                <input type="password" class="form-control" name="password" id="password" value="" placeholder="* * * * * * * *" required>
              </div>
              <div class="col-12">
                <label for="role" class="form-label">Role <span class="text-danger">*</span></label>
                <select name="role" id="role" required>
                    <option value="employee">Employee</option>
                    <option value="employer">Employer</option>
                </select>
              </div>
              
              <div class="col-12">
                <div class="d-grid">
                  <button class="btn bsb-btn-xl btn-primary" type="submit">Register now</button>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>

<?php include '../../includes/footer.php'; ?>
