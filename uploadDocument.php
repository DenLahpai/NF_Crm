<?php  
require_once "functions.php";

# checking if ClientsId is a num
check_num($_REQUEST['ClientsId']);

# getting data from the table Clients
$rows_Clients = table_Clients ('select_one', $_REQUEST['ClientsId'], NULL, NULL, NULL);
foreach ($rows_Clients as $row_Clients) {
	# code...
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	table_Clients ('upload', NULL, NULL, NULL, NULL);
}
?>
<!DOCTYPE html>
<?php  
$page_title = 'Upload Document';
include "includes/head.php";
?>
<body>
	<!-- content -->
	<div class="content">
		<?php  
		include "includes/nav.php";
		$header = 'Upload Document  for '.$row_Clients->Title." ".$row_Clients->Name;
		include "includes/header.php";
		?>
		<main>
			<!-- big form -->
			<div class="big form">
				<form action="#" method="post" enctype="multipart/form-data">
					<table>
						<thead>
							<tr>
								<th>Upload a Document</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>
									<select name="DocType" id="DocType">
										<option value="">Select Document Type</option>
										<option value="Passport">Passport</option>
										<option value="NRC">NRC</option>
									</select>
								</td>
							</tr>
							<tr>
								<td>
									<input type="file" name="file" id="file">									
								</td>
								<td>
									<button type="button" class="medium button" id="buttonSubmit" onclick="checkSixFields('DocType', 'DocType', 'DocType', 'file', 'file', 'file')" >Upload</button>
								</td>
								<tr>
									<td class="error">
										<?php 
										if (!empty($error)) {
											echo $error;
										}
										?>
									</td>
								</tr>
							</tr>
						</tbody>
					</table>
				</form>
			</div>
			<!-- end of big form -->
		</main>
		<?php include "includes/footer.php"; ?>
	</div>
	<!-- end of content -->
</body>
<script type="text/javascript" src="scripts/main.js"></script>
</html>