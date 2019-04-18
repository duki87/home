<?php
  session_start();
  include('class/login.class.php');

  $loginClass = new Login();
  $logout = $loginClass->logout();
  if(isset($_COOKIE['admin_remember_drvo'])) {
    //unset($_COOKIE['admin_remember_drvo']);
    setcookie("admin_remember_drvo", "", time() - 3600, "/home/admin/", "localhost", 1);
  }
  header('Location: login.php');
?>
