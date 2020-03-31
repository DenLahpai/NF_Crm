<?php 
require_once "functions.php";
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<?php
$page_title = "Clients";
include "includes/head.php";
?>
<script type="text/javascript" src="scripts/jQuery.js"></script>
<script type="text/javascript">
	$(document).ready(function () {
		var limit = 30;
		var job = 'select_all';
		var Search = $("#Search").val();
		$(".grid-div").load("clientsphp.php", {
			Search: Search,
			limit: limit, 
			job: job	
		});

		$("#load").click(function () {
			limit = limit + 30;
			$(".grid-div").load("clientsphp.php", {
				Search: Search,	
				limit: limit,
				job: job
			});
			$("#load").html('Load More');
			$("#Search").val("");
		});	

		$("#btnSearch").click(function () {
			var job = 'search';
			var Search = $("#Search").val();
			$(".grid-div").load("clientsphp.php", {
				Search: Search, 
				limit: limit, 
				job: job
			});
			$("#load").html('Clear Search');			
		});		
	});
</script>
<body>
	<!-- content -->
	<div class="content">
		<?php
			include "includes/nav.php";
			$header = "Clients";
			include "includes/header.php";
		?>
		<!-- sub-menu -->
		<div class="sub-menu">
			<!-- menu-links -->
			<div class="menu-links">
				<ul>
					<li>
						<a href="new_client.php" title="New Client">Add New</a>
					</li>
					<li>
						<a href="table_clients.php" title="View as Table" target="_blank">Table View</a>
					</li>
				</ul>
			</div>
			<!-- end of menu-links -->
			<!-- search-form -->
			<div class="search-form">
				<form method="post">
					<ul>
						<li>
							<input type="text" name="Search" id="Search">
						</li>
						<li>
							<button type="button" id="btnSearch">Search</button>
						</li>
					</ul>
				</form>
			</div>
			<!-- end of search-form -->
		</div>
		<!-- end of sub-menu -->
		<main>
			<!-- result-message -->
			<div class="result-message">
				
			</div>
			<!-- end of result-message	 -->
			<!-- grid-div -->
			<div class="grid-div">
			</div>
			<!-- end of grid-div -->
			<div class="load-button">
				<button id="load">Load More</button>
			</div>
		</main>
		<?php include "includes/footer.php"; ?>
	</div>
	<!-- end of content -->
</body>
</html>