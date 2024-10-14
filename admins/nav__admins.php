<header class="">
<div class="sidebar" id="sidebar">
    <ul>
      <li class="" style="height: 100px;">
        <a href="#">
          <i class="toggle-btn" onclick="toggleSidebar()">
            <img src="../assets/images/ojc-round.png" alt="ojc-round" width="40px" height="40px" class="mr-1">
          </i>
          <span class="link-text ">OJC</span>
        </a>
      </li>
      <!-- <li class="active">
        <a href="#">
          <i class="fa fa-home"></i>
          <span class="link-text">Home</span>   
        </a>
      </li> -->
      <li>
        <a href="#">
          <i class="fa fa-tachometer"></i>
          <span class="link-text">Dashboard</span>
        </a>
      </li>
      <li>
        <a href="#">
          <i class="fa fa-briefcase"></i>
          <span class="link-text">Jobs</span>
        </a>
      </li>
      <li>
        <a href="#">
          <i class="fa fa-users"></i>
          <span class="link-text">Employer</span>
        </a>
      </li>
      <li>
        <a href="#">
          <i class="fa fa-users"></i>
          <span class="link-text">Employee</span>
        </a>
      </li>
    </ul>
    
    <ul>
    <?php if (!isset($_SESSION['user_id'])): ?>
        <li class="">
            <a href="<?php echo AUTH_URL; ?>/login.php">
                <i class="fa fa-user" aria-hidden="true"></i>
                <span class="username">
                    Login
                </span>
            </a>
        </li>
        <li class="">
            <a href="<?php echo AUTH_URL; ?>/register.php">
                <i class="fa fa-user" aria-hidden="true"></i>
                <span class="username">
                    Sign Up
                </span>
            </a>
        </li>
    <?php else: ?>
        <li class="">
            <a href="<?php echo ADMIN_URL; ?>/profile.php">
            <i class="fa fa-user" aria-hidden="true"></i>
                <span class="username">
                    <?php echo $_SESSION['user_name']; ?>
                </span>
            </a>
        </li>
        <li class="">
            <a href="<?php echo AUTH_URL; ?>/logout.php">
            <i class="fa fa-sign-out" aria-hidden="true"></i>
                <span class="username">
                    Logout
                </span>
            </a>
        </li>
    <?php endif; ?>
    </ul>
</div>

</header>

