<?php
require_once "functions.php";
check_access();

# submitting data to insert
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	# checking for duplication before inserting
	$rowCount = table_Countries ('check_before_insert', NULL, NULL);
	if ($rowCount == 0) {
		# inserting data
		table_Countries ('insert', NULL, NULL); //TODO need to test
	}
	else {
		$error = "Duplicate Entry!";
	}
}

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<?php
$page_title = "Countries";
include "includes/head.php";
?>
<body>
	<!-- content -->
	<div class="content">
		<?php
		$header = "Countries";
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
							</tr>
							<tr>
								<td>
									<input type="text" name="Code" id="Code" size="2" minlength="2" maxlength="2" placeholder="Code">
								</td>
								<td>
									<input type="text" name="Country" id="Country" placeholder="Country">
								</td>
								<td>
									<button type="button" class="medium button" name="buttonSubmit" id="buttonSubmit" onclick="checkSixFields('Code', 'Code', 'Code', 'Country', 'Country', 'Country')">Add</button>
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
							$rows_Countries = table_Countries ('select_all', NULL, NULL);
							?>
							<?php foreach ($rows_Countries as $row_Countries): ?>
								<tr>
									<td><? echo $row_Countries->Code; ?></td>
									<td><? echo $row_Countries->Country; ?></td>
									<td>
										<a href="<? echo "edit_country.php?CountriesId=$row_Countries->Id"; ?>">Edit</a>
									</td>
								</tr>
							<?php endforeach ?>
							<tr>
								<td colspan="3">Reference: <a href="https://www.iban.com/country-codes">https://www.iban.com/country-codes</a></td>
							</tr>
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
