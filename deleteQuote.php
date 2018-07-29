<?php
require_once 'functions.php';

if(isset($_POST['id']))
{
  $deleteId= sanitizeString( $_POST['id']);
  queryMysql("Delete from quotes where id='$deleteId'");
  
}


?>
