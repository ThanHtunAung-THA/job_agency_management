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
        // Hash password
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        // Prepare SQL query
        $query = "UPDATE users SET password = ? WHERE users.username = ? AND users.email = ?";
        $stmt = $conn->prepare($query);
        if (!$stmt) {
            $error = 'Error: ' . $conn->error;
        } else {
            $stmt->bind_param('sss', $hashed_password, $username, $email);

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
header('Location: login.php');
exit;
?>

<?php include '../../includes/header.php'; ?>

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

    <div class="container">
        <div class="row fixed-height">
            <div class="col-12 col-md-6 bsb-tpl-bg-platinum card">
                <div class="d-flex flex-column justify-content-between p-3 p-md-4 p-xl-5">
                    <h3 class="m-0">Welcome!</h3>
                    <img class="img-fluid rounded mx-auto my-4" src="../../assets/image/fallout-thumbsup.png" width="auto" height="auto" alt="thumbsup">
                </div>
            </div>
            <div class="col-12 col-md-6 bsb-tpl-bg-lotion card">
                <div class="p-3 p-md-4 p-xl-5">
                    <div class="row">
                        <div class="col-12">
                            <div class="mb-5">
                                <h3>Password Reset</h3>
                            </div>
                        </div>
                    </div>
                    <form method="POST" class="card-body">
                        <div class="row gy-3 gy-md-4 overflow-hidden">
                            <div class="col-12">
                                <label for="username" class="form-label">Name <span class="text-danger">*</span></label>
                                <input type="username" class="form-control" name="username" id="username" placeholder="account user name" required>
                            </div>

                            <div class="col-12">
                                <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                <input type="email" class="form-control" name="email" id="email" placeholder="account email" required>
                            </div>

                            <div class="col-12">
                                <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                                <input type="password" class="form-control" name="password" id="password" value="" placeholder="new password" required>
                            </div>

                            <div class="col-12">
                                <div class="d-grid">
                                    <button class="btn bsb-btn-xl btn-primary" type="submit">Reset password</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="row">
                        <hr class="mt-5 mb-4 border-secondary-subtle">
                        <p class="d-flex justify-content-between mb-0">
                            <a href="login.php" class="link-secondary text-decoration-none hovering">Goto login</a>
                            <a href="register.php" class="link-secondary text-decoration-none hovering">Goto register</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include '../../includes/footer.php'; ?>
