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
							MemberId: <span class="bold"><? echo $row_Clients->Member; ?></span>
						</li>
						<li>
							D.O.B: <span class="bold"><? echo date("d-M-Y", strtotime($row_Clients->DOB)); ?></span>
						</li>
						<li style="text-align: center;">
							<button class="medium button" onclick="openClientModal('<? echo "modalClient$row_Clients->Id"; ?>');">View</button>
							<a href="<? echo "edit_client.php?ClientsId=$row_Clients->Id"; ?>"><button class="medium button">Edit</button></a>
						</li>
					</ul>
				</div>
				<!-- end of grid-item -->
				<?php endforeach ?>
			</div>
			<!-- end of grid-div -->
		</main>
		<!-- modalClients -->
		<div class="modalClients" id="modalClients">
			 	<?php foreach ($rows_Clients as $row_Clients): ?>
			 		<!-- modalClient -->
			 		<div class="modalClient" id="<? echo "modalClient$row_Clients->Id"; ?>">
			 			<ul>
			 				<h1 id="modalClose" onclick="modalClose();" title="Close">&times;</h3>
			 				<li class="bold">
			 				<? echo $row_Clients->Title." ".$row_Clients->Name; ?>
			 				</li>
			 				<li>
			 					Member Id: <? echo $row_Clients->Member; ?>
			 				</li>
			 				<li>
			 					D.O.B: <? echo date("d-M-Y", strtotime($row_Clients->DOB)); ?>
			 				</li>
			 				<li>
			 					Mobile: <? echo $row_Clients->Mobile; ?>
			 				</li>
			 				<li>
			 					Email: <a href="<? echo "mailto: $row_Clients->Email; " ?>"><? echo $row_Clients->Email; ?></a>
			 				</li>
			 				<li>
			 					NRC: <? echo $row_Clients->NRC; ?>
			 				</li>
			 				<li>
			 					Passport No: <? echo $row_Clients->PassportNo." | Expiry: ".date('d-M-Y', strtotime($row_Clients->Expiry)); ?>
			 				</li>
			 				<li>
			 					Country: <? echo $row_Clients->Country; ?>
			 				</li>
			 			</ul>
			 		</div>
			 		<!-- end of modalClient -->
			 	<?php endforeach ?>
		</div>
		<!-- end of modalClient -->
		<?php include "includes/footer.php"; ?>
	</div>
	<!-- end of content -->
</body>
<script type="text/javascript" src="scripts/main.js"></script>
<script type="text/javascript">
	var modal = document.getElementById('modalClients');

	//function to open modal
        function openClientModal(modalToOpen) {
            modal.style.display = 'block';
            var modalToOpen = document.getElementById(modalToOpen);
            modalToOpen.style.display = 'block';
        }

        //function to close modal
        function modalClose() {
            modal.style.display = 'none';
            window.location.href = 'clients.php';
        }
</script>
</html>