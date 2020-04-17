<?php  
require_once "functions.php";

#getting data from the table Users
$rows_Users = table_Users ('select_all', NULL, NULL);
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<?php  
$page_title = "Users";
include "includes/head.php";
?>
<body>
	<!-- content -->
	<div class="content">
		<?php  
		$header = "Users";
		include "includes/nav.php";
		include "includes/header.php";
		?>
		<!-- sub-menu -->
		<div class="sub-menu">
			<ul>
				<li>
					<a href="new_user.php" title="New User">Add New</a>
				</li>
				<li>
					<a href="table_users.php" title="View As Talbe" target="_blank">Table View</a>
				</li>
			</ul>
		</div>
		<!-- end of sub-menu -->
		<main>
			<!-- grid-div -->
			<div class="grid-div">
				<?php foreach ($rows_Users as $row_Users): ?>
					<!-- grid-item -->
					<div class="grid-item">
						<ul>
							<li class="bold">
								<? echo $row_Users->Title." ".$row_Users->Name; ?>
							</li>
							<li>
								Department: 
								<? echo $row_Users->Department; ?>
							</li>
							<li style="text-align: center;">
								<a href="<? echo "edit_user.php?UsersId=$row_Users->Id"; ?>"><button class="medium button">Edit</button></a>
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