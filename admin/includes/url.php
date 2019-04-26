<?php
  $protocol = stripos($_SERVER['SERVER_PROTOCOL'],'https') === true ? 'https://' : 'http://';
  DEFINE('SITE_URL', $protocol . $_SERVER['HTTP_HOST'].'/home/admin/');
?>
