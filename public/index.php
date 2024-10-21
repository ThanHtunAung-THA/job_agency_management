<?php
session_start();
include '../includes/config.php';
?>
<?php include '../components/head.php'; ?>
<body>
<?php include '../navbars/nav.php'; ?>
<!-- slider section -->
<section class="slider_section ">
  <div class="container ">
    <div class="row">
      <div class="col-lg-7 col-md-8 mx-auto">
        <div class="detail-box">
          <h1>
            Build Your <br>
            POWERFUL CAREER
          </h1>
          <p>
            when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal
            distribution of letters, as opposed to
          </p>
        </div>
      </div>
    </div>
    <div class="find_container ">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="input-group input-group-lg container" style="width: 70%;">
              <input type="text" id="searchBar" class="form-control" placeholder="Search job">
              <span class="input-group-btn">
                <button id="searchBtn" type="button" class="btn btn-info" onclick="searchBar()">Go!</button>
              </span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
</div>
<!-- end slider section -->
  <!-- category section -->
  <section class="category_section">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-6 col-md-4 col-xl-2 px-0">
          <a href="<?php echo JOBS_URL; ?>/search.php?q=web des" class="box">
            <div class="img-box">
              <img src="../assets/images/c1.png" alt="">
            </div>
            <div class="detail-box">
              <h5>
                Web Design
              </h5>
            </div>
          </a>
        </div>
        <div class="col-sm-6 col-md-4 col-xl-2 px-0">
          <a href="<?php echo JOBS_URL; ?>/search.php?q=web dev" class="box">
            <div class="img-box">
              <img src="../assets/images/c2.png" alt="">
            </div>
            <div class="detail-box">
              <h5>
                Web Development
              </h5>
            </div>
          </a>
        </div>
        <div class="col-sm-6 col-md-4 col-xl-2 px-0">
          <a href="<?php echo JOBS_URL; ?>/search.php?q=graphic" class="box">
            <div class="img-box">
              <img src="../assets/images/c3.png" alt="">
            </div>
            <div class="detail-box">
              <h5>
                Graphic Design
              </h5>
            </div>
          </a>
        </div>
        <div class="col-sm-6 col-md-4 col-xl-2 px-0">
          <a href="<?php echo JOBS_URL; ?>/search.php?q=seo" class="box">
            <div class="img-box">
              <img src="../assets/images/c4.png" alt="">
            </div>
            <div class="detail-box">
              <h5>
                Seo marketing
              </h5>
            </div>
          </a>
        </div>
        <div class="col-sm-6 col-md-4 col-xl-2 px-0">
          <a href="<?php echo JOBS_URL; ?>/search.php?q=account" class="box">
            <div class="img-box">
              <img src="../assets/images/c5.png" alt="">
            </div>
            <div class="detail-box">
              <h5>
                Accounting
              </h5>
            </div>
          </a>
        </div>
        <div class="col-sm-6 col-md-4 col-xl-2 px-0">
          <a href="<?php echo JOBS_URL; ?>/search.php?q=content" class="box">
            <div class="img-box">
              <img src="../assets/images/c6.png" alt="">
            </div>
            <div class="detail-box">
              <h5>
                Content Writing
              </h5>
            </div>
          </a>
        </div>
      </div>
    </div>
  </section>
  <!-- end category section -->
<!-- about section -->
<section class="about_section layout_padding">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <div class="detail-box">
            <div class="heading_container">
              <h2>
                About Us
              </h2>
            </div>
            <p>
              At Overseas Job Central, we are a global team of innovators and experts dedicated to delivering exceptional solutions for businesses worldwide. With a presence in [number] countries and a diverse team of [number] employees, we bring together the best minds to tackle complex challenges and drive growth.
            </p>
            <p>
              Our mission is to empower businesses to succeed in an ever-changing global landscape. We achieve this by providing cutting-edge technology, expert consulting, and outstanding customer service. Our values of innovation, collaboration, and integrity guide everything we do, from developing bespoke solutions to building long-term relationships with our clients.
            </p>         
          </div>
          <a class="btn_link_lg" href="<?php echo PUBLIC_URL; ?>/about.php">
            Learn More About Our Story
          </a>          
        </div>
        <div class="col-md-6">
          <div class="img-box">
            <img src="../assets/images/about-img.jpg" alt="">
          </div>
        </div>
      </div>
    </div>
  </section>
