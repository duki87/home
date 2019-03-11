<?php
  require_once('db.class.php');
  require_once('vendor/autoload.php');
  use \Firebase\JWT\JWT;

  class Auth extends Database {

    private $connect;

    function __construct() {
      $db = new Database();
      $this->connect = $db->connect();
      define('SECRET_KEY', 'beerlanduser');
      define('ALGORITHM', 'HS512');
    }

  }
