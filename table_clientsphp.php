<?php  
require_once "functions.php";

$job = $_REQUEST['job'];
$limit = $_REQUEST['limit'];
$Search = $_REQUEST['Search'];
$sorting = $_REQUEST['sorting'];
$rows_Clients = table_Clients ($job, NULL, $Search, $limit, $sorting);
$rowCount = table_Clients('count_rows', NULL, NULL, NULL, NULL);
?>
<table>
	<thead>
		<tr>
			<th>
				<select name="limit" id="limit" onchange="updateLimit();">
					<?php  
					$i = 30;
					while ($i <= $rowCount + 30) {
						if ($i == $limit) {
							echo "<option value=\"$i\" selected>".$i."</option>";
						}
						else {
							echo "<option value=\"$i\">".$i."</option>";
						}
						$i = $i + 30;
					}
					?>
				</select>
			</th>
			<th>Member</th>
			<th>Title</th>
			<th>
				Name
				<span class="sorter" onclick="sortTableClients('Name', 'ASC');" title="A -> Z">&#9650;</span>
				<span class="sorter" onclick="sortTableClients('Name', 'DESC');" title="Z -> A">&#9660;</span>
			</th>
			<th>
				D.O.B
				<span class="sorter" onclick="sortTableClients('DOB', 'ASC');" title="Old -> Young">&#9650;</span>
				<span class="sorter" onclick="sortTableClients('DOB', 'DESC');" title="Young -> Old">&#9660;</span>
			</th>
			<th>Mobile</th>
			<th>Email</th>
			<th>
				Created By
				<span class="sorter" onclick="sortTableClients('Username', 'ASC');" title="A -> Z">&#9650;</span>
				<span class="sorter" onclick="sortTableClients('Username', 'DESC');" title="Z -> A">&#9660;</span>
			</th>
			<th>
				On
				<span class="sorter" onclick="sortTableClients('Created', 'ASC');" title="Old -> New">&#9650;</span>
				<span class="sorter" onclick="sortTableClients('Created', 'DESC');" title="New -> Old">&#9660;</span>
			</th>
			<th>##</th>
		</tr>
	</thead>	
	<tbody>
		<?php 
		$i = 1;
		foreach ($rows_Clients as $row_Clients): 
		?>
			<tr>
				<td><? echo $i;?></td>
				<td><? echo $row_Clients->Member; ?></td>
				<td><? echo $row_Clients->Title; ?></td>
				<td><? echo $row_Clients->Name; ?></td>
				<td><? echo date('d-M-Y', strtotime($row_Clients->DOB)); ?></td>
				<td><? echo $row_Clients->Mobile; ?></td>
				<td><? echo "<a href=\"mailto: $row_Clients->Email\" title=\"$row_Clients->Email\">Email</a>"; ?></td>
				<td><? echo $row_Clients->Username; ?></td>
				<td title="<? echo date("d-M-Y @ H:i", strtotime($row_Clients->Created));?>"><? echo date("d-M-Y", strtotime($row_Clients->Created));?></td>
				<td style="text-align: center;">
					<button class="medium button" onclick="openClientModal('<? echo "modalClient$row_Clients->Id"; ?>');">View</button>
					<a href="<? echo "edit_client.php?ClientsId=$row_Clients->Id"; ?>"><button class="medium button">Edit</button></a>
					<a href="<? echo "client"; ?>"></a>
				</td>
			</tr>							
		<?php 
		$i++;
		endforeach; 
		?>
	</tbody>
</table>
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
    }
    
</script>
<script type="text/javascript" src="scripts/jQuery.js"></script>
<script type="text/javascript" src="scripts/main.js"></script>	
