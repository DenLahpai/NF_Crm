<?php  
require_once "functions.php";
?>
<!DOCTYPE html>
<html>
<?php  
$page_title = "Table Clients";
include "includes/head.php";
?>
<body>
	<!-- content -->
	<div class="content">
		<?php  
		$header = "Clients";
		include "includes/header.php";
		include "includes/nav.php";
		include "includes/search.php";
		?>
		<main>
			<!-- report table -->
			<div class="report table">
				<table>
					<thead>
						<tr>
							<th>Member</th>
							<th>Title</th>
							<th>Name</th>
							<th>D.O.B</th>
							<th>Mobile</th>
							<th>Email</th>
							<th>NRC</th>
							<th>Passport No</th>
							<th>Expiry</th>
							<th>Country</th>
							<th>Created By</th>
							<th>##</th>
						</tr>
					</thead>
					<tbody>
						<?php  
						#getting data from the table Clients
						$rows_Clients = table_Clients ('select_all', NULL, NULL);
						?>
						<?php foreach ($rows_Clients as $row_Clients): ?>
							<tr>
								<td><? echo $row_Clients->Member; ?></td>
								<td><? echo $row_Clients->Title; ?></td>
								<td><? echo $row_Clients->Name; ?></td>
								<td><? echo date('d-M-Y', strtotime($row_Clients->DOB)); ?></td>
								<td><? echo $row_Clients->Mobile; ?></td>
								<td><? echo "<a href=\"mailto: $row_Clients->Email\">$row_Clients->Email</a>"; ?></td>
								<td><? echo $row_Clients->NRC; ?></td>
								<td><? echo $row_Clients->PassportNo; ?></td>
								<td><? echo date('d-M-Y', strtotime($row_Clients->Expiry)); ?></td>
								<td><? echo $row_Clients->Country; ?></td>
								<td><? echo $row_Clients->Username; ?></td>
								<td></td>
							</tr>							
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
			<!-- end of report table -->
		</main>
	</div>
	<!-- end of content -->
</body>
</html>