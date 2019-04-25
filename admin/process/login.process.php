<?php
  session_start();
  require_once('../class/db.class.php');
  include('../class/login.class.php');


  if(isset($_POST['email']) && isset($_POST['password'])) {
    $login = new Login();
    $result = $login->login($_POST['email'], $_POST['password']);
    if($result == 'LOGGED_IN') {
      if(isset($_POST['remember_me']) && $_POST['remember_me'] == 1) {
        setcookie('admin_remember_drvo', $_SESSION['admin']['admin_id'], time() + (86400 * 30), '/home/admin/', 'localhost');
      }
      $_SESSION['admin']['login_message'] = 'Добродошли на верзију сајта за администраторе!';
      header('Location: index.php');
    } elseif ($result == 'NOT_REGISTERED') {
      $_SESSION['admin']['error_message'] = 'Нисте регистровани као администратор!';
      header('Location: ' . $_SERVER['HTTP_REFERER']);
    } elseif ($result == 'NOT_ACTIVE') {
      $_SESSION['admin']['error_message'] = 'Ваш налог није активан! Контактирајте администратора сајта.';
      header('Location: ' . $_SERVER['HTTP_REFERER']);
    } elseif ($result == 'PASSWORD_MISMATCH') {
      $_SESSION['admin']['error_message'] = 'Погрешна лозинка! Покушајте поново.';
      header('Location: ' . $_SERVER['HTTP_REFERER']);
    } else {
      $_SESSION['admin']['error_message'] = 'Дошло је до грешке!';
      header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
  }
