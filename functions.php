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

//function to use data from the table Branches
function table_Branches ($job, $var, $var2) {
	$database = new Database();

	switch ($job) {
		case 'check_before_insert':
			# getting data from the form
			$Name = trim($_REQUEST['Name']);
			$query = "SELECT Id FROM Branches WHERE Name = :Name ;";
			$database->query($query);
			$database->bind(':Name', $Name);
			return $r = $database->rowCount();
			break;

		case 'insert':
			# getting data from the form
			$Name = trim($_REQUEST['Name']);
			$Address = trim($_REQUEST['Address']);
			$Township = trim($_REQUEST['Township']);
			$City = trim($_REQUEST['City']);
			$Phone = trim($_REQUEST['Phone']);
			$query = "INSERT INTO Branches SET
				Name = :Name,
				Address = :Address,
				Township = :Township,
				City = :City, 
				Phone = :Phone
			;";
			$database->query($query);
			$database->bind(':Name', $Name);
			$database->bind(':Address', $Address);
			$database->bind(':Township', $Township);
			$database->bind(':City', $City);
			$database->bind(':Phone', $Phone);
			if ($database->execute()) {
				header("location: branches.php");
			}
			break;

		case 'select_all':		
			# code...
			$query = "SELECT * FROM Branches ;";
			$database->query($query);
			return $r = $database->resultset();
			break;
		default:
			# code...
			break;
	}
}

//function to use data from the table Users
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

		case 'select_all':
			$query = "SELECT * FROM Users ;";
			$database->query($query);
			return $r = $database->resultset();
			break;	
		
		default:
			# code...
			break;
	}
}

//function to use data from the table Countries 
function table_Countries ($job, $var1, $var2) {
	$database = new Database();

	switch ($job) {
		case 'check_before_insert':
			# getting data from the form
			$Code = $_REQUEST['Code'];
			$Country = trim($_REQUEST['Country']);
			# checking for duplication
			$query = "SELECT Id FROM Countries 
				WHERE Code = :Code 
				OR Country = :Country
				;";
			$database->query($query);
			$database->bind(':Code', $Code);
			$database->bind(':Country', $Country);
			return $r = $database->rowCount();	
			break;

		case 'insert':
			# getting data from the form 
			$Code = $_REQUEST['Code'];
			$Country = trim($_REQUEST['Country']);
			# inserting data to the table Countries
			$query = "INSERT INTO Countries SET 
				Code = :Code,
				Country = :Country
			;";
			$database->query($query);
			$database->bind(':Code', $Code);
			$database->bind(':Country', $Country);
			if ($database->execute()) {
				header("location: countries.php");
			}
			break;	

		case 'select_all':
			$query = "SELECT * FROM Countries WHERE Status != 0 ORDER BY Id ;";
			$database->query($query);
			return $r = $database->resultset();
			break;

		case 'select_one':
			# $var1 = CountriesId
			$query = "SELECT * FROM Countries WHERE Id = :CountriesId ;";
			$database->query($query);
			$database->bind(':CountriesId', $var1);
			return $r = $database->resultset();
			break;	

		case 'check_before_update':
			# $var1 = CountriesId

			# getting data from the form
			$Code = trim($_REQUEST['Code']);
			$Country = trim($_REQUEST['Country']);

			# checking by row count
			$query = "SELECT * FROM Countries WHERE 
				( Code = :Code 
				OR Country = :Country) 
				AND Id != :CountriesId
			;";
			$database->query($query);
			$database->bind(':Code', $Code);
			$database->bind(':Country', $Country);
			$database->bind(':CountriesId', $var1);
			return $r = $database->rowCount();
			break;		

		case 'update':
			# $var1 = CountriesId

			# getting data from the form
			$Code = trim($_REQUEST['Code']);
			$Country = trim($_REQUEST['Country']);

			# updating
			$query = "UPDATE Countries SET 
				Code = :Code, 
				Country = :Country 
				WHERE Id = :CountriesId
			;";
			$database->query($query);
			$database->bind(':Code', $Code);
			$database->bind(':Country', $Country);
			$database->bind(':CountriesId', $var1);
			if ($database->execute()) {
				header("location: countries.php");
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
			# getting data from the form
			$Name = trim($_REQUEST['Name']);
			$Branch = trim($_REQUEST['Branch']);
			$CountriesId = $_REQUEST['CountriesId'];
			$query = "SELECT Id FROM Organizations 
				WHERE Name = :Name
				AND Branch = :Branch
				AND CountriesId = :CountriesId
			;";
			$database->query($query);
			$database->bind(':Name', $Name);
			$database->bind(':Branch', $Branch);
			$database->bind(':CountriesId', $CountriesId);
			return $r = $database->rowCount();
			break;
		
		case 'insert': 
			# getting data from the form 
			$Name = trim($_REQUEST['Name']);
			$Branch = trim($_REQUEST['Branch']);
			$Type = trim($_REQUEST['Type']);
			$Address = trim($_REQUEST['Address']);
			$Township = trim($_REQUEST['Township']);
			$City = trim($_REQUEST['City']);
			$State = trim($_REQUEST['State']);
			$CountriesId = $_REQUEST['CountriesId'];
			$Website = trim($_REQUEST['Website']);
			# inserting data to the table
			$query = "INSERT INTO Organizations SET
				Name = :Name, 
				Branch = :Branch, 
				Type = :Type,
				Address = :Address,
				Township = :Township,
				City = :City,
				State = :State,
				CountriesId = :CountriesId,
				Website = :Website
			;"; 
			$database->query($query);
			$database->bind(':Name', $Name);
			$database->bind(':Branch', $Branch);
			$database->bind(':Type', $Type);
			$database->bind(':Address', $Address);
			$database->bind(':Township', $Township);
			$database->bind(':City', $City);
			$database->bind(':State', $State);
			$database->bind(':CountriesId', $CountriesId);
			$database->bind(':Website', $Website);
			if ($database->execute()) {
				header("location: organizations.php");
			}
			break;
		default:
			# code...
			break;
	}
}

?>