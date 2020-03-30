<?php
require_once "functions.php";
<<<<<<< HEAD

#getting data from the table Clients
$rows_Clients = table_Clients ('select_all', NULL, NULL);
if (isset($_REQUEST['buttonSearch'])) {
	$search = trim($_REQUEST['search']);
	if (empty($search)) {
		$rows_Clients = table_Clients ('select_all', NULL, NULL);
	}
	else {
		$rows_Clients = table_Clients ('search', NULL, NULL);
	}
}
=======
>>>>>>> jqueryadded
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
		?>
		<section>
			<!-- search	 -->
			<div class="search">
				<form>
					<table>
						<thead>
							<tr>
<<<<<<< HEAD
								<td><? echo $row_Clients->Member; ?></td>
								<td><? echo $row_Clients->Title; ?></td>
								<td><? echo $row_Clients->Name; ?></td>
								<td><? echo date('d-M-Y', strtotime($row_Clients->DOB)); ?></td>
								<td><? echo $row_Clients->Mobile; ?></td>
								<td><? echo "<a href=\"mailto: $row_Clients->Email\">$row_Clients->Email</a>"; ?></td>
								<td><? echo $row_Clients->Username; ?></td>
								<td style="text-align: center;">
									<button class="" onclick="openClientModal('<? echo "modalClient$row_Clients->Id"; ?>');">View</button>
									<a href="<? echo "edit_client.php?ClientsId=$row_Clients->Id"; ?>"><button class="">Edit</button></a>
									<a href="<? echo "client"; ?>"></a>
								</td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
=======
								<td>
									<input type="text" name="search" id="Search" placeholder="Search">
									<button type="button" class="button medium" name="btnSearch" id="btnSearch" onclick="searchTableClients();">Search</button>
									<button type="button" class="button medium" name="btnClear" id="btnClear" onclick="loadClients('table_clientsphp.php', '#clients-table');">Clear</button>
								</td>
							</tr>
						</thead>
					</table>
				</form>
			</div>
			<!-- end of search -->
		</section>
		<main>
			<!-- report table -->
			<div class="report table" id="clients-table">	
>>>>>>> jqueryadded
			</div>
			<!-- end of report table -->			
		</main>
<<<<<<< HEAD
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
=======
		<?php include "includes/footer.php"; ?>
>>>>>>> jqueryadded
	</div>
	<!-- end of content -->
</body>
<script type="text/javascript" src="scripts/jQuery.js"></script>
<script type="text/javascript" src="scripts/main.js"></script>
<script type="text/javascript">
		$(document).ready(function() {
			loadClients('table_clientsphp.php', '#clients-table');
		});
</script>
</html>
