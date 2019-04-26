<?php
  session_start();
  // output: /myproject/index.php
  $currentPath = $_SERVER['PHP_SELF'];
  include('class/login.class.php');
  include('includes/url.php');

  // output: Array ( [dirname] => /myproject [basename] => index.php [extension] => php [filename] => index )
  $pathInfo = pathinfo($currentPath);
  $baseurl = $pathInfo['dirname'].'/';

  if(!isset($_SESSION['admin']['admin_id'])) {
    //Check if is set cookie to remember user
    if(isset($_COOKIE['admin_remember_drvo'])) {
      echo $_COOKIE['admin_remember_drvo'];
      $login = new Login();
      $admin = $login->get_admin($_COOKIE['admin_remember_drvo']);
    } else {
      header('Location: '.SITE_URL.'login.php');
    }
  }

?>
