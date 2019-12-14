<?php  
require_once "functions.php";

# getting data from the table Clients
$rows_Clients = table_Clients ('select_all', NULL, NULL);
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<?php
$page_title = "Clients";  
include "includes/head.php";
?>
<body>
	<!-- content -->
	<div class="content">
		<?php  
		$header = "Clients";
		include "includes/header.php";
		include "includes/nav.php";
		?>
		<!-- sub-menu -->
		<div class="sub-menu">
			<ul>
				<li>
					<a href="new_client.php" title="New Client">Add New</a>
				</li>
				<li>
					<a href="table_clients.php" title="View as Table" target="_blank">Table View</a>
				</li>
			</ul>
		</div>
		<!-- end of sub-menu -->
		<main>
			<!-- grid-div -->
			<div class="grid-div">
				<?php foreach ($rows_Clients as $row_Clients): ?>
				<!-- grid-item -->
				<div class="grid-item">
					<ul>
						<li class="bold">
							<? echo $row_Clients->Title." ".$row_Clients->Name; ?>
						</li>
						<li>
							D.O.B: <span class="bold"><? echo date("d-M-Y", strtotime($row_Clients->DOB)); ?></span>
						</li>
						<li style="text-align: center;">
							<a href="<? echo "edit_client.php?ClientsId=$row_Clients->Id"; ?>"><button class="medium button">Edit</button></a>
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
</html>