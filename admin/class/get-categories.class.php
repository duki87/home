<?php
  require_once('db.class.php');

  class GetCategories extends Database {

    private $connect;
    private $per_page;
    private $page;
    private $sorting;
    private $column;
    private $result;

    function __construct($records_per_page = 5, $page_no = 1, $sorting_order = "DESC", $sorting_column = 'name') {
      $db = new Database();
      $this->connect = $db->connect();
      //prepare variables
      $this->per_page = $records_per_page;
      $this->page = $page_no;
      $this->sorting = $sorting_order;
      $this->column = $sorting_column;
    }

    public function on_load() {
      $_SESSION['admin']['sorting'] = '';
      $_SESSION['admin']['column'] = '';
      $_SESSION['admin']['records_per_page'] = 5;
      $_SESSION['admin']['page_no'] = '';
      $query = "SELECT * FROM category ORDER BY id DESC";
      $statement = $this->connect->prepare($query);
      $statement->execute();
      $this->result = $statement->fetchAll();
      $total_pages = ceil(count($this->result) / $this->per_page);
      $chunks = array_chunk($this->result, $this->per_page);
      return $chunks[$this->page-1];
    }

    public function get_categories() {
      $params = array();

      $query = "SELECT * FROM brand ORDER BY ";

      if($this->column == 'name') {
        $query .= "name $this->sorting";
      } else {
        $query .= "id $this->sorting";
      }
      // print_r($params);
      // echo $query;
      $statement = $this->connect->prepare($query);
      $statement->execute();
      $this->result = $statement->fetchAll();

      $total_pages = ceil(count($this->result) / $this->per_page);
      $chunks = array_chunk($this->result, $this->per_page);
      return $chunks[$this->page-1];
    }

    public function pagination() {
      $pagination = '';
      $total_pages = ceil(count($this->result) / $this->per_page);
      $page_no = $this->page;
      $prev = $page_no-1;
      $prev2 = $page_no-2;
      $next = $page_no+1;
      $next2 = $page_no+2;

      if($page_no == 1) {
        $pagination .= '<li class="page-item active"><a class="page-link" href="#">'.$page_no.'</a></li>';
          if($total_pages > 1) {
            $pagination .= '<li class="page-item"><a data-page_no="'.$next.'" class="page-link" href="#">2</a></li>';
          }
          if($total_pages > 2) {
            $pagination .= '<li class="page-item"><a data-page_no="'.$next2.'" class="page-link" href="#">3</a></li>';
          }
          if($total_pages != 1) {
            $pagination .= '<li class="page-item">
                        <a class="page-link" data-page_no="'.$next.'" href="#">Следеће</a>
                      </li>';
          }
      }

      if($page_no == $total_pages && $page_no != 1) {
        $pagination .= '
          <li class="page-item">
            <a class="page-link" data-page_no="'.$prev.'" href="#" tabindex="-1">Претходно</a>
          </li>';
          if($page_no != 2) {
            $pagination .= '<li class="page-item"><a data-page_no="'.$prev2.'" class="page-link" href="#">'.$prev2.'</a></li>';
          }
          $pagination .= '
            <li class="page-item"><a data-page_no="'.$prev.'" class="page-link" href="#">'.$prev.'</a></li>
            <li class="page-item active"><a class="page-link" href="#">'.$page_no.'</a></li>
        ';
      }

      if($page_no != 1 && $page_no != $total_pages) {
        $pagination .= '
          <li class="page-item">
            <a class="page-link" data-page_no="'.$prev.'" href="#" tabindex="-1">Претходно</a>
          </li>
          <li class="page-item"><a data-page_no="'.$prev.'" class="page-link" href="#">'.$prev.'</a></li>
          <li class="page-item active"><a class="page-link" href="#">'.$page_no.'</a></li>
          <li class="page-item"><a data-page_no="'.$next.'" class="page-link" href="#">'.$next.'</a></li>
          <li class="page-item">
            <a class="page-link" data-page_no="'.$next.'" href="#">Следеће</a>
          </li>
        ';
      }
      return $pagination;
    }

    public function search($keywords) {
      //return json_encode('aasdasd');
      $resultArr = array();
      $query = "SELECT * FROM brand WHERE name LIKE ?";
      $params = array();
      $params[] = "%$keywords%";
      $statement = $this->connect->prepare($query);
      $statement->execute($params);
      $resultArr = $statement->fetchAll();
      return json_encode($resultArr);
    }

    public function list_categories() {
      $arr = array();
      $query = "SELECT * FROM category WHERE status = 1 AND parent_id = 0";
      $statement = $this->connect->prepare($query);
      $statement->execute();
      $categories = $statement->fetchAll();
      foreach ($categories as $category) {
        $arr[] = '<option value="'.$category['id'].'">'.$category['name'].'</option>';
      }
      return $arr;
    }

    public function parent_name($parent_id) {
      $query = "SELECT name FROM category WHERE id = ?";
      $statement = $this->connect->prepare($query);
      $statement->execute([$parent_id]);
      $name = $statement->fetch();
      return $name['name'];
    }

    function __destruct() {
      //echo 'categories_get';
    }

  }

?>
