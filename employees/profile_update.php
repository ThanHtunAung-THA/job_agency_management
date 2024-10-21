
<?php
session_start();
include '../includes/Database.php';
include '../includes/config.php';

$db = new Database();
$conn = $db->getConnection();
$employeeId = $_SESSION['user_id'];

// to handle the edit profile image submission ========================= //
if (isset($_FILES['imgupload'])) {
    echo "File upload initiated.<br>";

    if ($_FILES['imgupload']['error'] === UPLOAD_ERR_OK) {
        $image = $_FILES['imgupload']['name'];
        $target = UPLOAD_PATH . basename($image);
        
        // Debugging output
        echo "Target path: " . $target . "<br>";

        $q = "UPDATE employees SET image = '$image' WHERE id = '$employeeId'";
        
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
if (isset($_POST['username']) || isset($_POST['role']) || isset($_POST['phone']) || isset($_POST['address']) || isset($_POST['description'])) {
    $username = $_POST['username'];
    $role = $_POST['role'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $description = $_POST['description'];
    $q = "UPDATE employees SET username = '$username', role = '$role', phone = '$phone', address = '$address', description = '$description' WHERE id = '$employeeId'";
    $conn->query($q);
    // Update the session variables
    $_SESSION['username'] = $username;
    $_SESSION['role'] = $role;
    $_SESSION['phone'] = $phone;
    $_SESSION['address'] = $address;
    $_SESSION['description'] = $description;

  }
header("location: profile.php"); // Redirect to profile page
exit;
