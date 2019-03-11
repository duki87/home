<?php
  require_once('vendor/autoload.php');
  include('parts/head.php');
  use \Firebase\JWT\JWT;
  define('SECRET_KEY', 'beerlanduser');
  define('ALGORITHM', 'HS512');

  $hostname = 'localhost';
  $username = 'root';
  $password = '';
  $database = 'beerland';
  $connect = '';
  $options = [
      \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
  ];

  $connect = new PDO("mysql:host=$hostname; dbname=$database", "$username", "$password", $options);

  $action = $_REQUEST['action'];
  if ($action == 'login' ) {
    $query = "SELECT * FROM users WHERE email = ?";
    $statement->$connect->prepare($query);
    $statement->$connect->execute(array(':name' => $_POST['email']));
    $row = $statement->fetch();
    //$hashAndSalt = password_hash($password, )
    if(count($row) > 0 && password_verify($row['password'])) {
      $tokenId = base64_encode(mcrypt_create_iv(32));
      $issuedAt = time();
      $notBefore = $issuedAt + 10; //Adding 10 seconds
      $expire = $notBefore + 7200; //Adding 60 seconds
      $serverName = 'http://localhost/beerland/';
    }

    /*
      * Create the token as an array
    */

      $data = [
               'iat'  => $issuedAt,         // Issued at: time when the token was generated
               'jti'  => $tokenId,          // Json Token Id: an unique identifier for the token
               'iss'  => $serverName,       // Issuer
               'nbf'  => $notBefore,        // Not before
               'exp'  => $expire,           // Expire
               'data' => [                  // Data related to the logged user you can set your required data
                         'id'   => $row['id'], // id from the users table
                         'name' => $row['name'], //  email
                ]
           ];
      $secretKey = base64_decode(SECRET_KEY);
      /// Here we will transform this array into JWT:
      $jwt = JWT::encode(
                $data, //Data to be encoded in the JWT
                $secretKey, // The signing key
                 ALGORITHM
               );
     $unencodedArray = ['jwt' => $jwt];
      echo  "{'status' : 'success','resp':".json_encode($unencodedArray)."}";
  } else {
    echo  "{'status' : 'error','msg':'Invalid email or password'}";
  }

  if ( $action == 'authenticate' ) {
     try {
     $secretKey = base64_decode(SECRET_KEY);
     $DecodedDataArray = JWT::decode($_REQUEST['tokVal'], $secretKey, array(ALGORITHM));

     echo  "{'status' : 'success' ,'data':".json_encode($DecodedDataArray)." }";die();

     } catch (Exception $e) {
      echo "{'status' : 'fail' ,'msg':'Unauthorized'}";die();
     }
   }
?>
<div class="container">
  <div class="row">
    <form class="form" id="frmLogin" method="post">
      <input type="email" name="" id="email" value="">
      <input type="password" id="password" name="" value="">
      <input type="submit" name="" value="Submit">
    </form>
  </div>
</div>
<script type="text/javascript">

/// here is our login form that we are using to post username and password information.
$("#frmLogin").submit(function(e){
      e.preventDefault();
      $.post('login.php?action=login', $("#frmLogin").serialize(), function(data){
    var data = jQuery.parseJSON(data);
    document.cookie="tokanVal="+ data['resp']['jwt']; /// you can set returned token in cookie or session and can send with each request to authenticate user
    window.location.reload(true);

      });

  });

// get your-token-value where you have set it in session , cookie or somewhere and send with each request that you want to authenticate .
$.post('login.php?action=authenticate&tokVal=your-token-value',function(resp)
		{
			//alert(resp);
			if (resp.success == true)
			{
				/// if token authenticated successfully
                                //// get your data
			}
			else
			{
                                /// if token authentication failed
			}
		},'json');
</script>
