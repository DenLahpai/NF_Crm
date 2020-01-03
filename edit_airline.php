<?php  
require_once "functions.php";

#checking if AirlinesId is a number
check_num($_REQUEST['AirlinesId']);

# submitting data from the form 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	# checking for duplication
	$rowCount = table_Airlines ('check_before_update', $_REQUEST['AirlinesId'], NULL);

	if ($rowCount == 0) {
		# updating
	}
	else {
		$error = "Duplicate entry!";
	}
}

#getting data fromt the table Airlines 
$rows_Airlines = table_Airlines ('select_one', $_REQUEST['AirlinesId'], NULL);
foreach ($rows_Airlines as $row_Airlines) {
	# code...
}
?>
<!DOCTYPE html>
<html>
<?php  
$page_title = "Edit Airline";
include "includes/head.php";
?>
<body>
	<!-- content -->
	<div class="content">
		<?php  
		$header = "Edit Airline";
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
								<th>Flight Code</th>
								<th>Airline</th>
								<th>Country</th>
								<th>#</th>
							</tr>
							<tr>
								<td>
									<input type="text" name="FlightCode" id="FlightCode" minlength="2" maxlength="2" size="2" value="<? echo $row_Airlines->FlightCode; ?>">
								</td>
								<td>
									<input type="text" name="Airline" id="Airline" value="<? echo $row_Airlines->Airline; ?>">
								</td>
								<td>
									<select id="CountriesId" name="CountriesId">
										<?php  
										# getting data from the table Countries
										$rows_Countries = table_Countries ('select_all', NULL, NULL);
										foreach ($rows_Countries as $row_Countries) {
											# checking if Countries Id = Airlines.CountriesId
											if ($row_Airlines->CountriesId == $row_Countries->Id) {
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
								<td>
									<button type="button" class="medium button" name="buttonSubmit" id="buttonSubmit" onclick="checkSixFields('FlightCode', 'FlightCode', 'Airline', 'Airline', 'CountriesId', 'CountriesId')">Add</button>
								</td>
							</tr>
							<tr>
								<th colspan="3" class="error">
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