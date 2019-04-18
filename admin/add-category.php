<?php
include('parts/session.php');
include('class/db.class.php');
include('class/add-category.class.php');
include('class/get-categories.class.php');
if(!isset($_SESSION['admin']['admin_id'])) {
  header('Location: login.php');
}
include('parts/head.php');

if(isset($_POST['name'])) {
  $add_category = new AddCategory($_POST['name'], $_POST['description'], $_POST['parent_id']);
  if($add_category->add_category() == 'CATEGORY_ADD') {
    $message = 'Категорија је успешно унетa у базу!';
    //$message = $add_brand->add_brand();
    $_SESSION['admin']['add_category_message'] = $message;
    //header('Location: categories.php');
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
        <?php if(isset($_SESSION['admin']['add_category_message'])) { ?>
          <div class="alert alert-warning alert-dismissible" role="alert">
            <strong>Oбавештење</strong> <?=$_SESSION['admin']['add_category_message'];?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        <?php
          unset($_SESSION['admin']['add_category_message']);
          }
        ?>
        <div class="card text-center mt-2">
          <div class="card-header bg-primary" style="color:white">
            <h2>Додај нову категорију</h2>
          </div>
          <div class="card-body">
            <form action="<?=$_SERVER["PHP_SELF"];?>" method="POST" enctype="multipart/form-data">
              <div class="form-row col-md-6 mx-auto">
                <div class="col-md-12 mb-3">
                  <label for="validationTooltip01">Уколико желите да буде под-категорија, изберите најпре главну категорију</label>
                  <select class="form-control" name="parent_id">
                    <option value="">Изаберите</option>
                    <?php
                      $get_categories = new GetCategories();
                      $categories = $get_categories->list_categories();
                      for($i=0;$i<count($categories); $i++) {
                        echo $categories[$i];
                      }
                    ?>
                  </select>
                </div>
                <div class="col-md-12 mb-3">
                  <label for="validationTooltip01">Назив</label>
                  <input type="text" class="form-control" name="name" id="name" placeholder="Назив" value="" required>
                  <div class="valid-tooltip">
                    Looks good!
                  </div>
                </div>
                <div class="col-md-12 mb-3">
                  <label for="validationTooltip02">Опис категорије</label>
                  <textarea class="form-control" style="height:200px" id="description" name="description" placeholder="Опис категорије" required></textarea>
                </div>
              </div>
              <button class="btn btn-primary" type="submit">Додај категорију</button>
            </form>
          </div>
          <div class="card-footer text-muted">
            Најновије измене категорија погледајте <a href="categories.php">овде.</a>
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
