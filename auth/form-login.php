<?php include '../../includes/header.php'; ?>

<section class="p-3 p-md-4 p-xl-5">

    <?php if ($error): ?>
        <div class="error"><?= htmlspecialchars($error); ?></div>
    <?php endif; ?>

  <div class="container ">
    <div class="row fixed-height">
      <div class="col-12 col-md-6 bsb-tpl-bg-platinum card">
        <div class="d-flex flex-column justify-content-between  p-3 p-md-4 p-xl-5">
          <h3 class="m-0 ">Welcome!</h3>
          <img class="img-fluid rounded mx-auto my-4" src="../../assets/image/fallout-thumbsup.png" width="auto" height="auto" alt="thumbsup">

        </div>
      </div>
      <div class="col-12 col-md-6 bsb-tpl-bg-lotion card">
        <div class="p-3 p-md-4 p-xl-5">
          <div class="row">
            <div class="col-12">
              <div class="mb-5">
                <h3 class="">Log in</h3>
              </div>
            </div>
          </div>
          <form method="POST" class="card-body">
            <div class="row gy-3 gy-md-4 overflow-hidden">
              <div class="col-12">
                <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                <input type="email" class="form-control" name="email" id="email" placeholder="name@example.com" required>
              </div>
              <div class="col-12">
                <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                <input type="password" class="form-control" name="password" id="password" value="" placeholder="* * * * * * * *" required>
              </div>
              <div class="col-12">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="" name="remember_me" id="remember_me">
                  <label class="form-check-label text-secondary" for="remember_me">
                    Keep me logged in
                  </label>
                </div>
              </div>
              <div class="col-12">
                <div class="d-grid">
                  <button class="btn bsb-btn-xl btn-primary" type="submit">Log in now</button>
                </div>
              </div>
            </div>
          </form>
          <div class="row">
            <div class="col-12">
              <hr class="mt-5 mb-4 border-secondary-subtle">
              <p class="d-flex justify-content-between mb-0">
                <span>
                  <a href="register.php" class="link-secondary text-decoration-none hovering"> Register now </a><br/>
                  Not have an account yet?<br/>
                </span>
                <a href="password_reset.php" class="link-secondary text-decoration-none hovering">Forgot password ?</a>
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?php include '../../includes/footer.php'; ?>
