<?php  
require_once "functions.php";

# getting data from the table Branches
$rows_Branches = table_Branches ('select_all', NULL, NULL);

# submitting data to insert
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	# checking for duplicated entry
	$rowCount = table_Branches ('check_before_insert', NULL, NULL);

	if ($rowCount == 0) {
		# inserting data to the table Branches
		table_Branches ('insert', NULL, NULL);
	}
	else {
		$error = "Duplicate Entry!";
	}
}
?>
<!DOCTYPE html>
<html>
<?php  
$page_title = "Branches";
include "includes/head.php";
?>
<body>
	<!-- content -->
	<div class="content">
		<?php  
		$header = "Branches";
		include "includes/header.php";
		include "includes/nav.php";
		?>
		<main>
			<!-- big form -->
			<div class="form table">
				<form action="#" method="post">
					<table>
						<thead>
							<tr>
								<th colspan="2">Create New Branch</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>Name:</td>
								<td>
									<input type="text" name="Name" id="Name" placeholder="Branch Name">
								</td>
							</tr>
							<tr>
								<td colspan="2">
									<textarea name="Address" id="Address" cols="30" rows="6" placeholder="Address"></textarea>
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
								<td>Phone:</td>
								<td>
									<input type="text" name="Phone" id="Phone" placeholder="+95-9XXXXXXX">
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
									<button type="button" class="medium button" name="buttonSubmit" id="buttonSubmit" onclick="checkSixFields('Name', 'City', 'Name', 'Phone', 'Name', 'Name');">Create</button>
								</th>
							</tr>
						</tbody>
					</table>
				</form>
			</div>
			<!-- end of big form -->
			<!-- grid-div -->
			<div class="grid-div">
				<?php foreach ($rows_Branches as $row_Branches): ?>
					<!-- grid-item -->
					<div class="grid-item">
						<ul style="text-align: center;">
							<li class="bold"><? echo $row_Branches->Name;?></li>
							<li><? echo $row_Branches->Township.", ".$row_Branches->City; ?></li>
							<li>
								<a href="<? echo "edit_branch.php?BranchesId=$row_Branches->Id"; ?>">
									<button class="medium button">Edit</button>
								</a>
							</li>
						</ul>
					</div>
					<!-- end of grid-item -->
				<?php endforeach ?>
			</div>
			<!-- end of grid-div -->
		</main>
		<?php include "includes/footer.php"; ?>
	</div>
	<!-- end of content -->
</body>
<script type="text/javascript" src="scripts/main.js"></script>
</html>