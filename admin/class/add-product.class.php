<?php
  require_once('db.class.php');

  class AddProduct extends Database {

    private $connect;
    private $name;
    private $description;
    private $brand;
    private $category;
    private $materials;
    private $dimensions;
    private $weight;
    private $images;
    private $date_added;

    function __construct($product_name, $product_images, $product_materials, $product_dimensions, $product_weight, $product_brand, $product_category, $product_stock, $product_description) {
      $db = new Database();
      $this->connect = $db->connect();
      //prepare variables
      $this->name = $product_name;
      $this->brand = $product_brand;
      $this->category = $product_category;
      $this->images = $product_images;
      $this->description = $product_description;
      $this->materials = $product_materials;
      $this->weight = $product_weight;
      $this->description = $product_description;
    }

    public function add_product() {
      $query = "INSERT INTO product
      (name, brand, category, price, volume, units, pack, image, stock, description, date_added)
      VALUES (:name, :brand, :category, :price, :volume, :units, :pack, :image, :stock, :description, :date_added)";
      $statement = $this->connect->prepare($query);
      $statement->execute([
        ':name'             => $this->name,
        ':brand'            => $this->brand,
        ':category'         => $this->category,
        ':price'            => $this->price,
        ':volume'           => $this->volume,
        ':units'            => $this->units,
        ':pack'             => $this->pack,
        ':image'            => $this->insert_image($this->image),
        ':stock'            => $this->stock,
        ':description'      => $this->description,
        ':date_added'       => date("Y-m-d h:i:s")
      ]);
      $result = $statement->fetchAll();
    }

    private function insert_image($image) {
      $file_name = $_FILES['image']['name'];
      $tmp_name = $_FILES['image']['tmp_name'];
      $file_array = explode('.', $file_name);
      $file_extension = end($file_array);
      $file_name = 'img' . '-' . rand() . '.' . $file_extension;
      $location = 'img/products/' . $file_name;
      if(move_uploaded_file($tmp_name, $location)) {
        return $file_name;
      }
    }

    function __destruct() {
      echo 'product_add';
    }

  }

?>
