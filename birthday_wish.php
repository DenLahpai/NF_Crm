<?php
require_once "functions.php";

#checking if ClientsId is a number
check_num ($_REQUEST['ClientsId']);

#inserting data to the table BirthdayWishes
table_BirthdayWishes ('insert', NULL, $_REQUEST['ClientsId']);

?>
