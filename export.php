<?php  
require_once "functions.php";

$database = new Database ();
header ('Content-Type: text/csv; charset=utf-8');
header ('Content-Disposition: attachment; filename=data.csv');
$output = fopen("php://output", "w");
fputcsv($output, array('Username', 'Title', 'Name', 'Password', 'Email', 'Position', 'DepartmentsId', 'BranchesId', 'Access', 'Status', 'Created', 'Updated'));

$query = "SELECT * FROM Users ;";
$database->query($query);
$rows = $database->resultArray();
foreach ($rows as $row) {
	fputcsv($output, $row);
}
fclose($output);
?>