<?php
include('parts/head.php');
include('class/db.class.php');
include('class/add-product.class.php');
if(!isset($_SESSION['admin']['admin_id'])) {
  header('Location: login.php');
}

if(isset($_POST['name'])) {
  $add_product = new AddProduct($_POST['name'], $_POST['brand'], $_POST['category'], $_POST['price'], $_POST['volume'], $_POST['units'], $_POST['pack'], $_FILES['image'], $_POST['stock'], $_POST['description']);
  if($add_product->add_product()) {
    $message = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                  <strong>INFO</strong> Product Added Successfuly!
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>';
    $_SESSION['admin']['add_product_message'] = $message;
    header('location: product-sku.php');
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
      <div class="card text-center mt-2">
        <div class="card-header">
          <h2>Варијанте производа</h2>
          <?php
            if(isset($_SESSION['admin']['add_product_message'])) {
              echo $_SESSION['admin']['add_product_message'];
            }
          ?>
        </div>
        <div class="card-body">
          <form action="<?=$_SERVER["PHP_SELF"];?>" method="POST" enctype="multipart/form-data">
            <div class="form-row">
              <div class="col-md-3 mb-3">
                <label for="validationTooltip01">Назив</label>
                <input type="text" class="form-control" name="name" id="name" placeholder="Назив" value="" required>
                <div class="valid-tooltip">
                  Looks good!
                </div>
              </div>
              <div class="col-md-3 mb-3">
                <label for="validationTooltip02">Произвођач</label>
                <select class="form-control" id="brand" name="brand" required>
                  <option value="">Изаберите</option>
                </select>
              </div>
              <div class="col-md-3 mb-3">
                <label for="validationTooltip02">Категорија</label>
                <select class="form-control" id="category" name="category" required>
                  <option value="">Изаберите</option>
                </select>
              </div>
              <div class="col-md-3 mb-3">
                <label for="validationTooltip02">Под-категорија</label>
                <select class="form-control" id="parent_category" name="parent_category" required>
                  <option value="">Изаберите</option>
                </select>
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-4 mb-3">
                <label for="exampleFormControlSelect2">Материјали</label>
                <select multiple class="form-control" name="materials" id="materials" style="height:100px">
                  <option>Дрво</option>
                  <option>Стакло</option>
                  <option>Метал</option>
                  <option>Кожа</option>
                  <option>Штоф</option>
                </select>
              </div>
              <div class="form-group col-md-8 mb-3">
                <label for="exampleFormControlSelect2">Опис производа</label>
                <textarea class="form-control" name="description" id="description" style="height:100px"></textarea>
              </div>
              <div class="col-md-3 mb-3">
                <label for="validationTooltip04">Димензије</label>
                <input type="text" class="form-control" name="dimensions" id="dimensions" placeholder="Унесите димензије у mm" required>
                <div class="invalid-tooltip">
                  Please provide a valid state.
                </div>
              </div>
              <div class="col-md-3 mb-3">
                <label for="validationTooltip04">Маса</label>
                <input type="text" class="form-control" name="weight" id="weight" placeholder="Унесите масу у kg" required>
                <div class="invalid-tooltip">
                  Please provide a valid state.
                </div>
              </div>
              <div class="col-md-3 mb-3">
                <label for="validationTooltip04">Код</label>
                <input type="text" class="form-control" name="code" id="code" placeholder="Унесите код" required>
                <div class="invalid-tooltip">
                  Please provide a valid state.
                </div>
              </div>
            </div>
            <button class="btn btn-primary" type="submit">Додај производ</button>
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
<?php include('parts/footer.php');?>
