<?php  
require_once "functions.php";

# checking if OrganiztionsId is a num
check_num ($_REQUEST['OrganizationsId']);

# submittig the data 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	# checking for duplicate entry!
	$rowCount = table_Organizations ('check_before_update', $_REQUEST['OrganizationsId'], NULL);

	if ($rowCount == 0) {
		# updateing the table Organizations
		table_Organizations ('update', $_REQUEST['OrganizationsId'], NULL);
	}
	else {
		$error = "Duplicate entry!";
	}
}

# getting data from the table Organizations
$rows_Organizations = table_Organizations ('select_one', $_REQUEST['OrganizationsId'], NULL);
foreach ($rows_Organizations as $row_Organizations) {
	# code...
}
?>
<!DOCTYPE html>
<html>
<?php  
$page_title = "Edit Organization";
include "includes/head.php";
?>
<body>
	<!-- content -->
	<div class="content">
		<?php 
		$header = "Edit Organization";
		include "includes/header.php";
		include "includes/nav.php";
		?>
		<main>
			<!-- big form -->
			<div class="big form">
				<form action="#" method="post">
					<table>
						<thead>
							<tr>
								<th colspan="2">Edit Organization</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>Name:</td>
								<td>
									<input type="text" name="Name" id="Name" value="<? echo $row_Organizations->Name; ?>">
								</td>
							</tr>
							<tr>
								<td>Branch:</td>
								<td>
									<input type="text" name="Branch" id="Branch" value="<? echo $row_Organizations->Branch; ?>">
								</td>
							</tr>
							<tr>
								<td>Type:</td>
								<td>
									<input type="text" name="Type" id="Type" value="<? echo $row_Organizations->Type; ?>">
								</td>
							</tr>
							<tr>
								<td colspan="2">
									<textarea name="Address" id="Addresss" cols="30" rows="6" placeholder="Address:"><? echo $row_Organizations->Address; ?></textarea>
								</td>
							</tr>
							<tr>
								<td>Township:</td>
								<td>
									<input type="text" name="Township" id="Township" value="<? echo $row_Organizations->Township; ?>">
								</td>
							</tr>
							<tr>
								<td>City:</td>
								<td>
									<input type="text" name="City" id="City" value="<? echo $row_Organizations->City; ?>">
								</td>
							</tr>
							<tr>
								<td>State:</td>
								<td>
									<input type="text" name="State" id="State" value="<? echo $row_Organizations->State; ?>">
								</td>
							</tr>
							<tr>
								<td>Country:</td>
								<td>
									<select id="CountriesId" name="CountriesId">
										<?php  
										# getting data from the table Countries
										$rows_Countries = table_Countries ('select_all', NULL, NULL);
										foreach ($rows_Countries as $row_Countries) {
											# checking if Organization countries is equal to CountriesId
											if ($row_Organizations->CountriesId == $row_Countries->Id) {
												# selected if equal
												echo "<option value=\"$row_Countries->Id\" selected>".$row_Countries->Country."</option>";
											}
											else {
												echo "<option value=\"$row_Countries->Id\">".$row_Countries->Country."</option>";
											}
										}
										?>
									</select>
								</td>
							</tr>
							<tr>
								<td>Website:</td>
								<td>
									<input type="text" name="Website" id="Website" value="<? echo $row_Organizations->Website; ?>">
								</td>
							</tr>
							<tr>
								<th colspan="2" class="error">
									<?php if (!empty($error)) {
										echo $error; 
									}
									?>
								</th>
							</tr>
							<tr>
								<th colspan="2">
									<button type="button" class="medium button" name="buttonSubmit" id="buttonSubmit" onclick="checkSixFields('Name', 'Type', 'City', 'CountriesId', 'Branch', 'City');">Update</button>
								</th>
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