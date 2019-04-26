<?php
  session_start();
  include('class/db.class.php');
  include('class/login.class.php');
  include('parts/head.php');
  include('includes/url.php');
?>

<div class="container">

  <!-- Outer Row -->
  <div class="row justify-content-center">

    <div class="col-xl-10 col-lg-12 col-md-9">

      <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
          <!-- Nested Row within Card Body -->
          <div class="row">
            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
            <div class="col-lg-6">
              <div class="p-5">
                <div class="text-center">
                  <h1 class="h4 text-gray-900 mb-4">Добродошли!</h1>
                </div>
                <?php if(isset($_SESSION['admin']['error_message'])) { ?>
                  <div class="alert alert-danger show fade" role="alert" id="error_message">
                    <?=$_SESSION['admin']['error_message'];?>
                  </div>
                <?php
                  }
                  unset($_SESSION['admin']['error_message']);
                ?>
                <form class="user" action="process/login.process.php" method="POST" id="loginForm">
                  <div class="form-group">
                    <input id="login__username" type="text" name="email"  aria-describedby="emailHelp" type="email" class="form-control form-control-user" placeholder="Унесите Е-маил адресу" required autofocus="">
                  </div>
                  <div class="form-group">
                    <input type="password" id="login__password" name="password" class="form-control form-control-user" placeholder="Унесите лозинку" required>
                  </div>
                  <div class="form-group">
                    <input type="checkbox" class="" name="remember_me" id="" value="1">
                    <label class="" for="customCheck">Запамти ме</label>
                  </div>
                  <input type="submit" class="btn btn-primary btn-user btn-block" value="Пријави се">
                  <hr>
                  <a href="index.html" class="btn btn-google btn-user btn-block">
                    <i class="fab fa-google fa-fw"></i> Google пријава
                  </a>
                  <a href="index.html" class="btn btn-facebook btn-user btn-block">
                    <i class="fab fa-facebook-f fa-fw"></i> Facebook пријава
                  </a>
                </form>
                <hr>
                <div class="text-center">
                  <a class="small" href="forgot-password.html">Forgot Password?</a>
                </div>
                <div class="text-center">
                  <a class="small" href="register.html">Create an Account!</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>

  </div>

</div>

<script type="text/javascript" src="assets/js/login.js"></script>
<?php include('parts/footer.php'); ?>
