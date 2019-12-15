<?php 
require_once "functions.php";

# getting data from the table Organizations
$rows_Organizations = table_Organizations ('select_all', NULL, NULL);
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<?php 
$page_title = "Organizations";
include "includes/head.php";
?>
<body>
	<!-- content -->
	<div class="content">
		<?php
		include "includes/nav.php";  
		$header = "Organizations";
		include "includes/header.php";		
		?>
		<!-- sub-menu -->
		<div class="sub-menu">
			<ul>
				<li>
					<a href="new_organization.php" title="New Organization">Add New</a>
				</li>
				<li>
					<a href="table_organizations.php" title="View as Table" target="_blank">Table View</a>
				</li>
			</ul>
		</div>
		<!-- end of sub-menu -->
		<main>
			<!-- grid-div -->
			<div class="grid-div">
				<?php foreach ($rows_Organizations as $row_Organizations): ?>
					<!-- grid-item	 -->
					<div class="grid-item">
						<ul>
							<li class="bold"><? echo $row_Organizations->Name; ?></li>
							<li><? echo $row_Organizations->City.", ".$row_Organizations->State; ?></li>
							<li style="text-align: center;">
								<a href="<? echo "edit_organizaton.php?OrganizationsId=$row_Organizations->Id"; ?>"><button class="medium button">Edit</button></a>
							</li>
						</ul>
					</div>
					<!-- end of grid-item -->
				<?php endforeach ?>
			</div>
			<!-- end of grid-div -->
		</main>
	</div>
	<!-- end of content -->
</body>
</html>