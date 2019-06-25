<?php
include('parts/session.php');
include('class/add-brand.class.php');
//include('class/db.class.php');

if(!isset($_SESSION['admin']['admin_id'])) {
  header('Location: login.php');
}
include('parts/head.php');

if(isset($_POST['name'])) {
  $add_brand = new AddBrand($_POST['name'], $_POST['description'], $_FILES['logo']);
  if($add_brand->add_brand()) {
    $message = 'Бренд је успешно унет у базу!';
    //$message = $add_brand->add_brand();
    $_SESSION['admin']['add_brand_message'] = $message;
    header('Location: brands.php');
  }
}
?>
<div id="wrapper">
  <?php include('parts/sidebar.php');?>
  <!-- Content Wrapper -->
  <div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">
      <?php include('parts/topbar.php');?>
      <div class="container">
        <?php if(isset($_SESSION['admin']['add_brand_message'])) { ?>
          <div class="alert alert-warning alert-dismissible" role="alert">
            <strong>Oбавештење</strong> <?=$_SESSION['admin']['add_brand_message'];?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        <?php
          unset($_SESSION['admin']['add_brand_message']);
          }
        ?>
        <div class="card text-center mt-2">
          <div class="card-header bg-primary" style="color:white">
            <h2>Додај новог произвођача</h2>
          </div>
          <div class="card-body">
            <form action="<?=$_SERVER["PHP_SELF"];?>" method="POST" enctype="multipart/form-data">
              <div class="form-row col-md-6 mx-auto">
                <div class="col-md-12 mb-3">
                  <label for="validationTooltip01">Назив</label>
                  <input type="text" class="form-control" name="name" id="name" placeholder="Назив" value="" required>
                  <div class="valid-tooltip">
                    Looks good!
                  </div>
                </div>
                <div class="col-md-12 mb-3">
                  <label for="validationTooltip02">Опис произвођача</label>
                  <textarea class="form-control" style="height:200px" id="description" name="description" placeholder="Опис произвођача" required></textarea>
                </div>
                <div class="input-group col-md-12 mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text">Лого</span>
                  </div>
                  <div class="custom-file">
                    <input type="file" class="custom-file-input" name="logo" id="logo">
                    <label class="custom-file-label" for="inputGroupFile01">Изаберите фајл</label>
                  </div>
                </div>
                <div class="col-md-12 mb-3 d-none" id="logo_preview">
                  <label for="validationTooltip01">Преглед фотографијe</label>
                  <div class="">
                    <img src="" id="preview" style="width:200px; height:200px; object-fit:cover">
                  </div>
                </div>
              </div>
              <button class="btn btn-primary" type="submit">Додај бренд</button>
            </form>
          </div>
          <div class="card-footer text-muted">
            See latest product additions <a href="#">here</a>.
          </div>
        </div>
      </div>
    </div>
    <!-- End of Main Content -->
  </div>
  <!-- End of Content Wrapper -->
  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>
</div>
<script type="text/javascript">
  $(document).ready(function() {
    $(document).on('change', '#logo', function(e) {
      e.preventDefault();
      var url = URL.createObjectURL(e.target.files[0]);
      $('#logo_preview').removeClass('d-none');
      $('#preview').attr('src', url);
      if($('.removeLogo').length < 1) {
        $('#logo_preview').append('<button id="removeLogo" class="btn btn-danger btn-sm removeLogo">Избриши</button>');
      }
    });

    $(document).on('click', '#removeLogo', function(e) {
      e.preventDefault();
      $('#logo').val('');
      $('#logo_preview').addClass('d-none');
      $('#preview').attr('src', '');
    });

  });
</script>
<?php include('parts/footer.php');?>
