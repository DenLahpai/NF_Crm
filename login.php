<?php 
require_once "handler.php";

$database = new Database();
$Username = trim($_REQUEST['Username']);
$Password = $_REQUEST['Password'];

$query = "SELECT * FROM Users  
	WHERE BINARY Username = :Username
	AND BINARY Password = :Password
;";
$database->query($query);
$database->bind(':Username', $Username);
$database->bind(':Password', $Password);
$rowCount = $database->rowCount();
$rows = $database->resultset();
if ($rowCount > 0) {
    header("location: home.php");
    foreach ($rows as $row) {
        $_SESSION['UsersId'] = $row->Id;
        $_SESSION['Username'] = $row->Username;
        $_SESSION['Name'] = $row->Name;
    }
}
else {
    header("location: index.php?error=Wrong username or password!");
}
?>