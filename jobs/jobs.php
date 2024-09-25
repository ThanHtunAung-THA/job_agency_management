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

$sql = "SELECT * FROM jobs LIMIT $offset, $limit";
$results = $conn->query($sql);

// Get total number of rows
$sqlTotal = "SELECT COUNT(*) as total FROM jobs";
$resultTotal = $conn->query($sqlTotal);
$totalRows = $resultTotal->fetch_assoc()['total'];
$totalPages = ceil($totalRows / $limit);
?>

<?php include '../includes/head.php'; ?>
<body style="background-image: linear-gradient(to right, #1f2766, #1f2766);">
<?php include '../includes/header.php'; ?>
<!-- content here -->
<div class="jumbotron" style="margin-left: 0px;">

<!-- Search Bar Section -->
<section class="mt-5 mb-5">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="input-group input-group-lg">
          <input type="text" id="searchBar" class="form-control" placeholder="Search job">
          <span class="input-group-btn">
            <button id="searchBtn" type="button" class="btn btn-info" onclick="searchBar()">Go!</button>
          </span>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Pagination Section -->
<section class="container mt-5">
  <nav aria-label="Page navigation">
    <ul class="pagination justify-content-center">
      <?php if ($page > 1): ?>
        <li class="page-item">
          <a class="page-link" href="?page=<?= $page - 1; ?>" aria-label="Previous">
            <span aria-hidden="true">&laquo;</span>
            <span class="sr-only">Previous</span>
          </a>
        </li>
      <?php endif; ?>
      <?php for ($i = 1; $i <= $totalPages; $i++): ?>
        <li class="page-item <?= $page == $i ? 'active' : ''; ?>">
          <a class="page-link" href="?page=<?= $i; ?>"><?= $i; ?></a>
        </li>
      <?php endfor; ?>
      <?php if ($page < $totalPages): ?>
        <li class="page-item">
          <a class="page-link" href="?page=<?= $page + 1; ?>" aria-label="Next">
            <span aria-hidden="true">&raquo;</span>
            <span class="sr-only">Next</span>
          </a>
        </li>
      <?php endif; ?>
    </ul>
  </nav>
</section>

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
                  <a href="detail.php?id=<?= $result['id']; ?>" class="btn btn-primary btn-apply">Detail</a>
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
<section class="container mt-5">
  <nav aria-label="Page navigation">
    <ul class="pagination justify-content-center">
      <?php if ($page > 1): ?>
        <li class="page-item">
          <a class="page-link" href="?page=<?= $page - 1; ?>" aria-label="Previous">
            <span aria-hidden="true">&laquo;</span>
            <span class="sr-only">Previous</span>
          </a>
        </li>
      <?php endif; ?>
      <?php for ($i = 1; $i <= $totalPages; $i++): ?>
        <li class="page-item <?= $page == $i ? 'active' : ''; ?>">
          <a class="page-link" href="?page=<?= $i; ?>"><?= $i; ?></a>
        </li>
      <?php endfor; ?>
      <?php if ($page < $totalPages): ?>
        <li class="page-item">
          <a class="page-link" href="?page=<?= $page + 1; ?>" aria-label="Next">
            <span aria-hidden="true">&raquo;</span>
            <span class="sr-only">Next</span>
          </a>
        </li>
      <?php endif; ?>
    </ul>
  </nav>
</section>
</div>

<?php include '../includes/foot.php'; ?>
</body>
</html>
