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

//function to use data from the table Departments
function table_Departments ($job, $var1, $var2) {
	$database = new Database();

	switch ($job) {
		case 'check_before_insert':
			# getting data from the form
			$Department = trim($_REQUEST['Department']);
			$query = "SELECT * FROM Departments 
				WHERE Department = :Department
			;";
			$database->query($query);
			$database->bind(':Department', $Department);
			return $r = $database->rowCount();
			break;

		case 'insert':
			# getting data from the form
			$Department = trim($_REQUEST['Department']);
			$query = "INSERT INTO Departments SET 
				Department = :Department
			;";
			$database->query($query);
			$database->bind(':Department', $Department);
			if ($database->execute()) {
				header("location: departments.php");
			}
			break;

		case 'select_all':
			# getting all the data from the table Departments
			$query = "SELECT * FROM Departments ;";
			$database->query($query);
			return $r = $database->resultset();
			break;

		case 'value':
			# code...
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

		case 'check_before_insert':
			# getting data from the form
			$Username = trim($_REQUEST['Username']);

			$query = "SELECT Id FROM Users WHERE Username = :Username ;";
			$database->query($query);
			$database->bind(':Username', $Username);
			return $r = $database->rowCount();
			break;

		case 'insert':
			# gettings data from the form
			$Username = trim($_REQUEST['Username']);
			$Title = $_REQUEST['Title'];
			$Name = trim($_REQUEST['Name']);
			$Password = md5($_REQUEST['Password']);
			$Email = trim($_REQUEST['Email']);
			$Position = trim($_REQUEST['Position']);
			$DepartmentsId = $_REQUEST['DepartmentsId'];
			$BranchesId = $_REQUEST['BranchesId'];
			$Status = $_REQUEST['Status'];

			$query = "INSERT INTO Users SET 
				Username = :Username,
				Title = :Title,
				Name = :Name,
				Password = :Password,
				Email = :Email, 
				Position = :Position,
				DepartmentsId = :DepartmentsId,
				BranchesId = :BranchesId,
				Access = :Access,
				Status = :Status
			;";
			$database->query($query);
			$database->bind(':Username', $Username);
			$database->bind(':Title', $Title);
			$database->bind(':Name', $Name);
			$database->bind(':Password', $Password);
			$database->bind(':Email', $Email);
			$database->bind(':Position', $Position);
			$database->bind(':DepartmentsId', $DepartmentsId);
			$database->bind(':BranchesId', $BranchesId);
			$database->bind('Access', 1);
			$database->bind(':Status', $Status);
			if ($database->execute()) {
				header("location:users.php");
			}
			break;	

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

		case 'update_by_user':
			# $var1 = Users.Id
			# getting data from the form
			$Title = trim($_REQUEST['Title']);
			$Name = trim($_REQUEST['Name']);
			$Password = md5($_REQUEST['Password']);
			$Email = trim($_REQUEST['Email']);

			# no password is set by the user
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
				# If Password is set by the user 
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

		case 'update':
			# $var1 = UsersId
			$Username = trim($_REQUEST['Username']);
			$Title = $_REQUEST['Title'];
			$Name = trim($_REQUEST['Name']);
			$Email = trim($_REQUEST['Email']);
			$Position = trim($_REQUEST['Position']);
			$DepartmentsId = $_REQUEST['DepartmentsId'];
			$BranchesId = $_REQUEST['BranchesId'];
			$Status = $_REQUEST['Status'];

			# updating
			$query = "UPDATE Users SET 
				Username = :Username,
				Title = :Title,
				Name = :Name,
				Email = :Email,
				Position = :Position,
				DepartmentsId = :DepartmentsId,
				BranchesId = :BranchesId,
				Status = :Status
				WHERE Id = :UsersId
			;";
			$database->query($query);
			$database->bind(':Username', $Username);
			$database->bind(':Title', $Title);
			$database->bind(':Name', $Name);
			$database->bind(':Email', $Email);
			$database->bind(':Position', $Position);
			$database->bind(':DepartmentsId', $DepartmentsId);
			$database->bind(':BranchesId', $BranchesId);
			$database->bind(':Status', $Status);
			$database->bind(':UsersId', $var1);
			if ($database->execute()) {
				header("location: users.php");
			}
			break;	

		case 'select_all':
			$query = "SELECT  
				Users.Id, 
				Users.Username,
				Users.Title,
				Users.Name,
				Users.Password,
				Users.Email,
				Users.Position,
				Departments.Department, 
				Branches.Name AS BranchesName,
				Users.Access,
				Users.Status
				FROM Users 
				LEFT JOIN Departments 
				ON Departments.Id = Users.DepartmentsId
				LEFT JOIN Branches 
				ON Branches.Id = Users.BranchesId
			;";
			$database->query($query);
			return $r = $database->resultset();
			break;

		case 'reset_password':
			# $var1 = UsersId
			# $var2 = Email
			$Password = md5('goodluck'.date('d'));
			$query = "UPDATE Users SET 
				Password = :Password
				WHERE Id = :UsersId
			;";
			$database->query($query);
			$database->bind(':Password', $Password);
			$database->bind(':UsersId', $var1);
			if ($database->execute()) {
				$subject = 'Password Reset';
				$message = " 
				<p>
					Dear User, <br>
					Your new password is: 
					<span class=\"bold\">goodluck".date('d')."</span>
				<br>
				Best regards,
				<br>
				Database Team	
				</p>";
				$mail_header = "FROM: No Reply <noreply@nicefare-travels.com>\r\n";
				mail($var2, $subject, $message, $mail_header);
				header("location: users.php");
			}
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

		case 'select_all':
			# getting data from the table Organizations
			$query = "SELECT * FROM Organizations ;";
			$database->query($query);
			return $r = $database->resultset();
			break;	

		case 'select_one':
			# $var1 = OrganizationsId 
			$query = "SELECT 
				Organizations.Name, 
				Organizations.Branch,
				Organizations.Type,
				Organizations.Address,
				Organizations.Township,
				Organizations.City,
				Organizations.State,
				Countries.Country,
				Organizations.Website
				FROM Organizations 
				LEFT OUTER JOIN Countries
				ON Organizations.CountriesId = Countries.Id
				WHERE Organizations.Id = :OrganizationsId
			;";
			$database->query($query);
			$database->bind(':OrganizationsId', $var1);
			return $r = $database->resultset();
			break;

		case 'check_before_update':
			# $var1 = OrganizationsId
			# getting data from the form 
			$Name = trim($_REQUEST['Name']);
			$Branch = trim($_REQUEST['Branch']);
			$query = "SELECT * FROM Organizations 
				WHERE Name = :Name 
				AND Branch = :Branch 
				AND Id != :OrganizationsId
			;";
			$database->query($query);
			$database->bind(':Name', $Name);
			$database->bind(':Branch', $Branch);
			$database->bind(':OrganizationsId', $var1);
			return $r = $database->rowCount();
			break;	

		case 'update':
			# $var1 = OrganizationsId
			$Name = trim($_REQUEST['Name']);
			$Branch = trim($_REQUEST['Branch']);
			$Type = trim($_REQUEST['Type']);
			$Address = trim($_REQUEST['Address']);
			$Township = trim($_REQUEST['Township']);
			$City = trim($_REQUEST['City']);
			$State = trim($_REQUEST['State']);
			$CountriesId = $_REQUEST['CountriesId'];
			$Website = trim($_REQUEST['Website']);

			$query = "UPDATE Organizations SET 
				Name = :Name,
				Branch = :Branch,
				Type = :Type,
				Address = :Address,
				Township = :Township,
				City = :City,
				State = :State, 
				CountriesId = :CountriesId,
				Website = :Website
				WHERE Id = :OrganizationsId
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
			$database->bind(':OrganizationsId', $var1);
			if ($database->execute()) {
				header("location: organizations.php");
			}
			break;	
			
		default:
			# code...
			break;
	}
}

