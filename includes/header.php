<div class="hero_area">
<header class="header_section">
  <div class="container-fluid">

    <nav class="navbar navbar-expand-lg custom_nav-container ">
      <a class="navbar-brand" href="<?php echo PUBLIC_URL; ?>">
          <img src="../assets/images/ojc-round.png" alt="ojc-round" width="60px" height="60px">
          <span>Overseas Job Central</span>
      </a>

      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class=""> </span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav  ml-auto">
          <li class="nav-item">
              <a class="nav-link" href="<?php echo PUBLIC_URL; ?>"> Home </a>
          </li>
          <li class="nav-item">
              <a class="nav-link" href="<?php echo PUBLIC_URL; ?>/about.php"> About</a>
          </li>
          <li class="nav-item">
              <a class="nav-link" href="<?php echo PUBLIC_URL; ?>/contact.php"> Contact</a>
          </li>
          <li class="nav-item">
              <a class="nav-link" href="<?php echo JOBS_URL; ?>/jobs.php"> Jobs </a>
          </li>
          <?php if (!isset($_SESSION['user_id'])): ?>

          <li class="nav-item">
              <a class="nav-link" href="<?php echo AUTH_URL; ?>/login.php">
              <i class="fa fa-user" aria-hidden="true"></i>
              <span>
                  Login
              </span>
              </a>
          </li>
          <li class="nav-item">
              <a class="nav-link" href="<?php echo AUTH_URL; ?>/register.php">
              <i class="fa fa-user" aria-hidden="true"></i>
              <span>
                  Sign Up
              </span>
              </a>
          </li>
        <?php else: ?>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-expanded="false">
                    <?php echo $_SESSION['user_name']; ?>
                </a>
                <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <li>
                        <?php if ($_SESSION['role'] == 'employer'): ?>
                            <a class="dropdown-item" href="<?php echo EMPLOYER_URL; ?>/profile.php"> Profile <span class="text-danger">*</span></a>
                            <a class="dropdown-item" href="<?php echo EMPLOYER_URL; ?>/dashboard.php"> Dashboard <span class="text-danger">*</span></a>
                        <?php elseif ($_SESSION['role'] == 'employee'): ?>
                            <a class="dropdown-item" href="<?php echo EMPLOYEE_URL; ?>/profile.php"> Profile <span class="text-danger">*</span></a>
                            <a class="dropdown-item" href="<?php echo EMPLOYEE_URL; ?>/dashboard.php"> Dashboard <span class="text-danger">*</span></a>
                        <?php endif; ?>                    </li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="<?php echo AUTH_URL; ?>/logout.php">Logout</a></li>
                </ul>
            </li>          
        <?php endif; ?>
          </ul>
      </div>
    </nav>
  </div>
</header>
