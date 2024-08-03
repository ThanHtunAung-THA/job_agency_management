<?php
// Include the Database class
include '../../classes/Database.php';

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
        // Prepare SQL query
        $query = "SELECT * FROM users WHERE email = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            // Fetch user data
            $user = $result->fetch_assoc();

            // Verify password
            if (password_verify($password, $user['password'])) {
                // Start session and set session variables
                session_start();
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['role'] = $user['role'];

                // Redirect based on role
                if ($user['role'] == 'admin') {
                    header('Location: admin.php');
                } elseif ($user['role'] == 'employee' || $user['role'] == 'employer') {
                    header('Location: user.php');
                }
                exit();
            } else {
                $error = 'Invalid email or password.';
            }
        } else {
            $error = 'Invalid email or password.';
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
    <?php endif; ?>

  <div class="container ">
    <div class="row fixed-height">
      <div class="col-12 col-md-6 bsb-tpl-bg-platinum card">
        <div class="d-flex flex-column justify-content-between  p-3 p-md-4 p-xl-5">
          <h3 class="m-0 ">Welcome!</h3>
          <img class="img-fluid rounded mx-auto my-4" src="../../assets/image/fallout-thumbsup.png" width="auto" height="auto" alt="thumbsup">

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
                <a href="#!" class="link-secondary text-decoration-none hovering">Forgot password</a>
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?php include '../../includes/footer.php'; ?>
