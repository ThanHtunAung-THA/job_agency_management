
<?php
session_start();
include '../includes/Database.php';
include '../includes/config.php';

$db = new Database();
$conn = $db->getConnection();
$employerId = $_SESSION['user_id'];

// to handle the edit profile image submission ========================= //
if (isset($_FILES['imgupload'])) {
    echo "File upload initiated.<br>";

    if ($_FILES['imgupload']['error'] === UPLOAD_ERR_OK) {
        $image = $_FILES['imgupload']['name'];
        $target = UPLOAD_PATH . basename($image);
        
        // Debugging output
        echo "Target path: " . $target . "<br>";

        $q = "UPDATE employers SET company_logo = '$image' WHERE id = '$employerId'";
        
        if ($conn->query($q) === TRUE) {
            echo "Database update successful.<br>";
            if (move_uploaded_file($_FILES['imgupload']['tmp_name'], $target)) {
                echo "File moved successfully.<br>";
            } else {
                echo "Error moving file.";
            }
        } else {
            echo "Error updating record: " . $conn->error;
        }
    } else {
        echo "File upload error: " . $_FILES['imgupload']['error'];
    }
}

// to handle the edit profile form submission
if (isset($_POST['username']) || isset($_POST['email']) || isset($_POST['cName']) || isset($_POST['cAddress']) || isset($_POST['cPhone']) || isset($_POST['cDetail'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $company_name = $_POST['cName'];
    $company_address = $_POST['cAddress'];
    $company_phone = $_POST['cPhone'];
    $company_detail = $_POST['cDetail'];
    $q = "UPDATE employers SET username = '$username', company_name = '$company_name', company_address = '$company_address', company_phone = '$company_phone', company_detail = '$company_detail' WHERE id = '$employerId'";
    $conn->query($q);
    // Update the session variables
    $_SESSION['username'] = $username;
    $_SESSION['company_name'] = $company_name;
    $_SESSION['company_address'] = $company_address;
    $_SESSION['company_phone'] = $company_phone;
    $_SESSION['company_detail'] = $company_detail;
  }

header("location: profile.php"); // Redirect to profile page
exit;
