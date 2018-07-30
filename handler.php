<?php
require_once 'functions.php';

if(isset($_POST['quote']))
{
  $userquote= sanitizeString($_POST['quote']);
  $username  = sanitizeString($_POST['quoter']);
  $ip = $_POST['ip'];

  session_start();
  $_SESSION['sessionUserName'] =$username;
  queryMysql("INSERT INTO quotes (quote,quoter,ip) values('$userquote','$username','$ip')");
  $_POST['userquote'] = '';
}

if(isset($_POST['deleteId']))
{
    $deleteId= sanitizeString( $_POST['deleteId']);
    queryMysql("Delete from quotes where id='$deleteId'");
}

 ?>
