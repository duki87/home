<?php
  require_once('db.class.php');

  class AddCategory extends Database {

    private $connect;
    private $name;
    private $description;
    private $parent_id;

    function __construct($category_name, $category_description, $category_parent) {
      //$db = new Database();
      $this->connect = $this->connect();
      //prepare variables
      $this->name = $category_name;
      $this->description = $category_description;
      $this->parent_id = $category_parent;
    }

    public function add_category() {
      $id = '';
      if($this->parent_id == null) {
        $id = 0;
      } else {
        $id = $this->parent_id;
      }
      $query = "INSERT INTO category
      (parent_id, name, description, status)
      VALUES (:parent_id, :name, :description, :status)";
      $statement = $this->connect->prepare($query);
      $statement->execute([
        ':parent_id'       => $id,
        ':name'            => $this->name,
        ':description'     => $this->description,
        ':status'          => 1,
      ]);
      $result = $statement->fetchAll();
      return 'CATEGORY_ADD';
    }

    public static function get_categories() {
      $query = "SELECT * FROM category WHERE parent_id = 0";
      $statement = $this->connect->prepare($query);
      $statement->execute();
      $result = $statement->fetchAll();
      return $result;
    }

    function __destruct() {
      echo 'category_add';
    }

  }
