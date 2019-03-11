<?php
  include('parts/head.php');
  include('class/db.class.php');
  include('class/get-products.class.php');

  $pagination = '';
  $products = array();
  $get_products = new GetProducts();
  $products = $get_products->on_load();
  $pagination = $get_products->pagination();
  //print_r($products);
  if(isset($_GET['records_per_page'])) {
    $records_per_page = $_GET['records_per_page'];
    $sorting = $_GET['sort'];
    $column = $_GET['column'];
    $page_no = $_GET['page_no'];
    $_SESSION['admin']['sorting'] = $sorting;
    $_SESSION['admin']['column'] = $column;
    $_SESSION['admin']['records_per_page'] = $records_per_page;
    $_SESSION['admin']['page_no'] = $page_no;
    $get_products = new GetProducts($records_per_page, $page_no, $sorting, $column);
    $products = $get_products->get_products();
    $pagination = $get_products->pagination();
    //print_r($products);
  }
?>

<link rel="stylesheet" href="assets/css/table.css">
<div class="container">
  <div class="card text-center mt-2">
    <div class="card-header">
      <h2>List All Products</h2>
      <?php
        if(isset($_SESSION['admin']['get_products_message'])) {
          echo $_SESSION['admin']['get_products_message'];
        }
      ?>
    </div>
    <div class="card-body">
      <form class="" action="<?=$_SERVER["PHP_SELF"];?>" method="get">
        <input type="text" id="myInput" class="d-inline" onkeyup="myFunction()" placeholder="Search for names...">
        <input type="hidden" name="page_no" value="1">
        <select id="column" name="column" class="d-inline mySelect">
          <option value="name" <?php echo ($_SESSION['admin']['column'] == 'name') ? 'selected':'' ?>>Name</option>
          <option value="brand" <?php echo ($_SESSION['admin']['column'] == 'brand') ? 'selected':'' ?>>Brand</option>
          <option value="category" <?php echo ($_SESSION['admin']['column'] == 'category') ? 'selected':'' ?>>Category</option>
          <option value="price" <?php echo ($_SESSION['admin']['column'] == 'price') ? 'selected':'' ?>>Price</option>
          <option value="stock" <?php echo ($_SESSION['admin']['column'] == 'stock') ? 'selected':'' ?>>Stock</option>
        </select>

        <select name="records_per_page" class="d-inline mySelect" id="records_per_page">
          <option value="2" <?php echo ($_SESSION['admin']['records_per_page'] == '2') ? 'selected':'' ?>>2</option>
          <option value="5" <?php echo ($_SESSION['admin']['records_per_page'] == '5') ? 'selected':'' ?>>5</option>
          <option value="10" <?php echo ($_SESSION['admin']['records_per_page'] == '10') ? 'selected':'' ?>>10</option>
        </select>

        <select id="sort" name="sort" class="d-inline mySelect">
          <option value="ASC" <?php echo ($_SESSION['admin']['sorting'] == 'ASC') ? 'selected':'' ?>>Ascending</option>
          <option value="DESC" <?php echo ($_SESSION['admin']['sorting'] == 'DESC') ? 'selected':'' ?>>Descending</option>
        </select>

        <button type="submit" class="d-inline btn btn-primary">Apply</button>
      </form>
      <table id="myTable">
       <tr class="header">
         <th style="width:20%;">Name</th>
         <th style="width:10%;">Brand</th>
         <th style="width:10%;">Category</th>
         <th style="width:10%;">Price</th>
         <th style="width:10%;">Volume</th>
         <th style="width:10%;">Units</th>
         <th style="width:10%;">Pack</th>
         <th style="width:10%;">Stock</th>
       </tr>
       <?php foreach($products as $product) { ?>
       <tr>
         <td><?php echo $product['name'];?></td>
         <td><?php echo $product['brand'];?></td>
         <td><?php echo $product['category'];?></td>
         <td><?php echo $product['price'];?></td>
         <td><?php echo $product['volume'];?></td>
         <td><?php echo $product['units'];?></td>
         <td><?php echo $product['pack'];?></td>
         <td><?php echo $product['stock'];?></td>
       </tr>
      <?php } ?>
      </table>
    </div>
    <div class="card-footer text-muted">
      <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center">
          <?=$pagination;?>
        </ul>
      </nav>
    </div>
  </div>
</div>
<script type="text/javascript">
  $(document).ready(function() {
    $(document).on('click', '.page-link', function(e) {
      e.preventDefault();
      let page = $(this).attr('data-page_no');
      let column = $('#column').val();
      let records_per_page = $('#records_per_page').val();
      let sort = $('#sort').val();
      if(page == undefined) {
        return false;
      }
      window.location.replace("http://localhost/beerland/admin/products.php?page_no="+page+"&column="+column+"&records_per_page="+records_per_page+"&sort="+sort+"");
    });
  });
</script>
