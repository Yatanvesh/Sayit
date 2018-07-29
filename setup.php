
<?php
require_once 'functions.php';

createTable('quotes','quote varchar(4000),quoter varchar(16), id int not null auto_increment,primary key (id), INDEX(quoter(6))');

?>
