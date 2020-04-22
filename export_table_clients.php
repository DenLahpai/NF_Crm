<?php
require_once "functions.php";
//$job = $_REQUEST['job'];
//$limit = $_REQUEST['limit'];
//$Search = $_REQUEST['Search'];
//$sorting = $_REQUEST['sorting'];

header ('Content-Type: text/csv; charset=utf-8');
header ('Content-Disposition: attachment; filename=data.csv');
$output = fopen("php://output", "w");
$table_titles = array(
    'Id',
    'Code',
    'QR Link',
    'Memeber',
    'Title',
    'Name',
    'DOB',
    'Mobile',
    'Email',
    'NRC',
    'Passport No',
    'Expiry',
    'Create On',
    'Country',
    'Username'
);
fputcsv($output, $table_titles);

$rows_Clients = table_Clients ('select_all', 'array', NULL, 99999, 'ORDER BY Id ASC');
foreach ($rows_Clients as $row_Clients) {
    fputcsv($output, $row_Clients);
}
fclose($output);

?>