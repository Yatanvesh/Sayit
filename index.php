<?php
require_once 'header.html';
require_once 'functions.php';

if(isset($_GET['del']))
{
  $deleteId= sanitizeString($_GET['del']);
  queryMysql("Delete from quotes where id='$deleteId'");
}

if(isset($_POST['userquote']))
{
  $userquote= sanitizeString($_POST['userquote']);
  $username  = sanitizeString($_POST['quoter']);
  queryMysql("INSERT INTO quotes (quote,quoter) values('$userquote','$username')");
}

$result = queryMysql("SELECT id,quote,quoter from quotes");
$num    = $result->num_rows;
echo "<br>";
for ($j = 0 ; $j < $num ; ++$j)
{
  $row = $result->fetch_array(MYSQLI_BOTH);
  echo "<div class='quotecontainer'>";
  $id=$row['id'];
  echo "<div id='$id'class='quote' >#" . $row['id'] . ": ". $row['quote'] . "</div>";
  echo "<div class='quoter' >-" . $row['quoter'] . "</div>";
  echo "<span class='trash'><span data-icon='ei-trash' data-size=s></span></span><br>";
  echo "</div>";
}

echo <<< _END

<script >

$('#newquote').click(function()
{
$('#container').slideToggle(400)

$('#quotearea').focus()

})

$('.trash').click(function()
{

  var deleteId = $(this).siblings().first().attr('id')
  window.location.href="index.php?del=" + deleteId;


})
</script>
</body>
</html>
_END

?>
