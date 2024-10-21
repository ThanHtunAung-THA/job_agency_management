<?php
include '../includes/Database.php';
include '../includes/config.php';

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
        // Prepare SQL query for employee table
        $query_admin = "SELECT * FROM admins WHERE email = ?";
        $stmt_admin = $conn->prepare($query_admin);
        $stmt_admin->bind_param('s', $email);
        $stmt_admin->execute();
        $result_admin = $stmt_admin->get_result();
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
                $_SESSION['user_type'] = 'employer';
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
              $_SESSION['user_type'] = 'employee';
              header('Location: ../employees/dashboard.php');
              exit();
          } else {
              $error = 'Invalid email or password.';
          }
        } elseif ($result_admin->num_rows == 1) {
          // Fetch employee data
          $admin = $result_admin->fetch_assoc(); 
          // Verify password
          if (password_verify($password, $admin['password'])) {
              // Start session and set session variables
              session_start();
              $_SESSION['user_id'] = $admin['id'];
              $_SESSION['user_name'] = $admin['username'];
              $_SESSION['user_type'] = 'admin';
              header('Location: ../admins/dashboard.php');
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
        $stmt_admin->close();
    }
}
$db->close();
?>
<?php include '../components/head.php'; ?>
<body style="">
<?php include '../navbars/nav__auth.php'; ?>
<?php include '../components/$error_$success.php'; ?>
<section class="container ml-auto mr-auto" >
<div class="row mt-0" style="height: 550px;">
  <div class="col-12 col-md-6 bsb-tpl-bg-left card">
    <div class="d-flex flex-column justify-content-between p-md-2 p-xl-3">
      <h3 class="m-0 ">Welcome!</h3>
      <img src="../assets/images/ojc-round.png" alt="Login Image" class="img-fluid mx-auto my-4">
    </div>
  </div>
  <div class="col-12 col-md-6 bsb-tpl-bg-left card">
    <div class="p-1 p-md-2 p-xl-3">      
      <form method="post" class="card card-body">
        <h3 class="text-center">Login</h3>
        <div class="form-group">
          <label class="form-label" for="email">Email <span class="text-danger">*</span></label>
          <input type="email" class="form-control" id="email" name="email" placeholder="Enter email">
        </div>
        <div class="form-group">
          <label class="form-label" for="password">Password <span class="text-danger">*</span></label>
          <input type="password" class="form-control" id="password" name="password" placeholder="Enter password">
        </div>
        <div class="form-check mb-3">
          <input class="form-check-input" type="checkbox" value="" name="remember_me" id="remember_me">
          <label class="form-check-label text-secondary" for="remember_me">
            Keep me logged in
          </label>
        </div>
        <button type="submit" class="btn btn-primary btn-box">Login</button>
        <hr class="mb-0 border-secondary-subtle">
        <div class="mt-1">
          <a href="register.php" class="alert alert-link m-0 p-0"> 
              Create new account ?
          </a>
          <a href="password_reset.php" class="alert alert-link m-0 p-0" style="float: right;">
              Forgot password ?
          </a>
        </div>
      </form>
    </div>
  </div>
</div>
</section>
</div>
<?php include '../components/foot.php'; ?>
</body>
</html>
