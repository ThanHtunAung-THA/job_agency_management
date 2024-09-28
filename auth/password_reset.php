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
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validate form data
    if (empty($username) || empty($email) || empty($password)) {
        $error = 'All fields are required.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Invalid email format.';
    } elseif (strlen($password) < 6) {
        $error = 'Password must be at least 6 characters long.';
    } else {
        // Check if username and email exist in database
        $query_employee = "SELECT * FROM employees WHERE username = ? AND email = ?";
        $stmt = $conn->prepare($query_employee);
        $stmt->bind_param('ss', $username, $email);
        $stmt->execute();
        $result = $stmt->get_result();

        $query_employer = "SELECT * FROM employers WHERE username = ? AND email = ?";
        $stmt = $conn->prepare($query_employer);
        $stmt->bind_param('ss', $username, $email);
        $stmt->execute();
        $result2 = $stmt->get_result();


        if ($result->num_rows == 0 && $result2->num_rows == 0) {
            $error = 'Invalid username or email.';
        } else {
            // Hash password
            $hashed_password = password_hash($password, PASSWORD_BCRYPT);

            // Prepare SQL query

            if ($result->num_rows == true) {
                $query = "UPDATE employees SET password = ? WHERE username = ? AND email = ?";
                $stmt = $conn->prepare($query);
                $stmt->bind_param('sss', $hashed_password, $username, $email);
            } 
            elseif ($result2->num_rows == true) {
                $query = "UPDATE employers SET password = ? WHERE username = ? AND email = ?";
                $stmt = $conn->prepare($query);
                $stmt->bind_param('sss', $hashed_password, $username, $email);
            }

            // Execute query
            if ($stmt->execute()) {
                $success = 'Password reset successful!';
            } else {
                $error = 'Error: ' . $stmt->error;
            }            
            // Close statement
            $stmt->close();
        }
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
                    Already had an account ? ...
                    <a href="login.php" class="alert"> 
                    Login here 
                    </a>
                </div><br>
                <div class="alert-link">
                    If you did'nt have an account yet ? ... 
                    <a href="register.php" class="alert">
                    Register here
                    </a>
                </div>
            </p>
            </center>
        </div>

        <div class="col-12 col-md-6 bsb-tpl-bg-left card ">

            <div class="p-3 p-md-4 p-xl-5">
                <div class="row">
                    <div class="col-12">
                        <div class="mb-5">
                            <h3>Password Reset</h3>
                        </div>
                    </div>
                </div>

                <form method="POST" class="card card-body" enctype="multipart/form-data">
                    <input type="hidden" name="csrf_token" value="<?php echo $csrf_token; ?>">
                    <div class="form-group">
                        <label class="form-label" for="username">Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="username" name="username" placeholder="Enter last acc name" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="email">Email <span class="text-danger">*</span></label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter last acc email" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="password">New Password <span class="text-danger">*</span></label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Enter new password" required>
                    </div>
                    <button type="submit" class="btn btn-primary btn-box mb-1">Reset password</button>
                    <hr class="mb-0 border-secondary-subtle">
                </form>
            </div>
        </div>
    </div>
</section>

<?php include '../includes/foot.php'; ?>
</body>
</html>
