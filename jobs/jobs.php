<?php
session_start();
include '../includes/Database.php';
include '../includes/config.php';

// Create a new Database instance
$db = new Database();
$conn = $db->getConnection();
// Retrieve job data
$limit = 5;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($page - 1) * $limit;
$sql = "SELECT * FROM jobs WHERE status = 2 LIMIT $offset, $limit ";
$results = $conn->query($sql);
// Get total number of rows
$sqlTotal = "SELECT COUNT(*) as total FROM jobs";
$resultTotal = $conn->query($sqlTotal);
$totalRows = $resultTotal->fetch_assoc()['total'];
$totalPages = ceil($totalRows / $limit);
$db->close();
?>
<?php include '../components/head.php'; ?>
<body style="  background-image: linear-gradient(to right, #1f2766, #1f2766);">
<?php include '../navbars/nav.php'; ?>
<div class="jumbotron" style="margin-left: 0px;">
<!-- Search Bar Section -->
<?php include '../components/job_searchbar.php'; ?>
<!-- Pagination Section -->
<?php include '../components/pagination.php'; ?>

<!-- Job Listings Section -->
<section class="container">
  <div class="card">
    <div class="card-body">
      <h2>Job Listings</h2>
      <ul class="list-group">
        <?php if ($results->num_rows > 0): ?>
          <?php while ($result = mysqli_fetch_array($results)): ?>
            <a href="detail.php?id=<?= $result['id']; ?>" class="job-listing-link">
              <li class="list-group-item">
                  <h4 class="card-title">Job Sr.No - 233<?= $result['id']; ?></h4>
                  <h5 class="card-title"><?= $result['job_title']; ?></h5>
                  <p class="card-text"><?= substr($result['job_desc'], 0, 300); ?>...</p>
                  <a href="detail.php?id=<?= $result['id']; ?>" class="btn btn-primary btn-jobs">Detail</a>
              </li>
            </a>
          <?php endwhile; ?>
        <?php else: ?>
          <p>No job listings found.</p>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</section>
<!-- Pagination Section -->
<?php include '../components/pagination.php'; ?>
</div>
<?php include '../components/foot.php'; ?>
</body>
</html>
