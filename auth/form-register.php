<?php
session_start();
include '../includes/header.php';

// Generate a CSRF token
$csrf_token = bin2hex(random_bytes(32));
$_SESSION['csrf_token'] = $csrf_token;

$error = $_SESSION['error']?? null;
$success = $_SESSION['success']?? null;

?>

<section class="p-3 p-md-4 p-xl-5">
    <?php if ($error || $success):?>
        <div id="popup-message" class="popup-message-overlay">
            <div class="popup-message-box">
                <button id="close-popup" class="close-btn">&times;</button>
                <div class="popup-message-content">
                    <?php if ($error):?>
                        <div class="error"><?= htmlspecialchars($error);?></div>
                    <?php elseif ($success):?>
                        <div class="success"><?= htmlspecialchars($success);?></div>
                    <?php endif;?>
                </div>
            </div>
        </div>
    <?php endif;?>

    <div class="container">
        <div class="row fixed-height">
            <div class="col-12 col-md-6 bsb-tpl-bg-platinum card">
                <div class="d-flex flex-column justify-content-between p-3 p-md-4 p-xl-5">
                    <h3 class="m-0">Welcome!</h3>
                    <img class="img-fluid rounded mx-auto my-4" src="../assets/image/fallout-thumbsup.png" width="auto" height="auto" alt="thumbsup">
                </div>
            </div>
            <div class="col-12 col-md-6 bsb-tpl-bg-lotion card">
                <div class="p-3 p-md-4 p-xl-5">
                    <div class="row">
                        <div class="col-12">
                            <div class="mb-5">
                                <h3>Register</h3>
                            </div>
                        </div>
                    </div>
                    <form action="register.php" method="POST" class="card-body" enctype="multipart/form-data">
                        <input type="hidden" name="csrf_token" value="<?php echo $csrf_token;?>">
                        <div class="row gy-3 gy-md-4 overflow-hidden">
                            <div class="col-12">
                                <label for="username" class="form-label">Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="username" id="username" placeholder="John Weed" required>
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
                                <select name="role" id="role" class="form-select" required>
                                    <option value="employee">Employee</option>
                                    <option value="employer">Employer</option>
                                </select>
                            </div>
                            <div class="col-12" style="height: 100px;" data-bs-toggle="tooltip" data-bs-placement="bottom" title="This is Optional">
                                <label for="image">Profile Image:</label>
                                <input type="file" name="image" id="image" accept="image/*" onchange="showThumbnail(this)">
                                <div id="thumbnail-container" class="thumbnail-container"></div>
                                <!-- <span class="optional-hint">Optional</span> -->
                            </div>
                            <div class="col-12">
                                <div class="d-grid">
                                    <button class="btn bsb-btn-xl btn-primary" type="submit">Register now</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="row">
                        <hr class="mt-5 mb-4 border-secondary-subtle">
                        <p class="mb-0">Already had an account?<a href="login.php" class="link-secondary text-decoration-none hovering"> Log in now </a></p>    
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include '../includes/footer.php'; ?>
