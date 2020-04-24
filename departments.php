<?php
require_once "functions.php";
check_access();

# submitting data from the form
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	# checking for duplicate entry
	$row_Count = table_Departments ('check_before_insert', NULL, NULL);
	if ($row_Count == 0) {
		# inserting data to the table Departments
		table_Departments ('insert', NULL, NULL);
	}
	else {
		$error = "Duplicate Entry!";
	}
}

//getting data from the table Departments
$rows_Departments = table_Departments ('select_all', NULL, NULL);

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<?php
$page_title = "Departments";
include "includes/head.php";
?>
<body>
	<!-- content -->
	<div class="content">
		<?php
		$header = "Departments";
		include "includes/header.php";
		include "includes/nav.php";
		?>
		<main>
			<!-- form small table -->
			<div class="form small table">
				<form action="#" method="post">
					<table>
						<thead>
							<tr>
								<th>Departments</th>
								<th>#</th>
							</tr>
							<tr>
								<td>
									<input type="text" name="Department" id="Department" placeholder="Department">
								</td>
								<td>
									<button type="button" class="medium button" name="buttonSubmit" id="buttonSubmit" onclick="checkSixFields('Department', 'Department', 'Department', 'Department', 'Department', 'Department')">Add</button>
								</td>
								</td>
							</tr>
							<tr>
								<th colspan="3" class="error">
									<?php if (!empty($error)) { echo $error; } ?>
								</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($rows_Departments as $row_Departments): ?>
								<tr>
									<td><? echo $row_Departments->Department; ?></td>
									<td>
										<a href="<? echo "edit_department.php?DepartmentsId=$row_Departments->Id";?>"><button type="button" class="medium button">Edit</button></a>
									</td>
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
