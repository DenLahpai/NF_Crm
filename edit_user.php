<?php
require_once "functions.php";

check_access();

//checking if the user id is a number
check_num ($_REQUEST['UsersId']);

# submitting data from the form
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	# checking for duplicate entry
	$rowCount = table_Users ('check_before_update', $_REQUEST['UsersId'], NULL);
	if ($rowCount == 0) {
		table_Users ('update', $_REQUEST['UsersId'], NULL);
	}
	else {
		$error = "Duplicate Entry!";
	}
}

# getting data from the table Users
$rows_Users = table_Users ('select_one', $_REQUEST['UsersId'], NULL);
foreach ($rows_Users as $row_Users) {
	# code...
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<?php
$page_title = "Edit User";
include "includes/head.php";
?>
<body>
	<!-- content -->
	<div class="content">
		<?php
		$header = "Edit User";
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
								<th colspan="2">Edit User</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>
									Username:
								</td>
								<td>
									<input type="text" name="Username" id="Username" value="<? echo $row_Users->Username; ?>">
								</td>
							</tr>
							<tr>
								<td>
									Title: <span class="invisible" id="selected_Title"><? echo $row_Users->Title; ?></span>
								</td>
								<td>
									<select name="Title" id="Title">
										<option value="Mr.">Mr.</option>
                                       	<option value="Mrs.">Mrs.</option>
                                       	<option value="Ms.">Ms.</option>
									</select>
								</td>
							</tr>
							<tr>
								<td>
									Name:
								</td>
								<td>
									<input type="text" name="Name" id="Name" value="<? echo $row_Users->Name; ?>">
								</td>
							</tr>
							<tr>
								<td>
									Email:
								</td>
								<td>
									<input type="text" name="Email" id="Email" value="<? echo $row_Users->Email; ?>">
								</td>
							</tr>
							<tr>
								<td>
									Position:
								</td>
								<td>
									<input type="text" name="Position" id="Position" value="<? echo $row_Users->Position; ?>">
								</td>
							</tr>
							<tr>
								<td>
									Department:
								</td>
								<td>
									<select name="DepartmentsId" id="DepartmentsId">
										<?php
										#getting data from the table Departments
										$rows_Departments = table_Departments ('select_all', NULL, NULL);
										foreach ($rows_Departments as $row_Departments) {
											if ($row_Departments->Id == $row_Users->DepartmentsId) {
												echo "<option value=\"$row_Departments->Id\" selected>".$row_Departments->Department."</option>";
											}
											else {
												echo "<option value=\"$row_Departments->Id\">".$row_Departments->Department."</option>";
											}
										}
										?>
									</select>
								</td>
							</tr>
							<tr>
								<td>
									Branch:
								</td>
								<td>
									<select id="BranchesId" name="BranchesId">
										<?php
										# getting data from the table Branches
										$rows_Branches = table_Branches ('select_all', NULL, NULL);
										foreach ($rows_Branches as $row_Branches) {
											if ($row_Branches->Id == $row_Users->BranchesId) {
												echo "<option value=\"$row_Branches->Id\" selected>".$row_Branches->Name."</option>";
											}
											else {
												echo "<option value=\"$row_Branches->Id\">".$row_Branches->Name."</option>";
											}
										}
										?>
									</select>
								</td>
							</tr>
							<tr>
								<td>
									Status:
								</td>
								<td>
									<select id="Status" name="Status">
										<?php
										switch ($row_Users->Status) {
											case '1':
												echo "<option value=\"1\" selected>Active</option>";
												echo "<option value=\"2\">Inactive</option>";
												break;

											case '2':
												echo "<option value=\"1\">Active</option>";
												echo "<option value=\"2\" selected>Inactive</option>";
												break;

											default:
												# code...
												break;
										}
										?>
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
									<button type="button" class="medium button" onclick="<? echo "window.location.href='resetpassword.php?UsersId=$row_Users->Id'";?>">Reset Password</button>
									<button type="button" class="medium button" name="buttonSubmit" id="buttonSubmit" onclick="checkSixFields('Username', 'Title', 'Name', 'Email', 'DepartmentsId', 'BranchesId');">Update</button>
								</th>
							</tr>
						</tbody>
					</table>
				</form>
			</div>
			<!-- end of big form -->
		</main>
	</div>
	<?php include "includes/footer.php"; ?>
	<!-- end of content -->
</body>
<script type="text/javascript" src="scripts/main.js"></script>
<script type="text/javascript">
    window.addEventListener ("load", selectOption ('selected_Title', 'Title'), false);
</script>
</html>
