<?php  
require_once "functions.php";

# checking if the ClientsId is a number
check_num ($_REQUEST['ClientsId']);

# submitting data from the form
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	# checking for duplcate entry
	$rowCount = table_FFMembers ('check_before_insert', $_REQUEST['ClientsId'], NULL);
	if ($rowCount == 0) {
		# inserting data to the table FFMembers
		table_FFMembers ('insert', $_REQUEST['ClientsId'], NULL);
	}
	else {
		$error = "Duplicate entry!";
	}
}

# getting data from the table Clients
$rows_Clients = table_Clients ('select_one', $_REQUEST['ClientsId'], NULL, NULL, NULL);
foreach ($rows_Clients as $row_Clients) {
	# code...
}
?>
<!DOCTYPE html>
<html>
<?php  
$page_title = "Add Flyer";
include "includes/head.php";
?>
<body>
	<!-- content -->
	<div class="content">
		<?php  
		$header = "Frequent Flyer : ".$row_Clients->Name;
		include "includes/nav.php";
		include "includes/header.php";
		?>
		<main>
			<!-- form small table -->
			<div class="form small table">
				<form action="#" method="post">
					<table>
						<thead>
							<tr>
								<th>Frenquent No</th>
								<th>Frequent Flyer</th>
								<th>#</th>
							</tr>
							<tr>
								<td>
									<input type="text" name="FFNumber" id="FFNumber" placeholder="Frequent Flyer No">
								</td>
								<td>
									<select name="FrequentFlyersId" id="FrequentFlyersId">
										<option value="">Select One</option>
										<?php
										# getting data from the table FrequentFlyers
										$rows_FrequentFlyers = table_FrequentFlyers ('select_all', NULL, NULL);
										foreach ($rows_FrequentFlyers as $row_FrequentFlyers) {
											echo "<option value=\"$row_FrequentFlyers->Id\">".$row_FrequentFlyers->FrequentFlyer." -
											".$row_FrequentFlyers->Airline."</option>";
										}
										?>
									</select>
								</td>
								<td>
									<button type="button" class="medium button" name="buttonSubmit" id="buttonSubmit" onclick="checkSixFields('FFNumber', 'FFNumber', 'FFNumber', 'FrequentFlyersId', 'FrequentFlyersId', 'FrequentFlyersId')">Add</button>	
								</td>
							</tr>
							<tr>
								<th colspan="2" class="error">
									<?php if (!empty($error)) { echo $error; } ?>
								</th>		
							</tr>
						</thead>
					</table>
				</form>
			</div>
			<!-- end of form small table -->
		</main>
		<?php include "includes/footer.php"; ?>
	</div>
	<!-- end of content -->
</body>
<script type="text/javascript" src="scripts/main.js"></script>
</html>