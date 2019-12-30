<?php  
require_once "functions.php";
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<?php  
$page_title = "New Organization";
include "includes/head.php";

# Submitting data to insert
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	# Checking for duplication
	$rowCount = table_Organizations ('check_before_insert', NULL, NULL);
	if ($rowCount == 0) {
		# inserting data to the table Organizations
		table_Organizations ('insert', NULL, NULL);
	}
	else {
		$error = "Duplicate Entry!";
	}
}
?>
<body>
	<!-- content -->
	<div class="content">
		<?php  
		$header = "New Organization";
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
							<th colspan="2">Create a New Organization</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>Name:</td>
								<td>
									<input type="text" name="Name" id="Name" placeholder="Name of the organization" required>
								</td>
							</tr>
							<tr>
								<td>Branch:</td>
								<td>
									<input type="text" name="Branch" id="Branch" placeholder="Main Branch or City Branch">
								</td>
							</tr>
							<tr>
								<td>Type:</td>
								<td><input type="text" name="Type" id="Type" placeholder="Company, NGO, Gov, or Embassy"></td>
							</tr>
							<tr>
								<td colspan="2">
									<textarea name="Address" id="Addresss" cols="30" rows="6" placeholder="Address:"></textarea>
								</td>
							</tr>
							<tr>
								<td>Township:</td>
								<td>
									<input type="text" name="Township" id="Township" placeholder="Township">
								</td>
							</tr>
							<tr>
								<td>City:</td>
								<td>
									<input type="text" name="City" id="City" placeholder="City">
								</td>
							</tr>
							<tr>
								<td>
									State:
								</td>
								<td>
									<input type="text" name="State" id="State" placeholder="State/Division">
								</td>
							</tr>
							<tr>
								<td>
									Country:
								</td>
								<td>
									<select name="CountriesId" id="CountriesId">
										<option value="">Select One</option>
										<?php
										# getting data from the table Countries
										$rows_Countries = table_Countries ('select_all', NULL, NULL);
										foreach ($rows_Countries as $row_Countries) {
											echo "<option value=\"$row_Countries->Id\">".$row_Countries->Country."</option>";
										}
										?>
									</select>
								</td>
							</tr>
							<tr>
								<td>Website:</td>
								<td>
									<input type="text" name="Website" id="Website" placeholder="www.website.com">
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
									<button type="button" class="medium button" name="buttonSubmit" id="buttonSubmit" onclick="checkSixFields('Name', 'Type', 'City', 'CountriesId', 'Branch', 'City');">Create</button>
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