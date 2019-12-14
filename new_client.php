<?php  
require_once "functions.php";

# submitting data from the form 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	# checking for duplicate entry
	$row_Count = table_Clients ('check_before_insert', NULL, NULL);
	if ($row_Count == 0) {
		# getting Id number to generate md5 code
		$md5 = table_Clients ('count_rows', NULL, NULL);
		$md5 = $md5 + 1;

		# inserting data to the table Clients
		echo table_Clients ('insert', $md5, NULL);
	}
	else {
		$error = "Duplicate entry!";
	}
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<?php  
$page_title = "New Client";
include "includes/head.php";
?>
<body>
	<!-- content -->
	<div class="content">
		<?php  
		$header = 'New Client';
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
								<th colspan="2">Create New Client</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>Title:</td>
								<td>
									<select name="Title" id="Title">
										<option value="">Select</option>
										<option value="Mr.">Mr.</option>
										<option value="Mrs.">Mrs.</option>
										<option value="Ms.">Ms.</option>
									</select>
								</td>
							</tr>
							<tr>
								<td>Name:</td>
								<td>
									<input type="text" name="Name" id="Name">
								</td>
							</tr>
							<tr>
								<td>D.O.B:</td>
								<td>
									<input type="date" name="DOB" id="DOB">
								</td>
							</tr>
							<tr>
								<td>Mobile:</td>
								<td>
									<input type="text" name="Mobile" id="Mobile" placeholder="+959XXXXXX">
								</td>
							</tr>
							<tr>
								<td>Email:</td>
								<td>
									<input type="text" name="Email" id="Email" placeholder="email@email.com">
								</td>
							</tr>
							<tr>
								<td>N.R.C:</td>
								<td>
									<input type="text" name="NRC" id="NRC" placeholder="12/SaKhaNa(N)000444">
								</td>
							</tr>
							<tr>
								<td>Passport No:</td>
								<td>
									<input type="text" name="PassportNo" id="PassportNo" placeholder="Passport No">
								</td>
							</tr>
							<tr>
								<td>Passport Expiry:</td>
								<td>
									<input type="date" name="Expiry" id="Expiry">
								</td>
							</tr>
							<tr>
								<td>Country:</td>
								<td><span class="invisible" id="selected_Country">1</span>
									<select name="CountriesId" id="CountriesId">
										<?php
										# getting data from the table Countries  
										$rows_Countries = table_Countries ('select_all', NULL, NULL);
										foreach ($rows_Countries as $row_Countries) {
											echo "<option value=\"$row_Countries->Id\">".$row_Countries->Country."</option>";
										}
										?>
									</select>
								</td>
							</tr>
							<tr>
                                <th colspan="2" class="error">
                                    <?php 
                                    if (!empty($error)) {
                                        echo $error;
                                    }
                                    ?>
                                </th>
                            </tr>    
							<tr>
								<th colspan="2">
                                    <button type="button" class="medium button" name="buttonSubmit" id="buttonSubmit" onclick="checkSixFields('Title', 'Name', 'Mobile', 'NRC', 'PassportNo', 'CountriesId');">Submit</button>
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
<script type="text/javascript">
        window.onload = selectOption("selected_Country", "CountriesId");
</script>
</html>