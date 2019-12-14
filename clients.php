<?php  
require_once "functions.php";
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
	</div>
	<!-- end of content -->
</body>
</html>