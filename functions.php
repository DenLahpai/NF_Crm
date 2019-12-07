<?php 
require_once "handler.php";

// checking if the user is logged in
if (empty($_SESSION['UsersId'])) {
    header("location: index.php");
    $_SESSION['msg_error'] = 'Session Expired!';
}

//checking if a variable is a number
function check_num ($num) {
    if (!is_numeric($num)) {
        echo "There was a problem! Please go back and try again!";
        die();
    }
}

//getting data from the table Users 
function table_Users ($job, $var1, $var2) {
	$database = new Database();
	switch ($job) {

		case 'check_before_update':
			# var1 = Users.Id
			$Name = trim($_REQUEST['Name']);
			$Email = trim($_REQUEST['Email']);
			$query = "SELECT * FROM Users 
				WHERE Name = :Name
				AND Email = :Email 
				AND Id != :UsersId
			;";
			$database->query($query);
			$database->bind(':Name', $Name);
			$database->bind(':Email', $Email);
			$database->bind(':UsersId', $var1);
			return $r = $database->rowCount();
			break;

		case 'select_one':
			# var1 = Users.Id
			$query = "SELECT * FROM Users WHERE Id = :UsersId ;";
			$database->query($query);
			$database->bind(':UsersId', $var1);
			return $r = $database->resultset();
			break;	

		case 'update':
			# $var1 = Users.Id
			# getting data from the form
			$Title = trim($_REQUEST['Title']);
			$Name = trim($_REQUEST['Name']);
			$Password = $_REQUEST['Password'];
			$Email = trim($_REQUEST['Email']);
			if (empty($Password) || $Password == NULL || $Password == " ") {
				# If Password is not set by the user
				$query = "UPDATE Users SET 
					Title = :Title, 
					Name = :Name, 
					Email = :Email
					WHERE Id = :UsersId
				;";
				$database->query($query);
				$database->bind(':Title', $Title);
				$database->bind(':Name', $Name);
				$database->bind(':Email', $Email);
				$database->bind(':UsersId', $var1);
			} 
			else {
				# If Password is et the user 
				$query = "UPDATE Users SET 
					Title = :Title,
					Name = :Name, 
					Password = :Password,
					Email = :Email 
					WHERE Id = :UsersId
				;";
				$database->query($query);
				$database->bind(':Title', $Title);
				$database->bind(':Name', $Name);
				$database->bind('Password', $Password);
				$database->bind(':Email', $Email);
				$database->bind(':UsersId', $var1);
			}
			if ($database->execute()) {
				header("location: logout.php");
			}
			break;
		
		default:
			# code...
			break;
	}
}

//function to use data from the table Organizations
function table_Organizations ($job, $var1, $var2) {
	$database = new Database();

	switch ($job) {
		case 'check_before_insert':
			# code...
			break;
		
		default:
			# code...
			break;
	}
}

?>