<?php
session_start();
include '../includes/Database.php';
include '../includes/config.php';

$db = new Database();
$conn = $db->getConnection();
$searchQuery = $_GET['q'];
// Retrieve job data
$limit = 5;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($page - 1) * $limit;
$sql = "SELECT * FROM jobs WHERE id = '$searchQuery' OR job_title LIKE '%$searchQuery%' LIMIT $offset, $limit";
$results = $conn->query($sql);
// Get total number of rows
$sqlTotal = "SELECT COUNT(*) as total FROM jobs WHERE job_title LIKE '%$searchQuery%' ";
$resultTotal = $conn->query($sqlTotal);
$totalRows = $resultTotal->fetch_assoc()['total'];
$totalPages = ceil($totalRows / 5);
$db->close();
?>
<?php include '../components/head.php'; ?>
<body style="  background-image: linear-gradient(to right, #1f2766, #1f2766);">
<?php include '../navbars/nav.php'; ?>
<div class="jumbotron" style="margin-left: 0px;">
<!-- Search Bar Section -->
<section class="mt-5 mb-5">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="input-group input-group-lg">
          <input type="text" id="searchBar" class="form-control" placeholder="Search job"  value="<?php echo $searchQuery; ?>"> 

          <span class="input-group-btn">
            <button id="searchBtn" type="button" class="btn btn-info" onclick="searchBar()">Go!</button>
          </span>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Search Results Section -->
<section class="container">
  <div class="card">
    <div class="card-body">
      <h2>Search Results</h2>
      <ul class="list-group">
        <?php if ($results->num_rows > 0): ?>
          <?php while ($result = mysqli_fetch_array($results)): ?>
            <a href="detail.php?id=<?= $result['id']; ?>" class="job-listing-link">
            <li class="list-group-item">
                <h3><?= $result['job_title']; ?></h3>
                <p><?= substr($result['job_desc'], 0, 150); ?>...</p>
                <a href="detail.php?id=<?= $result['id']; ?>" class="btn btn-primary btn-jobs">Detail</a>
                </li>
            </a>
          <?php endwhile; ?>
        <?php else: ?>
          <p>No search results found.</p>
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
          <a class="page-link" href="?q=<?= $searchQuery; ?>&page=<?= $page - 1; ?>" aria-label="Previous">
            <span aria-hidden="true">&laquo;</span>
            <span class="sr-only">Previous</span>
          </a>
        </li>
      <?php endif; ?>
      <?php for ($i = 1; $i <= $totalPages; $i++): ?>
        <li class="page-item <?= $page == $i ? 'active' : ''; ?>">
          <a class="page-link" href="?q=<?= $searchQuery; ?>&page=<?= $i; ?>"><?= $i; ?></a>
        </li>
      <?php endfor; ?>
      <?php if ($page < $totalPages): ?>
        <li class="page-item">
          <a class="page-link" href="?q=<?= $searchQuery; ?>&page=<?= $page + 1; ?>" aria-label="Next">
            <span aria-hidden="true">&raquo;</span>
            <span class="sr-only">Next</span>
          </a>
        </li>
      <?php endif; ?>
    </ul>
  </nav>
</section>
</div>
<?php include '../components/foot.php'; ?>
</body>
</html>
