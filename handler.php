<?php
require_once 'functions.php';

if(isset($_POST['quote']))
{
  $userquote= sanitizeString($_POST['quote']);
  $username  = sanitizeString($_POST['quoter']);
  $ip = $_POST['ip'];

  session_start();
  $_SESSION['sessionUserName'] =$username;
  $result = queryMysql("INSERT INTO quotes (quote,quoter,ip) values('$userquote','$username','$ip')");
  $_POST['userquote'] = '';
  echo $connection->insert_id;
}

if(isset($_POST['deleteId']))
{
    $deleteId= sanitizeString( $_POST['deleteId']);
    $result = queryMysql("Delete from quotes where id='$deleteId'");
    echo $result;
}

if(isset($_POST['fetchQuoteById']))
{
  $fetchId = $_POST['fetchQuoteById'];
  $result = queryMysql("SELECT id,quote,quoter from quotes where id='$fetchId'");
  $row = $result->fetch_array(MYSQLI_BOTH);
  echo "<div class='quotecontainer'>";
  $id=$row['id'];
  echo "<div id='$id' class='quote' >#" . $row['id'] . ": ". $row['quote'] . "</div>";
  echo "<div class='quoter' >-" . $row['quoter'] . "</div>";
  echo "<img  class='trashImg' src='images/trash32.png' height='16'><br>";
  echo "</div>";

}

 ?>
