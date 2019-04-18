<?php
  include('parts/session.php');
  include('parts/head.php');
?>
<div id="wrapper">
  <?php include('parts/sidebar.php');?>
  <!-- Content Wrapper -->
  <div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

      <?php include('parts/topbar.php');?>
      <?php include('parts/dashboard.php');?>


    </div>
    <!-- End of Main Content -->

  </div>
  <!-- End of Content Wrapper -->
  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>
</div>
<?php include('parts/footer.php');?>
