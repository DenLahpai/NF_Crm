<?php  
require_once "functions.php";

$job = $_REQUEST['job'];
$limit = $_REQUEST['limit'];
if (!empty($_REQUEST['Search'])) {
	$Search = trim($_REQUEST['Search']);
	$rows_Clients = table_Clients ($job, NULL, $Search, $limit, "ORDER BY Id DESC");
}
else {
	$rows_Clients = table_Clients ($job, NULL, NULL, $limit, "ORDER BY Id DESC");
}
?>

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
	 				<li>
	 					Frequent Flyers: <a href="<? echo "add_frequentflyer.php?ClientsId=$row_Clients->Id"; ?>"><button class="medium button">Add</button></a>
	 				</li>
	 			</ul>			 			
	 			<table>
	 				<thead>
	 					<tr>
	 						<th>Membership No</th>
	 						<th>Frequent Flyer</th>
	 						<th>#</th>
	 					</tr>
	 					<?php  
	 					# getting data from the talbe FFMembers
	 					$rows_FFMembers = table_FFMembers ('select_all', $row_Clients->Id, NULL);
	 					foreach ($rows_FFMembers as $row_FFMembers) {
	 						echo "<tr>";
	 						echo "<td>".$row_FFMembers->FFNumber."</td>";
	 						echo "<td>".$row_FFMembers->FrequentFlyer."</td>";
	 						echo "<td><a href=\"update_frequentflyer.php?FFMembersId=$row_FFMembers->Id\">Edit</a>";
	 						echo "</tr>";
	 					}
	 					?>
	 				</thead>
	 			</table>
	 		</div>
	 		<!-- end of modalClient -->
	 	<?php endforeach ?>
	</div>
	<!-- end of modalClient -->

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
