

<?php
  include('class/db.class.php');
  include('class/register.class.php');
  $register = new Register();
  if(isset($_POST['email'])) {
    if($register->register($_POST['email'], $_POST['password'], $_POST['name'])) {
      echo "success";
    }
  }
?>
<form class="" action="<?=$_SERVER['PHP_SELF'];?>" method="post">
  <input type="email" name="email" value="">
  <input type="password" name="password" value="">
  <input type="name" name="name" value="">
  <input type="submit" name="submit" value="Submit">
</form>
