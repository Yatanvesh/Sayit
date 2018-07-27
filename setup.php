
<?php
require_once 'functions.php';

createTable('quotes','quote varchar(4000),quoter varchar(16), INDEX(quoter(6))');

?>
