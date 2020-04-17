<?php  
require_once "functions.php";

# checking if FrequentFlyersId is a num
check_num ($_REQUEST['FrequentFlyersId']);


# submitting data from the form
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	# checking for duplicate entry
	$rowCount = table_FrequentFlyers ('check_before_update', $_REQUEST['FrequentFlyersId'], NULL);
	if ($rowCount == 0) {
		# updating data to the table FrequentFlyers
		table_FrequentFlyers ('update', $_REQUEST['FrequentFlyersId'], NULL);
	}
	else {
		$error = "Duplicate entry!";
	}
}

# getting data fromt the table FrequentFlyers 
$rows_FrequentFlyers = table_FrequentFlyers ('select_one', $_REQUEST['FrequentFlyersId'], NULL);
foreach ($rows_FrequentFlyers as $row_FrequentFlyers) {
	# code...
}

?>
<!DOCTYPE html>
<html>
<?php  
$page_title = "Edit Frequent Flyer";
include "includes/head.php";
?>
<body>
	<!-- content -->
	<div class="content">
		<?php  
		$header = "Edit Frequent Flyer";
		include "includes/header.php";
		include "includes/nav.php";
		?>
		<main>
			<!-- small table form -->
			<div class="small table form">
				<form action="#" method="post">
					<table>
						<thead>
							<tr>
								<th>Frequent Flyer</th>
								<th>Airline</th>
								<th>Alliance</th>
								<th>#</th>
							</tr>
							<tr>
								<td>
									<input type="text" name="FrequentFlyer" id="FrequentFlyer" value="<? echo $row_FrequentFlyers->FrequentFlyer; ?>">
								</td>
								<td>
									<select name="AirlinesId" id="AirlinesId">
										<?php  
										# getting data from the table Airlines
										$rows_Airlines = table_Airlines ('select_all', NULL, NULL);
										foreach ($rows_Airlines as $row_Airlines) {
											if ($row_FrequentFlyers->AirlinesId == $row_Airlines->Id) {
												echo "<option value=\"$row_Airlines->Id\" selected>".$row_Airlines->Airline."</option>";
											}
											else {
												echo "<option value=\"$row_Airlines->Id\">".$row_Airlines->Airline."</option>";
											}
										}
										?>
									</select>
								</td>
								<td>
									<input type="text" name="Alliance" id="Alliance" value="<? echo $row_FrequentFlyers->Alliance; ?>">
								</td>
								<td>
									<button type="button" class="medium button" name="buttonSubmit" id="buttonSubmit" onclick="checkSixFields('FrequentFlyer', 'FrequentFlyer', 'FrequentFlyer', 'AirlinesId', 'AirlinesId', 'AirlinesId')">Update</button>
								</td>
							</tr>
							<tr>
								<th colspan="4" class="error">
									<?php if (!empty($error)) { echo $error; } ?>
								</th>
							</tr>
						</thead>
					</table>
				</form>
			</div>
			<!-- end of small table form -->
		</main>
		<?php include "includes/footer.php"; ?>
	</div>
	<!-- end of content -->
</body>
<script type="text/javascript" src="scripts/main.js"></script>
</html>