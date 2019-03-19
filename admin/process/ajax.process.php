<?php
  require_once('../class/db.class.php');
  require_once('../class/get-brands.class.php');

  //get search results
  if(isset($_POST['keywords'])) {
    $get_brands = new GetBrands();
    $result = $get_brands->search($_POST['keywords']);
    echo $result;
    exit();
  }

?>
