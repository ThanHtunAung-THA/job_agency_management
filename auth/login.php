<?php
// Include the Database class
include '../includes/Database.php';

// Initialize variables
$error = '';
$success = '';

// Create a new Database instance
$db = new Database();
$conn = $db->getConnection();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validate form data
    if (empty($email) || empty($password)) {
        $error = 'Both fields are required.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Invalid email format.';
    } else {
        // Prepare SQL query for admins table
        $query_admins = "SELECT * FROM admins WHERE email = ?";
        $stmt_admins = $conn->prepare($query_admins);
        $stmt_admins->bind_param('s', $email);
        $stmt_admins->execute();
        $result_admins = $stmt_admins->get_result();

        // Prepare SQL query for users table
        $query_users = "SELECT * FROM users WHERE email = ?";
        $stmt_users = $conn->prepare($query_users);
        $stmt_users->bind_param('s', $email);
        $stmt_users->execute();
        $result_users = $stmt_users->get_result();

        // Check if email exists in either table
        if ($result_admins->num_rows == 1) {
            // Fetch admin data
            $admin = $result_admins->fetch_assoc();

            // Verify password
            if (password_verify($password, $admin['password'])) {
                // Start session and set session variables
                session_start();
                $_SESSION['admin_id'] = $admin['id'];
                $_SESSION['admin_username'] = $admin['username'];
                $_SESSION['admin_role'] = $admin['role'];

                // Redirect to admin dashboard
                header('Location: ../_admin/dashboard.php');
                exit();
            } else {
                $error = 'Invalid email or password.';
            }
        } elseif ($result_users->num_rows == 1) {
            // Fetch user data
            $user = $result_users->fetch_assoc();

            // Verify password
            if (password_verify($password, $user['password'])) {
                // Start session and set session variables
                session_start();
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $user['username'];
                $_SESSION['user_role'] = $user['role'];

                // Redirect to user dashboard
                if ($user['role'] == 'employer') {
                    header('Location: ../_user/employer_dashboard.php');
                } elseif ($user['role'] == 'employee') {
                    header('Location: ../_user/employee_dashboard.php');
                }
                exit();
            } else {
                $error = 'Invalid email or password.';
            }
        } else {
            $error = 'Invalid email or password.';
        }

        // Close statements
        $stmt_admins->close();
        $stmt_users->close();
    }
}

// Close database connection
$db->close();
?>

<?php include '../includes/header.php'; ?>

<section class="p-3 p-md-4 p-xl-5">

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

  <div class="container ">
    <div class="row fixed-height">
      <div class="col-12 col-md-6 bsb-tpl-bg-platinum card">
        <div class="d-flex flex-column justify-content-between  p-3 p-md-4 p-xl-5">
          <h3 class="m-0 ">Welcome!</h3>
          <img class="img-fluid rounded mx-auto my-4" src="../assets/image/fallout-thumbsup.png" width="auto" height="auto" alt="thumbsup">

        </div>
      </div>
      <div class="col-12 col-md-6 bsb-tpl-bg-lotion card">
        <div class="p-3 p-md-4 p-xl-5">
          <div class="row">
            <div class="col-12">
              <div class="mb-5">
                <h3 class="">Log in</h3>
              </div>
            </div>
          </div>
          <form method="POST" class="card-body">
            <div class="row gy-3 gy-md-4 overflow-hidden">
              <div class="col-12">
                <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                <input type="email" class="form-control" name="email" id="email" placeholder="name@example.com" required>
              </div>
              <div class="col-12">
                <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                <input type="password" class="form-control" name="password" id="password" value="" placeholder="* * * * * * * *" required>
              </div>
              <div class="col-12">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="" name="remember_me" id="remember_me">
                  <label class="form-check-label text-secondary" for="remember_me">
                    Keep me logged in
                  </label>
                </div>
              </div>
              <div class="col-12">
                <div class="d-grid">
                  <button class="btn bsb-btn-xl btn-primary" type="submit">Log in now</button>
                </div>
              </div>
            </div>
          </form>
          <div class="row">
            <div class="col-12">
              <hr class="mt-5 mb-4 border-secondary-subtle">
              <p class="d-flex justify-content-between mb-0">
                <span>
                  <a href="register.php" class="link-secondary text-decoration-none hovering"> Register now </a><br/>
                  Not have an account yet?<br/>
                </span>
                <a href="password_reset.php" class="link-secondary text-decoration-none hovering">Forgot password ?</a>
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?php include '../includes/footer.php'; ?>