# funtion to use data from the table Clients
function table_Clients ($job, $var1, $var2) {
	$database = new Database();

	switch ($job) {
		case 'check_before_insert':
			# getting data from the form
			$Title = $_REQUEST['Title'];
			$Name = trim($_REQUEST['Name']);
			$DOB = $_REQUEST['DOB'];
			$NRC = trim($_REQUEST['NRC']);
			$query = "SELECT Id FROM Clients 
				WHERE Title = :Title 
				AND Name = :Name
				AND DOB = :DOB 
				AND NRC = :NRC
			;";
			$database->query($query);
			$database->bind(':Title', $Title);
			$database->bind(':Name', $Name);
			$database->bind(':DOB', $DOB);
			$database->bind(':NRC', $NRC);
			return $r = $database->rowCount();
			break;

		case 'count_rows':
			# counting rows to generate md5
			$query = "SELECT * FROM Clients ;";
			$database->query($query);
			return $r = $database->rowCount();
			break;	

		case 'insert':
			# $var1 = $md5
			# getting data from the form 
			$Title = $_REQUEST['Title'];
			$Name = trim($_REQUEST['Name']);
			$DOB = $_REQUEST['DOB'];
			$Mobile = trim($_REQUEST['Mobile']);
			$Email = trim($_REQUEST['Email']);
			$NRC = trim($_REQUEST['NRC']);
			$PassportNo = trim($_REQUEST['PassportNo']);
			$Expiry = $_REQUEST['Expiry'];
			$CountriesId = $_REQUEST['CountriesId'];
			$UsersId = $_SESSION['UsersId'];
			$rowCount = table_Clients ('count_rows', NULL, NULL);
			if ($_SESSION['BranchesId'] > 9) {
				$branch = $_SESSION['BranchesId'];
			}
			else {
				$branch = '0'.$_SESSION['BranchesId'];
			}

			if ($_SESSION['DepartmentsId'] > 9) {
				$dpt = $_SESSION['DepartmentsId'];
			}
			else {
				$dpt = '0'.$_SESSION['DepartmentsId'];
			}

			$clients = $rowCount + 1;

			if ($clients <= 9) {
				$zeros = '00000';
			}
			elseif ($clients <= 99) {
				$zeros = '0000';
			}
			elseif ($clients <= 999) {
				$zeros = '000';
			}
			elseif ($clients <= 9999) {
				$zeros = '00';
			}
			elseif ($clients <= 99999) {
				$zeros = '0';
			}
			else {
				$zeros = '';
			}

			$Member = $branch.$dpt.$zeros.$clients;
			$Code = md5($Member);

			# inserting data to the table Clients
			$query = "INSERT INTO Clients SET 
				Member = :Member,
				Code = :Code, 
				Title = :Title, 
				Name = :Name, 
				DOB = :DOB,
				Mobile = :Mobile, 
				Email = :Email,
				NRC = :NRC,
				PassportNo = :PassportNo,
				Expiry = :Expiry,
				CountriesId = :CountriesId,
				UsersId = :UsersId
			;";
			$database->query($query);
			$database->bind(':Member', $Member);
			$database->bind(':Code', $Code);
			$database->bind(':Title', $Title);
			$database->bind(':Name', $Name);
			$database->bind(':DOB', $DOB);
			$database->bind(':Mobile', $Mobile);
			$database->bind(':Email', $Email);
			$database->bind(':NRC', $NRC);
			$database->bind(':PassportNo', $PassportNo);
			$database->bind(':Expiry', $Expiry);
			$database->bind(':CountriesId', $CountriesId);
			$database->bind(':UsersId', $_SESSION['UsersId']);
			if ($database->execute()) {
				header("location: clients.php");
			}
			break;	

		case 'select_all':
			# getting data from the table Clients
			$query = "SELECT 
				Clients.Id,
				Clients.Code,
				Clients.QRLink,
				Clients.Member,
				Clients.Title,
				Clients.Name,
				Clients.DOB,
				Clients.Mobile,
				Clients.Email, 
				Clients.NRC,
				Clients.PassportNo,
				Clients.Expiry,
				Countries.Country
				FROM Clients 
				LEFT JOIN Countries 
				ON Clients.CountriesId = Countries.Id
			;";
			$database->query($query);
			return $r = $database->resultset();
			break;

		case 'select_one':
			# $var1 = ClientsId
			$query = "SELECT * FROM Clients WHERE Id = :ClientsId;";
			$database->query($query);
			$database->bind(':ClientsId', $var1);
			return $r = $database->resultset();	
			break;

		case 'check_before_update':
			# getting data from the form
			$Title = $_REQUEST['Title'];
			$Name = trim($_REQUEST['Name']);
			$DOB = $_REQUEST['DOB'];
			$Mobile = trim($_REQUEST['Mobile']);
			$Email = trim($_REQUEST['Email']);
			$NRC = trim($_REQUEST['NRC']);
			$PassportNo = trim($_REQUEST['PassportNo']);
			$Expiry = $_REQUEST['Expiry'];
			$CountriesId = $_REQUEST['CountriesId'];
			# checking for duplicate entry
			$query = "SELECT Id FROM Clients 
				WHERE Title = :Title 
				AND Name = :Name 
				AND DOB = :DOB 
				AND NRC = :NRC
				AND Id != :ClientsId 
			;";
			$database->query($query);
			$database->bind(':Title', $Title);
			$database->bind(':Name', $Name);
			$database->bind(':DOB', $DOB);
			$database->bind(':NRC', $NRC);
			$database->bind(':ClientsId', $var1);
			return $r = $database->rowCount();
			break;

		case 'update':
			# getting data from the form
			$Title = $_REQUEST['Title'];
			$Name = trim($_REQUEST['Name']);
			$DOB = $_REQUEST['DOB'];
			$Mobile = trim($_REQUEST['Mobile']);
			$Email = trim($_REQUEST['Email']);
			$NRC = trim($_REQUEST['NRC']);
			$PassportNo = trim($_REQUEST['PassportNo']);
			$Expiry = $_REQUEST['Expiry'];
			$CountriesId = $_REQUEST['CountriesId'];

			# updating 
			$query = "UPDATE Clients SET 
				Title = :Title,
				Name = :Name,
				DOB = :DOB,
				Mobile = :Mobile,
				Email = :Email, 
				NRC = :NRC,
				PassportNo = :PassportNo,
				Expiry = :Expiry,
				CountriesId = :CountriesId
				WHERE Id = :ClientsId
			;";
			$database->query($query);
			$database->bind(':Title', $Title);
			$database->bind(':Name', $Name);
			$database->bind(':DOB', $DOB);
			$database->bind(':Mobile', $Mobile);
			$database->bind(':Email', $Email);
			$database->bind(':NRC', $NRC);
			$database->bind(':PassportNo', $PassportNo);
			$database->bind(':Expiry', $Expiry);
			$database->bind(':CountriesId', $CountriesId);
			$database->bind(':ClientsId', $var1);
			if ($database->execute()) {
				header ("location: clients.php");
			}
			break;		
	
		default:
			# code...
			break;
	}
}

?>