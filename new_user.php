<?php  
require_once "functions.php";

# submitting data from the form
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	# checking for duplicate entry
	$rowCount = table_Users ('check_before_insert', NULL, NULL);

	if ($rowCount == 0) {
		# inserting data to the table Users
		table_Users ('insert', NULL, NULL);
	}
	else {
		$error = 'Duplicate entry!';
	}
}

//getting data from the table Departments
$rows_Departments = table_Departments ('select_all', NULL, NULL);
$rows_Branches = table_Branches ('select_all', NULL, NULL);
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<?php  
$page_title = "New User";
include "includes/head.php";
?>
<body>
	<!-- content -->
	<div class="content">
		<?php  
		$header = "New User";
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
								<th colspan="2">Create New User</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>Username:</td>
								<td>
									<input type="text" name="Username" id="Username" placeholder="Username">
								</td>
							</tr>
							<tr>
								<td>Title:</td>
								<td>
									<select name="Title" id="Title">
										<option>Select</option>
										<option value="Mr.">Mr.</option>
										<option value="Mrs.">Mrs.</option>
										<option value="Ms.">Ms.</option>
									</select>
								</td>
							</tr>
							<tr>
								<td>Name:</td>	
								<td>
									<input type="text" name="Name" id="Name" placeholder="Name Name">
								</td>
							</tr>
							<tr>
								<td>Password:</td>
								<td>
									<input type="text" name="Password" id="Password" value="NF@2020" title="default" readonly="readonly">
								</td>
							</tr>
							<tr>
								<td>
									Email:
								</td>
								<td>
									<input type="email" name="Email" id="Email" placeholder="email@email.com">
								</td>
							</tr>
							<tr>
								<td>Position:</td>
								<td>
									<input type="text" name="Position" id="Position" placeholder="Position">
								</td>
							</tr>
							<tr>
								<td>Department:</td>
								<td>
									<select name="DepartmentsId" id="DepartmentsId">
										<option value="">Select</option>
										<?php foreach ($rows_Departments as $row_Departments): ?>
											<option value="<? echo $row_Departments->Id; ?>"><? echo $row_Departments->Department; ?></option>
										<?php endforeach ?>
									</select>
								</td>
							</tr>
							<tr>
								<td>Branch:</td>
								<td>
									<select name="BranchesId" id="BranchesId">
										<?php foreach ($rows_Branches as $row_Branches): ?>
											<option value="<? echo $row_Branches->Id; ?>"><? echo $row_Branches->Name; ?></option>
										<?php endforeach ?>
									</select>
								</td>
							</tr>
							<tr>
								<td>Access:</td>
								<td>
									<select name="Access" id="Access">
										<option>To be advised</option>
									</select>
								</td>
							</tr>
							<tr>
								<td>Status:</td>
								<td>
									<select name="Status" id="Status">
										<option value="1">Active</option>
										<option value="0">Inactive</option>
									</select>
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
									<button type="button" class="medium button" name="buttonSubmit" id="buttonSubmit" onclick="checkSixFields('Username', 'Title', 'Name', 'Email', 'DepartmentsId', 'BranchesId');">Create</button>
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