<?php
  require_once('db.class.php');

  class AddBrand extends Database {

    private $connect;
    private $name;
    private $description;
    private $logo;

    function __construct($brand_name, $brand_description, $brand_logo) {
      $db = new Database();
      $this->connect = $db->connect();
      //prepare variables
      $this->name = $brand_name;
      $this->description = $brand_description;
      $this->logo = $brand_logo;
    }

    public function add_brand() {
      $query = "INSERT INTO brand
      (name, status, description, logo)
      VALUES (:name, :status, :description, :logo)";
      $statement = $this->connect->prepare($query);
      $statement->execute([
        ':name'            => $this->name,
        ':status'          => 1,
        ':description'     => $this->description,
        ':logo'            => $this->insert_logo($this->logo)
      ]);
      $result = $statement->fetchAll();
    }

    private function insert_logo($logo) {
      $file_name = $_FILES['logo']['name'];
      $tmp_name = $_FILES['logo']['tmp_name'];
      $file_array = explode('.', $file_name);
      $file_extension = end($file_array);
      $file_name = 'logo' . '-' . rand() . '.' . $file_extension;
      $location = 'img/brand_logos/' . $file_name;
      if(move_uploaded_file($tmp_name, $location)) {
        return $file_name;
      }
    }

    function __destruct() {
      echo 'brand_add';
    }

  }

?>
