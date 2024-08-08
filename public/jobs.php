<?php session_start(); ?>
<?php include '../includes/head.php'; ?>
<body>
<?php include '../includes/header.php'; ?>
<!-- content here -->
  <div class="content-wrapper" style="margin-left: 0px;">

    <section class="mt-5 mb-5">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
          <!-- <h1 class="text-center">Latest Jobs</h1>   -->
            <div class="input-group input-group-lg">
                <input type="text" id="searchBar" class="form-control" placeholder="Search job">
                <span class="input-group-btn">
                  <button id="searchBtn" type="button" class="btn btn-info">Go!</button>
                </span>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section id="candidates" class="">
      <div class="container card">
        <div class="row card-body">
          <div class="col-md-3">
            <div class="box box-solid">
              <div class="box-header with-border">
                <h3 class="box-title">Filters</h3>
              </div>
              
              <div class="box-body no-padding">
                <ul class="nav nav-pills nav-stacked tree" data-widget="tree">
                  <li class="treeview menu-open">
                    <a href="#"><i class="fa fa-plane text-red"></i> City <span class="pull-right"><i class="fa fa-angle-down pull-right"></i></span></a>
                    <ul class="treeview-menu">
                      <li><a href=""  class="citySearch" data-target="Delhi"><i class="fa fa-circle-o text-yellow"></i> Delhi</a></li>
                      <li><a href="" class="citySearch" data-target="Kouba"><i class="fa fa-circle-o text-yellow"></i> Kouba</a></li>
                    </ul>
                  </li>
                  <li class="treeview menu-open">
                    <a href="#"><i class="fa fa-plane text-red"></i> Experience <span class="pull-right"><i class="fa fa-angle-down pull-right"></i></span></a>
                    <ul class="treeview-menu">
                      <li><a href="" class="experienceSearch" data-target='1'><i class="fa fa-circle-o text-yellow"></i> > 1 Years</a></li>
                      <li><a href="" class="experienceSearch" data-target='2'><i class="fa fa-circle-o text-yellow"></i> > 2 Years</a></li>
                      <li><a href="" class="experienceSearch" data-target='3'><i class="fa fa-circle-o text-yellow"></i> > 3 Years</a></li>
                      <li><a href="" class="experienceSearch" data-target='4'><i class="fa fa-circle-o text-yellow"></i> > 4 Years</a></li>
                      <li><a href="" class="experienceSearch" data-target='5'><i class="fa fa-circle-o text-yellow"></i> > 5 Years</a></li>
                    </ul>
                  </li>
                </ul>
              </div>
            </div>
          </div>

          <div class="col-md-9 card-body">

          <?php

          $limit = 5;

          $sql = "SELECT COUNT(id_jobpost) AS id FROM job_post";
          $result = $conn->query($sql);
          if($result->num_rows > 0)
          {
            $row = $result->fetch_assoc();
            $total_records = $row['id'];
            $total_pages = ceil($total_records / $limit);
          } else {
            $total_pages = 1;
          }

          ?>

          
            <div id="target-content">
              
            </div>
            <div class="text-center">
              <ul class="pagination text-center" id="pagination"></ul>
            </div> 



          </div>
        </div>
      </div>
    </section>
  </div>

<!-- content here -->
<?php include '../includes/footer.php'; ?>
<?php include '../includes/foot.php'; ?>
</body>
</html>