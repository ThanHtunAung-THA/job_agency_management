<?php
include '../includes/Database.php';
include '../includes/config.php';

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

        // Prepare SQL query for employer table
        $query_employer = "SELECT * FROM employers WHERE email = ?";
        $stmt_employer = $conn->prepare($query_employer);
        $stmt_employer->bind_param('s', $email);
        $stmt_employer->execute();
        $result_employer = $stmt_employer->get_result();

        // Prepare SQL query for employee table
        $query_employee = "SELECT * FROM employees WHERE email = ?";
        $stmt_employee = $conn->prepare($query_employee);
        $stmt_employee->bind_param('s', $email);
        $stmt_employee->execute();
        $result_employee = $stmt_employee->get_result();


        // Check if email exists in either table
        if ($result_employer->num_rows == 1) {
            // Fetch employer data
            $employer = $result_employer->fetch_assoc();

            // Verify password
            if (password_verify($password, $employer['password'])) {
                // Start session and set session variables
                session_start();
                $_SESSION['user_id'] = $employer['id'];
                $_SESSION['user_name'] = $employer['username'];
                $_SESSION['role'] = 'employer';


                header('Location: ../employers/dashboard.php');
                exit();
            } else {
                $error = 'Invalid email or password.';
            }
        } elseif ($result_employee->num_rows == 1) {
          // Fetch employee data
          $employee = $result_employee->fetch_assoc();

          // Verify password
          if (password_verify($password, $employee['password'])) {
              // Start session and set session variables
              session_start();
              $_SESSION['user_id'] = $employee['id'];
              $_SESSION['user_name'] = $employee['username'];
              $_SESSION['role'] = 'employee';

              header('Location: ../employees/dashboard.php');
              exit();
          } else {
              $error = 'Invalid email or password.';
          }
        } else {
            $error = 'Invalid email or password.';
        }

        // Close statements
        $stmt_employer->close();
        $stmt_employee->close();
    }
}

// Close database connection
$db->close();
?>

<?php include '../includes/head.php'; ?>

<body style="  background-image: linear-gradient(to right, #6fbae2, #7168c9);">
  
<?php include '../includes/nav__auth.php'; ?>

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


<section class="container ">
  <div class="row">

    <div class="col-12 col-md-6 bsb-tpl-bg-left card">
      <div class="d-flex flex-column justify-content-between p-md-4 p-xl-5">
        <h3 class="m-0 ">Welcome!</h3>
        <img src="../assets/images/ojc-round.png" alt="Login Image" class="img-fluid mx-auto my-4">
      </div>
      <center>
      <p class="mb-5">
          <div class="alert-link">
            If you did'nt have an account yet ? ... 
            <a href="register.php" class="alert"> 
            Register here 
            </a>
          </div><br>
          <div class="alert-link">
            If you forgot your password ? ... 
            <a href="password_reset.php" class="alert">
              Reset here
            </a>
          </div>
      </p>
      </center>
    </div>
    
    <div class="col-12 col-md-6 bsb-tpl-bg-left card">

      <div class="p-3 p-md-4 p-xl-5 ">
        <div class="row ">
          <div class="col-12 ">
            <div class="mb-5">
              <h3 class="">Login</h3>
            </div>
          </div>
        </div>

        <form method="post" class="card card-body">
          <div class="form-group">
            <label class="form-label" for="email">Email <span class="text-danger">*</span></label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Enter email">
          </div>
          <div class="form-group">
            <label class="form-label" for="password">Password <span class="text-danger">*</span></label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Enter password">
          </div>
          <div class="form-check mb-5">
            <input class="form-check-input" type="checkbox" value="" name="remember_me" id="remember_me">
            <label class="form-check-label text-secondary" for="remember_me">
              Keep me logged in
            </label>
          </div>
          <button type="submit" class="btn btn-primary btn-box mb-1">Login</button>
          <hr class="mb-0 border-secondary-subtle">
        </form>
      </div>
    </div>
  </div>
</section>
</div>
<?php include '../includes/foot.php'; ?>
</body>
</html>
