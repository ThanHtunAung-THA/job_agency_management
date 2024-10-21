<?php
session_start();
include '../includes/Database.php';
include '../includes/config.php';

$db = new Database();
$conn = $db->getConnection();

$job_id = $_GET['id'];
$job_query = "SELECT * FROM jobs WHERE id = '$job_id'";
$job_result = mysqli_query($conn, $job_query);
$job_data = mysqli_fetch_assoc($job_result);
if (isset($_POST['edit_job'])) {
    $job_title = $_POST['job_title'];
    $job_description = $_POST['job_description'];
    $responsibilities = $_POST['responsibilities'];
    $experience = $_POST['experience'];
    $skills = $_POST['skills'];
    $requirements = $_POST['requirements'];
    $salary = $_POST['salary'];
    $update_query = "UPDATE jobs SET job_title = '$job_title', job_desc = '$job_description' WHERE id = '$job_id'";
    mysqli_query($conn, $update_query);
    echo "<script>window.opener.location.reload(); window.close();</script>";
    exit;
}
$db->close();
?>
<div class="popup-edit-job">
    <h2>Edit Job</h2>
    <form action="" method="post">
        <label for="job_title">Job Title:</label>
        <input type="text" id="job_title" name="job_title" value="<?php echo $job_data['job_title']; ?>">
        <label for="job_description">Job Description:</label>
        <textarea id="job_description" name="job_description"><?php echo $job_data['job_description']; ?></textarea>
        <button type="submit" name="edit_job">Save Changes</button>
    </form>
</div>
