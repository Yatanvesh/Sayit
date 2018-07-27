<?php
require_once 'header.html';
require_once 'functions.php';

if(isset($_POST['userquote']))
{
  $userquote= sanitizeString($_POST['userquote']);
  $username  = sanitizeString($_POST['quoter']);
  queryMysql("INSERT INTO quotes values('$userquote','$username')");
}

$result = queryMysql("SELECT quote,quoter from quotes");
$num    = $result->num_rows;

for ($j = 0 ; $j < $num ; ++$j)
{
  $row = $result->fetch_array(MYSQLI_ASSOC);
  echo "<div class='quote' >" . $row['quote'] . "</div>";
  echo "<div class='quoter' >-" . $row['quoter'] . "</div><br>";
}

echo <<< _END

<script >

$('#newquote').click(function()
{
$('#container').load('login.html')

})
</script>
</body>
</html>
_END

?>
