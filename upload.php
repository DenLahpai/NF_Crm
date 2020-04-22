<?php
require_once "functions.php";
# checking if ClientsId is a number
check_num ($_REQUEST['ClientsId']);

#getting data from the table_Clients 
$rows_Clients = table_Clients ('select_one', $_REQUEST['ClientsId'], NULL, NULL, NULL);
foreach ($rows_Clients as $row_Clients);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	
	$DocType = $_REQUEST['DocType'];
	$file = $_FILES['file'];
	
	#getting the file extension
	$ext = explode('.', $file['name']);
	$file_ext = strtolower(end($ext));

	# checking if there is any error
	if ($file['error'] == 0) {

		# checking if file size is over 30MB
		if ($file['size'] <= 31457280) {

			# checking for allowed file extension
			$allowed_ext = array('jpg', 'jpeg', 'png');	
			if (in_array($file_ext, $allowed_ext)) {
				
				#checking for duplications
				$row_Count = table_Documents ('check_before_insert', NULL, NULL);
				if ($row_Count == 0) {
					# uploading the documents
					#generating file name
					$file_name = $DocType.'_ClientsId'.$row_Clients->Code.'.'.$file_ext;

					$file_destination = 'Documents/'.$file_name;
					move_uploaded_file($file['tmp_name'], $file_destination);

					# inserting file data to the table Documents
					table_Documents ('insert', NULL, $file_name);
				}
				else {
					# if there an existing documents sending the user some where
					echo "<span style=\"color: red;\">";
					echo "A ".$DocType." already exists for this client. <br>";
					echo "Please use the edit option to replace this client's exisiting ".$DocType.".<br>";
					echo "<a href=\"edit_client.php?ClientsId=".$_REQUEST['ClientsId']."\">Edit</a>";
					echo "</span>";
				}
			}
			else {
				# error for not allowed file extension
				echo "<span style=\"color: red;\">";
				echo "Only files with the following extensions are allowed: jpg, jpeg, png and pdf. <br>";
				echo "Please go back and try again!";
				echo "</span>";
			}
		}
		else {
			echo "<span class=\"error\" ";
			echo "The file size is too large! Please select a file that is smaller than 30MB";
			echo "Please go back and try again!";
			echo "</span>";
		}				
	}
	else {
		# Error in file upload
		echo "<span class=\"error\" ";
		echo "There was an error uploading file!";
		echo "Please go back and try again!";
		echo "</span>";
	}
}
?>