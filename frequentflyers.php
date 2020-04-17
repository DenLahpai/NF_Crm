<?php  
require_once "functions.php";

#submitting data from the form 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	#checking for duplicate entry
	$rowCount = table_FrequentFlyers ('check_before_insert', NULL, NULL);
	if ($rowCount == 0) {
		# inserting data to the table FrequentFlyers
		table_FrequentFlyers ('insert', NULL, NULL);
	}
	else {
		$error = "Duplicate entry!";
	}
}

?>
<!DOCTYPE html>
<html>
<?php  
$page_title = "Frequent Flyers";
include "includes/head.php";
?>
<body>
	<!-- content -->
	<div class="content">
		<?php  
		$header = "Frequent Flyers";
		include "includes/nav.php";
		include "includes/header.php";
		?>
		<main>
			<!-- form small table  -->
			<div class="form small table">
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
									<input type="text" name="FrequentFlyer" id="FrequentFlyer" placeholder="Frequent Flyer">
								</td>
								<td>
									<select name="AirlinesId" id="AirlinesId">
										<option value="">Select One</option>
										<?php
										# getting data from the table Airlines
										$rows_Airlines = table_Airlines ('select_all', NULL, NULL);
										foreach ($rows_Airlines as $row_Airlines) {
											echo "<option value=\"$row_Airlines->Id\">".$row_Airlines->Airline."</option>";
										}	
										?>
									</select>								
								</td>
								<td>
									<input type="text" name="Alliance" id="Alliance" placeholder="Alliances / Partners">
								</td>
								<td>
									<button type="button" class="medium button" name="buttonSubmit" id="buttonSubmit" onclick="checkSixFields('FrequentFlyer', 'FrequentFlyer', 'FrequentFlyer', 'AirlinesId', 'AirlinesId', 'AirlinesId')">Add</button>
								</td>
							</tr>
							<tr>
								<th colspan="4" class="error">
									<?php if (!empty($error)) { echo $error; } ?>
								</th>
							</tr>
						</thead>
						<tbody>
							<?php  
							# getting data from the table FrequentFlyers
							$rows_FrequentFlyers = table_FrequentFlyers ('select_all', NULL, NULL);
							?>
							<?php foreach ($rows_FrequentFlyers as $row_FrequentFlyers): ?>
								<tr>
									<td><? echo $row_FrequentFlyers->FrequentFlyer; ?></td>
									<td><? echo $row_FrequentFlyers->Airline; ?></td>
									<td><? echo $row_FrequentFlyers->Alliance; ?></td>
									<td>
										<a href="<? echo "edit_frequentflyer.php?FrequentFlyersId=$row_FrequentFlyers->Id"; ?>">Edit</a>
									</td>
								</tr>
							<?php endforeach ?>
						</tbody>
					</table>
				</form>
			</div>
			<!-- end of form small table  -->
		</main>
		<?php include "includes/footer.php"; ?>
	</div>
	<!-- end of content -->
</body>
<script type="text/javascript" src="scripts/main.js"></script>
</html>