<!-- end about section -->
<!-- job section -->
<section class="job_section layout_padding">
    <div class="container">
    <div class="heading_container heading_center">
        <h2>
        RECENT & FEATURED JOBS
        </h2>
    </div>
    <div class="job_container">
        <h4 class="job_heading">
        Featured Jobs
        </h4>
        <div class="row">
        <div class="col-lg-6">
            <div class="box">
            <div class="job_content-box">
                <div class="img-box">
                <img src="<?php echo ASSETS_URL; ?>/images/job_logo1.png" alt="">
                </div>
                <div class="detail-box">
                <h5>
                    Development Team Lead
                </h5>
                <div class="detail-info">
                    <h6>
                    <i class="fa fa-map-marker" aria-hidden="true"></i>
                    <span>
                        Washington. D.C.
                    </span>
                    </h6>
                    <h6>
                    <i class="fa fa-money" aria-hidden="true"></i>
                    <span>
                        $1200 - $1300
                    </span>
                    </h6>
                </div>
                </div>
            </div>
            <div class="option-box">
                <button class="fav-btn">
                <i class="fa fa-heart-o" aria-hidden="true"></i>
                </button>
                <a href="<?php echo JOBS_URL; ?>/search.php?q=67" class="apply-btn">
                Read More
                </a>
            </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="box">
            <div class="job_content-box">
                <div class="img-box">
                <img src="<?php echo ASSETS_URL; ?>/images/job_logo2.png" alt="">
                </div>
                <div class="detail-box">
                <h5>
                    Make my website responsive device compatible
                </h5>
                <div class="detail-info">
                    <h6>
                    <i class="fa fa-map-marker" aria-hidden="true"></i>
                    <span>
                        New York
                    </span>
                    </h6>
                    <h6>
                    <i class="fa fa-money" aria-hidden="true"></i>
                    <span>
                        $200 - $340
                    </span>
                    </h6>
                </div>
                </div>
            </div>
            <div class="option-box">
                <button class="fav-btn">
                <i class="fa fa-heart-o" aria-hidden="true"></i>
                </button>
                <a href="<?php echo JOBS_URL; ?>/search.php?q=68" class="apply-btn">
                Read More
                </a>
            </div>
            </div>
        </div>
        </div>
    </div>
    <div class="job_container">
        <h4 class="job_heading">
        Recent Jobs
        </h4>
        <div class="row">
        <div class="col-lg-6">
            <div class="box">
            <div class="job_content-box">
                <div class="img-box">
                <img src="<?php echo ASSETS_URL; ?>/images/job_logo3.png" alt="">
                </div>
                <div class="detail-box">
                <h5>
                    Looking Graphic Designer (Logo + UI)
                </h5>
                <div class="detail-info">
                    <h6>
                    <i class="fa fa-map-marker" aria-hidden="true"></i>
                    <span>
                        Washington. D.C.
                    </span>
                    </h6>
                    <h6>
                    <i class="fa fa-money" aria-hidden="true"></i>
                    <span>
                        $1200/mo
                    </span>
                    </h6>
                </div>
                </div>
            </div>
            <div class="option-box">
                <button class="fav-btn">
                <i class="fa fa-heart-o" aria-hidden="true"></i>
                </button>
                <a href="<?php echo JOBS_URL; ?>/search.php?q=69" class="apply-btn">
                Read More
                </a>
            </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="box">
            <div class="job_content-box">
                <div class="img-box">
                <img src="<?php echo ASSETS_URL; ?>/images/job_logo6.png" alt="">
                </div>
                <div class="detail-box">
                <h5>
                    Are you Typography Expert?
                </h5>
                <div class="detail-info">
                    <h6>
                    <i class="fa fa-map-marker" aria-hidden="true"></i>
                    <span>
                        New York
                    </span>
                    </h6>
                    <h6>
                    <i class="fa fa-money" aria-hidden="true"></i>
                    <span>
                        $56 - $90
                    </span>
                    </h6>
                </div>
                </div>
            </div>
            <div class="option-box">
                <button class="fav-btn">
                <i class="fa fa-heart-o" aria-hidden="true"></i>
                </button>
                <a href="<?php echo JOBS_URL; ?>/search.php?q=70" class="apply-btn">
                Read More
                </a>
            </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="box">
            <div class="job_content-box">
                <div class="img-box">
                <img src="<?php echo ASSETS_URL; ?>/images/job_logo5.png" alt="">
                </div>
                <div class="detail-box">
                <h5>
                    Looking WordPress Developer for ThemeForest
                </h5>
                <div class="detail-info">
                    <h6>
                    <i class="fa fa-map-marker" aria-hidden="true"></i>
                    <span>
                        Washington. D.C.
                    </span>
                    </h6>
                    <h6>
                    <i class="fa fa-money" aria-hidden="true"></i>
                    <span>
                        $400 - $540
                    </span>
                    </h6>
                </div>
                </div>
            </div>
            <div class="option-box">
                <button class="fav-btn">
                <i class="fa fa-heart-o" aria-hidden="true"></i>
                </button>
                <a href="<?php echo JOBS_URL; ?>/search.php?q=40" class="apply-btn">
                Read More
                </a>
            </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="box">
            <div class="job_content-box">
                <div class="img-box">
                <img src="<?php echo ASSETS_URL; ?>/images/job_logo4.png" alt="">
                </div>
                <div class="detail-box">
                <h5>
                    Hiring Web Designer for Project
                </h5>
                <div class="detail-info">
                    <h6>
                    <i class="fa fa-map-marker" aria-hidden="true"></i>
                    <span>
                        Washington. D.C.
                    </span>
                    </h6>
                    <h6>
                    <i class="fa fa-money" aria-hidden="true"></i>
                    <span>
                        $350 - $450
                    </span>
                    </h6>
                </div>
                </div>
            </div>
            <div class="option-box">
                <button class="fav-btn">
                <i class="fa fa-heart-o" aria-hidden="true"></i>
                </button>
                <a href="<?php echo JOBS_URL; ?>/search.php?q=1" class="apply-btn">
                Read More
                </a>
            </div>
            </div>
        </div>
        </div>
    </div>
    <div class="btn-box">
        <a href="<?php echo JOBS_URL; ?>/jobs.php">
        View All
        </a>
    </div>
    </div>
