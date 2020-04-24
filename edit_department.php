<?php
require_once "functions.php";
check_access();

#checking if DepartmentsId is a number
check_num ($_REQUEST['DepartmentsId']);

#getting data form the table Departments
$rows_Departments = table_Departments ('select_one', $_REQUEST['DepartmentsId'], NULL);
foreach ($rows_Departments as $row_Departments) {
    # code...
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    # checking for duplication
    $rowCount = table_Departments ('check_before_update', $_REQUEST['DepartmentsId'], NULL);
    if ($rowCount == 0) {
        // updating
        table_Departments ('update', $_REQUEST['DepartmentsId'], NULL);
    }
    else {
        $error = "Duplicate entry!";
    }
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<?php
$page_title = "Edit Department";
include "includes/head.php";
?>
<body>
    <!-- content -->
    <div class="content">
        <?php
        include "includes/nav.php";
        $header = $page_title;
        include "includes/header.php";
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
									<input type="text" name="Department" id="Department" value="<? echo $row_Departments->Department; ?>" required>
								</td>
								<td>
									<button type="button" class="medium button" name="buttonSubmit" id="buttonSubmit" onclick="checkSixFields('Department', 'Department', 'Department', 'Department', 'Department', 'Department')">Update</button>
								</td>
								</td>
							</tr>
							<tr>
								<th colspan="3" class="error">
									<?php if (!empty($error)) { echo $error; } ?>
								</th>
							</tr>
						</thead>
						<tbody></tbody>
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
