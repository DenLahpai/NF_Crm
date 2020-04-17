<?php  
require_once "functions.php";

#submitting data from the form
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	# checking for duplication
	$rowCount = table_Airlines ('check_before_insert', NULL, NULL);
	if ($rowCount == 0) {
		# inserting data to the table Airlines 
		table_Airlines ('insert', NULL, NULL);
	}
	else {
		$error = "Duplicate entry!";
	}
}
?>
<!DOCTYPE html>
<html>
<?php  
$page_title = "Airlines";
include "includes/head.php";
?>
<body>
	<!-- content -->
	<div class="content">
		<?php  
		$header = "Airlines";
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
									<input type="text" name="FlightCode" id="FlightCode" minlength="2" maxlength="2" size="2">
								</td>
								<td>
									<input type="text" name="Airline" id="Airline" placeholder="Airline">
								</td>
								<td>
									<select id="CountriesId" name="CountriesId">
										<option value="">Select</option>
										<?php  
										# getting data from the table Countries
										$rows_Countries = table_Countries ('select_all', NULL, NULL);
										foreach ($rows_Countries as $row_Countries) {
											echo "<option value=\"$row_Countries->Id\">".$row_Countries->Country."</option>";
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
						<tbody>
							<?php  
							# getting data from the table Airlines 
							$rows_Airlines = table_Airlines ('select_all', NULL, NULL);
							?>
							<?php foreach ($rows_Airlines as $row_Airlines): ?>
								<tr>
									<td><? echo $row_Airlines->FlightCode; ?></td>
									<td><? echo $row_Airlines->Airline; ?></td>
									<td><? echo $row_Airlines->Country?></td>
									<td><a href="<? echo "edit_airline.php?AirlinesId=$row_Airlines->Id"; ?>">Edit</a></td>
								</tr>
							<?php endforeach ?>
						</tbody>
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