<?php
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
    <title>BEERLAND</title>
    <link rel="stylesheet" href="assets/css/main.css">
    <script src="<?=$baseurl.'assets/jquery/jquery-3.3.1.min.js';?>"></script>
    <link rel="stylesheet" href="<?=$baseurl.'assets/bootstrap/css/bootstrap.min.css';?>">
    <link rel="stylesheet" href="<?=$baseurl.'assets/bootstrap/css/bootstrap-grid.min.css';?>">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
  </head>
  </head>
  <body>
    <div class="container">
      <header class="main-header">
        <div class="col-md-12 ml-auto" style="position:relative">
          <img src="assets/img/hop.png" alt="" class="header-img img-fluid d-inline" style="">
          <h1 class="align-middle header-title d-inline" style="">Beer Land</h1>
        </div>

      </header>
      <div class="main-content">
        <div class="clearfix">
          <nav class="navbar navbar-expand-lg navbar-light" style="background-color:rgba(0,0,0,0.1);">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
              <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                  <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#">Beer</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#">Shop</a>
                </li>
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Customers
                  </a>
                  <div class="dropdown-menu dropdown-menu-right" style="background-color:rgba(0,0,0,0.1)" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="#">Log In</a>
                    <a class="dropdown-item" href="#">Sign Up</a>
                    <a class="dropdown-item" href="#">Something else here</a>
                  </div>
                </li>
              </ul>
            </div>
          </nav>
        </div>
