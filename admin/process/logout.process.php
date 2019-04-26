<?php
  session_start();
  //include('../class/login.class.php');
  include('../includes/url.php');

  $id = $_SESSION['admin']['admin_id'];
  unset($_SESSION['admin']['admin_id']);
  unset($_SESSION['admin']['admin_name']);
  if(isset($_COOKIE['admin_remember_drvo'])) {
    setcookie("admin_remember_drvo", $id, time() - 3600, '/home/admin/', 'localhost');
  }
  header('Location: '.SITE_URL.'login.php');
  exit();

?>
