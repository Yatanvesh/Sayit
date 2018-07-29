<?php
require_once 'functions.php';

if(isset($_POST['quote']))
{
  $userquote= sanitizeString($_POST['quote']);
  $username  = sanitizeString($_POST['quoter']);
  queryMysql("INSERT INTO quotes (quote,quoter) values('$userquote','$username')");
  $_POST['userquote'] = '';
}
 ?>
