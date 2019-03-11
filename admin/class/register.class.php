<?php
  require_once('db.class.php');

  class Register extends Database {

    private $connect;

    function __construct() {
      $db = new Database();
      $this->connect = $db->connect();
    }

    public function register($email, $password, $name) {
      $query = "INSERT INTO admins (email, password, name) VALUES (:email, :password, :name)";
      $statement = $this->connect->prepare($query);
      $statement->execute([
        ':email'      => $email,
        ':password'   => password_hash($password, PASSWORD_BCRYPT),
        ':name'       => $name
      ]);
      $result = $statement->fetchAll();
    }

  }
