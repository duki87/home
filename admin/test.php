<?php

if(isset($_COOKIE['admin_remember_drvo'])) {
  echo $_COOKIE['admin_remember_drvo'];
  $login = new Login();
  //$admin = $login->get_admin($_COOKIE['admin_remember_drvo']);
} else {
  header('Location: login.php');
}

?>
