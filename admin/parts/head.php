<?php
  session_start();
  // output: /myproject/index.php
  $currentPath = $_SERVER['PHP_SELF'];

  // output: Array ( [dirname] => /myproject [basename] => index.php [extension] => php [filename] => index )
  $pathInfo = pathinfo($currentPath);
  $baseurl = $pathInfo['dirname'].'/';
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Dusan Marinkovic">
    <title>Дрво</title>
    <link rel="stylesheet" href="assets/css/main.css">
    <script src="<?=$baseurl.'assets/jquery/jquery-3.3.1.min.js';?>"></script>
    <link rel="stylesheet" href="<?=$baseurl.'assets/bootstrap/css/bootstrap.min.css';?>">
    <link rel="stylesheet" href="<?=$baseurl.'assets/bootstrap/css/bootstrap-grid.min.css';?>">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
    <link href="assets/css/sb-admin-2.min.css" rel="stylesheet">
    <!-- Custom fonts for this template-->
    <link href="../assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <!-- Page level plugin CSS-->
    <link href="../assets/vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
  </head>
  <body id="page-top">
