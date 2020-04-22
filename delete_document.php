<?php  
require_once "functions.php";

# getting data from the table Documents
$rows_Documents = table_Documents ('select_one', $_REQUEST['DocumentsId'], NULL);
foreach ($rows_Documents as $row_Documents) {
	# code...	
}

# getting full file path 
$delete_file = "Documents/".$row_Documents->FileName;
if (unlink($delete_file)) {
	table_Documents ('unlink_image', $_REQUEST['DocumentsId'], NULL);
}
else {
	echo "Error";
}
?>