<?php 
require_once "functions.php";
#checking if the country code is a num
check_num($_REQUEST['CountriesId']);

# submitting data from the form
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	# checking for duplicate entry
	$rowCount = table_Countries ('check_before_update', $_REQUEST['CountriesId'], NULL);
	if ($rowCount == 0) {
		# updating data to the table Countries
		table_Countries ('update', $_REQUEST['CountriesId'], NULL);
	}
	else {
		$error = "Duplicate Entry!";
	}
}

# getting data from the table Coutries 
$rows_Countries = table_Countries ('select_one', $_REQUEST['CountriesId'], NULL);
foreach ($rows_Countries as $row_Countries) {
	# code...
}

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<?php  
$page_title = "Edit Country";
include "includes/head.php";
?>
<body>
	<!-- content -->
	<div class="content">
		<?php  
		$header = "Edit Country";
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
								<th>Code</th>
								<th>Country</th>
								<th>#</th>
							<tr>
								<td>
									<input type="text" name="Code" id="Code" size="2" minlength="2" maxlength="2" value="<? echo $row_Countries->Code; ?>">
								</td>
								<td>
									<input type="text" name="Country" id="Country" value="<? echo $row_Countries->Country; ?>">
								</td>
								<td>
									<td>
									<button type="button" class="medium button" name="buttonSubmit" id="buttonSubmit" onclick="checkSixFields('Code', 'Code', 'Code', 'Country', 'Country', 'Country')">Update</button>
								</td>
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