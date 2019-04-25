<?php
  //session_start();

  class Database {
    private $hostname = 'localhost';
    private $username = 'root';
    private $password = '';
    private $database = 'home';
    private $connect = '';
    private $options = [
      \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
    ];

    protected function connect() {
      try {
        $this->connect = new PDO("mysql:host=$this->hostname; dbname=$this->database", "$this->username", "$this->password", $this->options);
        //echo 'Povezano!';
        if($this->connect) {
          //$this->connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          return $this->connect;
        }
      }
      catch(PDOException $e) {
        echo $e->getMessage();
      }
    }

    public function baseurl() {
      // return sprintf(
      //   "%s://%s%s",
      //   isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http',
      //   $_SERVER['SERVER_NAME'],
      //   $_SERVER['REQUEST_URI']
      // );
      // output: /myproject/index.php
      $currentPath = $_SERVER['PHP_SELF'];

      // output: Array ( [dirname] => /myproject [basename] => index.php [extension] => php [filename] => index )
      $pathInfo = pathinfo($currentPath);

      // output: localhost
      $hostName = $_SERVER['HTTP_HOST'];

      // output: http://
      $protocol = strtolower(substr($_SERVER["SERVER_PROTOCOL"],0,5))=='https://'?'https://':'http://';

      // return: http://localhost/myproject/
      return $protocol.$hostName.$pathInfo['dirname']."/";
    }
  }
?>
