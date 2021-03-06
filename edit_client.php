<?php  
require_once "functions.php";

# checking if ClientsId is a number
check_num($_REQUEST['ClientsId']);

# submitting data from the form 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	# checking for duplicated entry
	$rowCount = table_Clients ('check_before_update', $_REQUEST['ClientsId'], NULL, NULL, NULL);

	if ($rowCount == 0) {
		# updating
		table_Clients ('update', $_REQUEST['ClientsId'], NULL, NULL, NULL);
	}
	else {
		$error = 'Duplicate entry!';
	}
}

# getting data from the table Clients
$rows_Clients = table_Clients ('select_one', $_REQUEST['ClientsId'], NULL, NULL, NULL);
foreach ($rows_Clients as $row_Clients) {
	# code...
}

?>
<!DOCTYPE html>
<html>
<?php  
$page_title = "Edit Client";
include "includes/head.php";
?>
<body>
	<!-- content -->
	<div class="content">
		<?php  
		$header = "Edit Client";
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
								<th colspan="2">Edit Client</th>
							</tr>
						</thead>
						<tbody>
							<tr>
                                <td>Title:
                                	<span class="invisible" id="selected_Title"><? echo $row_Clients->Title; ?></span>
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
                            	<td>Name:</td>
                            	<td>
                            		<input type="text" name="Name" id="Name" value="<? echo $row_Clients->Name; ?>">
                            	</td>
                            </tr>
                            <tr>
                            	<td>D.O.B</td>	
                            	<td>
                            		<input type="date" name="DOB" id="DOB" value="<? echo $row_Clients->DOB; ?>">
                            	</td>
                            </tr>
                            <tr>
                            	<td>Mobile:</td>
                            	<td>
                            		<input type="text" name="Mobile" id="Mobile" value="<? echo $row_Clients->Mobile; ?>">
                            	</td>
                            </tr>
                            <tr>
                            	<td>Email:</td>
                            	<td>
                            		<input type="text" name="Email" id="Email" value="<? echo $row_Clients->Email; ?>">
                            	</td>
                            </tr>
                            <tr>
                            	<td>N.R.C:</td>
                            	<td>
                            		<input type="text" name="NRC" id="NRC" value="<? echo $row_Clients->NRC; ?>">
                            	</td>
                            </tr>
                            <tr>
                            	<td>Passport No:</td>
                            	<td>
                            		<input type="text" name="PassportNo" id="PassportNo" value="<? echo $row_Clients->PassportNo; ?>">
                            	</td>
                            </tr>
                            <tr>
                            	<td>Expiry:</td>
                            	<td>
                            		<input type="date" name="Expiry" id="Expiry" value="<? echo $row_Clients->Expiry; ?>">
                            	</td>
                            </tr>
                            <tr>
                            	<td>Country:</td>
                            	<td>
                            		<span class="invisible" id="selected_Country"></span>
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
                                <td colspan="2">
    							<?php
                                # getting data from the table Documents
                                $rows_Documents = table_Documents ('select_for_one_client', 'Passport', $row_Clients->Id);
                                if ($rows_Documents == 0) {
                                    echo "<a href=\"upload_document.php?ClientsId=$row_Clients->Id\">Passport</a><span style=\"color: red; font-size: 1.2em;\"> &#10008; &nbsp; </span>"; 
                                }
                                else {
                                    foreach ($rows_Documents as $row_Documents) {
                                        echo "<a href=\"update_document.php?DocumentsId=$row_Documents->Id\" target='blank' title='View Document'>".$row_Documents->DocType."</a><span style=\"color: green; font-size: 1.2em;\"> &#10004; &nbsp;</span>";
                                    }               
                                }

                                # getting data from the table Documents
                                $rows_Documents = table_Documents ('select_for_one_client', 'NRC', $row_Clients->Id);
                                if ($rows_Documents == 0) {
                                    echo "<a href=\"upload_document.php?ClientsId=$row_Clients->Id&DocType=NRC\">NRC</a><span style=\"color: red; font-size: 1.2em;\"> &#10008; &nbsp; </span>"; 
                                }
                                else {
                                    foreach ($rows_Documents as $row_Documents) {
                                        echo "<a href=\"update_document.php?DocumentsId=$row_Documents->Id\" target='blank' title='View Document'>".$row_Documents->DocType."</a><span style=\"color: green; font-size: 1.2em;\"> &#10004; &nbsp;</span>";
                                    }               
                                }

                                # getting data from the table Documents
                                $rows_Documents = table_Documents ('select_for_one_client', 'Profile', $row_Clients->Id);
                                if ($rows_Documents == 0) {
                                    echo "<a href=\"upload_document.php?ClientsId=$row_Clients->Id&DocType=Profile\">Profile</a><span style=\"color: red; font-size: 1.2em;\"> &#10008; &nbsp; </span>"; 
                                }
                                else {
                                    foreach ($rows_Documents as $row_Documents) {
                                        echo "<a href=\"update_document.php?DocumentsId=$row_Documents->Id\" target='blank' title='View Document'>".$row_Documents->DocType."</a><span style=\"color: green; font-size: 1.2em;\"> &#10004; &nbsp;</span>";
                                    }               
                                }                                              
    							?>
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
                                    <button type="button" class="medium button" name="buttonSubmit" id="buttonSubmit" onclick="checkSixFields('Title', 'Name', 'Mobile', 'NRC', 'PassportNo', 'CountriesId');">Update</button>
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
    window.onload = selectOption("selected_Title", "Title");
</script>
</html>