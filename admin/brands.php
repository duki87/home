<?php
include('parts/head.php');
include('class/db.class.php');
include('class/get-brands.class.php');
if(!isset($_SESSION['admin']['admin_id'])) {
  header('Location: login.php');
}

$pagination = '';
$brands = array();

if(isset($_GET['records_per_page'])) {
  $records_per_page = $_GET['records_per_page'];
  $sorting = $_GET['sort'];
  $column = $_GET['column'];
  $page_no = $_GET['page_no'];
  $_SESSION['admin']['sorting'] = $sorting;
  $_SESSION['admin']['column'] = $column;
  $_SESSION['admin']['records_per_page'] = $records_per_page;
  $_SESSION['admin']['page_no'] = $page_no;
  $get_brands = new GetBrands($records_per_page, $page_no, $sorting, $column);
  $brands = $get_brands->get_brands();
  $pagination = $get_brands->pagination();
} else {
  $get_brands = new GetBrands();
  $brands = $get_brands->on_load();
  $pagination = $get_brands->pagination();
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
            <h2>Сви произвођачи</h2>
          </div>
          <div class="card-body">
            <form class="" action="<?=$_SERVER["PHP_SELF"];?>" method="get">
              <div class="row">
                <div class="col-md-4">
                  <input type="text" id="search" class="form-control" placeholder="Претражи произвођаче...">
                </div>
                <div class="col-md-2">
                  <input type="hidden" name="page_no" value="1">
                  <select id="column" name="column" class="form-control">
                    <option value="id" <?php echo ($_SESSION['admin']['column'] == 'id') ? 'selected':'' ?>>Ид</option>
                    <option value="name" <?php echo ($_SESSION['admin']['column'] == 'name') ? 'selected':'' ?>>Назив</option>
                  </select>
                </div>
                <div class="col-md-1">
                  <select name="records_per_page" class="form-control" id="records_per_page">
                    <option value="2" <?php echo ($_SESSION['admin']['records_per_page'] == '2') ? 'selected':'' ?>>2</option>
                    <option value="5" <?php echo ($_SESSION['admin']['records_per_page'] == '5') ? 'selected':'' ?>>5</option>
                    <option value="10" <?php echo ($_SESSION['admin']['records_per_page'] == '10') ? 'selected':'' ?>>10</option>
                  </select>
                </div>
                <div class="col-md-2">
                  <select id="sort" name="sort" class="form-control">
                    <option value="ASC" <?php echo ($_SESSION['admin']['sorting'] == 'ASC') ? 'selected':'' ?>>Опадајуће</option>
                    <option value="DESC" <?php echo ($_SESSION['admin']['sorting'] == 'DESC') ? 'selected':'' ?>>Растуће</option>
                  </select>
                </div>
                <div class="col-md-2">
                  <button type="submit" class="d-inline btn btn-primary">Примени</button>
                </div>
              </div>
            </form>
            <table id="brandTable" class="table table-striped mt-2">
             <tr class="header">
               <th style="width:20%;">Назив</th>
               <th style="width:10%;">Опис</th>
               <th style="width:10%;">Лого</th>
               <th style="width:10%;">Статус</th>
             </tr>
             <?php foreach($brands as $brand) { ?>
             <tr>
               <td><?php echo $brand['name'];?></td>
               <td><?php echo $brand['description'];?></td>
               <td><img src="<?php echo 'img/brand_logos/' . $brand['logo'];?>" alt="" style="width:100px"></td>
               <td>
                 <button class="btn <?=$brand['status']==1?'btn-success':'btn-warning';?>" type="button" name="changeStatus"><?=$brand['status']==1?'Активан':'Неактиван';?></button>
                 <button class="btn btn-danger mt-1 " type="button" name="removeBrand">Обриши брeнд</button>
               </td>
             </tr>
            <?php } ?>
            </table>
          </div>
          <div class="card-footer text-muted">
            <nav aria-label="Page navigation example" id="pagination_area">
              <ul class="pagination justify-content-center">
                <?=$pagination;?>
              </ul>
            </nav>
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
    $(document).on('click', '.page-link', function(e) {
      e.preventDefault();
      let page = $(this).attr('data-page_no');
      let column = $('#column').val();
      let records_per_page = $('#records_per_page').val();
      let sort = $('#sort').val();
      if(page == undefined) {
        return false;
      }
      window.location.replace("http://localhost/home/admin/brands.php?page_no="+page+"&column="+column+"&records_per_page="+records_per_page+"&sort="+sort+"");
    });

    $('#search').keyup(function(event) {
      const fd = new FormData();
      let keywords = event.target.value;
      fd.append('keywords', keywords);
      $.ajax({
        url:  'process/ajax.process.php',
        method: 'POST',
        data: fd,
        contentType: false,
        cache: false,
        processData: false,
        success: function(data) {
          let thead = '<tr class="header">'+
                         '<th style="width:20%;">Назив</th>'+
                         '<th style="width:10%;">Опис</th>'+
                         '<th style="width:10%;">Лого</th>'+
                         '<th style="width:10%;">Статус</th>'+
                       '</tr>';
          var tbody = '';
          var results = JSON.parse(data);
          console.log(JSON.parse(data));
          for(let result of results) {
            tbody += '<tr>';
            tbody += '<td>'+result.name+'</td>';
            tbody += '<td>'+result.description+'</td>';
            tbody += '<td><img src="img/brand_logos/'+result.logo+'" alt="" style="width:100px"></td>';
            tbody += '<td>'+result.status+'</td>';
            tbody += '</tr>';
          }
          $('#brandTable').html('');
          $('#pagination_area').html('');
          $('#brandTable').append(tbody);

        }
      });
      //console.log(event.target.value);
    });
  });
</script>