</section>
<!-- end job section -->
<!-- info section -->
<section class="info_section">
    <div class="container">
      <div class="row">
        <div class="col-md-2 info_links">
          <h4>
            Contact Us
          </h4>
          <ul>
            <li class="active">
              <a href="<?php echo PUBLIC_URL; ?>">
                Home
              </a>
            </li>
            <li>
              <a href="<?php echo PUBLIC_URL; ?>/about.php">
                About
              </a>
            </li>
            <li>
              <a class="" href="<?php echo PUBLIC_URL; ?>/contact.php">
                Contact
              </a>
            </li>
          </ul>
        </div>
        <div class="col-md-3">
          <h4>
            Get in Touch
          </h4>
          <p>
            We'd love to hear from you. Send us a message and we'll get back to you as soon as possible.
          </p>
        </div>
        <div class="col-md-3">
          <div class="info_social">
            <h4>
              Contact Information
            </h4>
            <p>
              Address: 123 Main St, Anytown, USA 12345<br>
              Phone 1: (+959) 798174380<br>
              Phone 2: (+959) 974847753<br>
              Email: <a href="mailto:t.thantunaung@gmail.com">info@m2y2.com</a>
            </p>
          </div>
        </div>
        <div class="col-md-4">
          <div class="info_form">
            <h4>
              Send a Message
            </h4>
            <form action="" id="contactForm">
              <input id="name" type="text" placeholder="Your Name"  required/>
              <input id="email" type="email" placeholder="Your Email"  required/>
              <input id="subj" type="text" placeholder="Subject"  required/>
              <textarea id="msg" placeholder="Message" required></textarea>
              <button id="sendButton" type="submit">
                Send Message
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
<!-- end info_section -->
<?php include '../components/footer.php'; ?>
<?php include '../components/foot.php'; ?>
</body>
</html>
