<?php
include '../includes/Database.php';
include '../includes/config.php';

$error = '';
$success = '';
$db = new Database();
$conn = $db->getConnection();
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'];
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);
    if (empty($username) || empty($email) || empty($password)) {
        $error = 'All fields are required.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Invalid email format.';
    } elseif (strlen($password) < 6) {
        $error = 'Password must be at least 6 characters long.';
    } else {
        // Determine which table to insert into based on role
        if ($role == 'employer') {
            $query = "INSERT INTO employers (username, email, password) VALUES (?, ?, ?)";
        } elseif ($role == 'employee') {
            $query = "INSERT INTO employees (username, email, password) VALUES (?, ?, ?)";
        } else {
            $error = 'Invalid role specified.';
        }

        if (empty($error)) {
            try {
                // Prepare and bind parameters
                $stmt = $conn->prepare($query);
                $stmt->bind_param('sss', $username, $email, $hashed_password);

                // Execute the query
                if ($stmt->execute()) {
                    $success = 'Registration successful!';
                    $userId = $conn->insert_id;

                    // Store session data
                    $_SESSION['user_id'] = $userId;
                    $_SESSION['user_name'] = $username;
                    $_SESSION['role'] = $role;

                    // Redirect based on role
                    if ($role == 'employer') {
                        header('Location: ../employers/dashboard.php');
                    } elseif ($role == 'employee') {
                        header('Location: ../employees/dashboard.php');
                    }
                    exit;
                }

            } catch (mysqli_sql_exception $e) {
                // Catch duplicate email error (errno 1062)
                if ($e->getCode() == 1062) {
                    $error = 'The email address is already in use. Please try another one.';
                } else {
                    // For other SQL errors
                    $error = 'Database error: ' . $e->getMessage();
                }
            }
        }
    }
}

// Close the database connection
$db->close();
?>
<?php include '../components/head.php'; ?>
<body>
<?php include '../navbars/nav__auth.php'; ?>
<?php include '../components/$error_$success.php'; ?>
<section class="container ml-auto mr-auto">
    <div class="row mt-0" style="height: 550px;">
        <div class="col-12 col-md-6 bsb-tpl-bg-left card">
            <div class="d-flex flex-column justify-content-between p-md-2 p-xl-3">
                <h3 class="m-0 ">Welcome!</h3>
                <img src="../assets/images/ojc-round.png" alt="Login Image" class="img-fluid mx-auto my-4">
            </div>
        </div>
        <div class="col-12 col-md-6 bsb-tpl-bg-left card">
            <div class="p-1 p-md-2 p-xl-3">      
            <form method="POST" class="card card-body" enctype="multipart/form-data">
                <h3 class="text-center">Register</h3>
                <input type="hidden" name="csrf_token" value="<?php echo $csrf_token; ?>">
                <div class="form-group">
                    <label class="form-label" for="username">Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="username" name="username" placeholder="Enter username" required>
                </div>
                <div class="form-group">
                    <label class="form-label" for="email">Email <span class="text-danger">*</span></label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" required>
                </div>
                <div class="form-group">
                    <label class="form-label" for="password">Password <span class="text-danger">*</span></label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter password" required>
                </div>
                <div class="form-group">
                    <label class="form-label" for="role">Role <span class="text-danger">*</span></label>
                    <select name="role" id="role" class="form-control" required>
                        <option value="employee">Employee</option>
                        <option value="employer">Employer</option>
                    </select>    
                </div>
                <button type="submit" class="btn btn-primary btn-box mb-1">Register</button>
                <hr class="mb-0 border-secondary-subtle">
                <div class="mt-1">
                    <a href="login.php" class="alert alert-link m-0 p-0"> 
                        Existing account ?
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
<?php include '../components/foot.php'; ?>
</body>
</html>
