<?php
require_once "functions.php";
check_access();

# checking if branchesId is a number
check_num ($_REQUEST['BranchesId']);

# getting data from the table Branches
$rows_Branches = table_Branches ('select_one', $_REQUEST['BranchesId'], NULL);
foreach ($rows_Branches as $row_Branches) {
    // code...
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    # checking for duplicate entry
    $rowCount = table_Branches ('check_before_update', $_REQUEST['BranchesId'], NULL);
    if ($rowCount == 0) {
        table_Branches ('update', $_REQUEST['BranchesId'], NULL);
    }
    else {
        $error = 'Duplicate Entry';
    }
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<?php
$page_title = "Edit Branch";
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
            <!-- big form -->
            <div class="big form">
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
									<input type="text" name="Name" id="Name" value="<? echo $row_Branches->Name; ?>">
								</td>
							</tr>
							<tr>
								<td colspan="2">
									<textarea name="Address" id="Address" cols="30" rows="6"><? echo $row_Branches->Address; ?></textarea>
								</td>
							</tr>
							<tr>
								<td>Township:</td>
								<td>
									<input type="text" name="Township" id="Township" value="<? echo $row_Branches->Township; ?>">
								</td>
							</tr>
							<tr>
								<td>City:</td>
								<td>
									<input type="text" name="City" id="City" value="<? echo $row_Branches->City; ?>">
								</td>
							</tr>
							<tr>
								<td>Phone:</td>
								<td>
									<input type="text" name="Phone" id="Phone" value="<? echo $row_Branches->Phone; ?>">
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
									<button type="button" class="medium button" name="buttonSubmit" id="buttonSubmit" onclick="checkSixFields('Name', 'City', 'Name', 'Phone', 'Name', 'Name');">Update</button>
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
