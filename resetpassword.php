<?php  
require_once "functions.php";

//checking if the user id is a number
check_num ($_REQUEST['UsersId']);

# getting data from the table Users 
$rows_Users = table_Users ('select_one', $_REQUEST['UsersId'], NULL);
foreach ($rows_Users as $row_Users) {
	# code...
}

echo table_Users ('reset_password', $_REQUEST['UsersId'], $row_Users->Email);

?>
