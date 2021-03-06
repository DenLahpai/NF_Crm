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
		?>
		<!-- sub-menu  -->
		<div class="sub-menu">
			<!-- menu-links -->
			<div class="menu-links">
				<ul>
					<li>
						<a href="new_client.php" title="New Client">Add New</a>
					</li>
					<li>
						<a href="clients.php" title="View as Grid">Grid View</a>
					</li>
				</ul>
			</div>
			<!-- end of menu-links -->
		</div>
		<!-- end of sub-menu  -->
		<section>
			<!-- search	 -->
			<div class="search">
				<form>
					<table>
						<thead>
							<tr>
								<td>
									<input type="text" name="search" id="Search" placeholder="Search">
									<button type="button" class="button medium" name="btnSearch" id="btnSearch" onclick="updateTableClients();">Search</button>
									<button type="button" class="button medium" name="btnClear" onclick="document.getElementById('Search').value='';";>Clear</button>
									<!-- <button type="button" class="button medium" name="btnExport" id="btnExport" onclick="window.location.href='export_table_clients.php';">Export</button> -->
									<button type="button" class="button medium" name="btnExport" id="btnExport" onclick="exportData('export_table_clients.php');">Export</button>
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
			</div>
			<!-- end of report table -->
		</main>
		<?php include "includes/footer.php"; ?>
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
