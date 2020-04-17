<?php  
require_once "functions.php";
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<?php  
$page_title = "Admin";
include "includes/head.php";
?>
<body>
	<!-- content -->
	<div class="content">
		<?php  
		$header = "System Administration";
		include "includes/header.php";
		include "includes/nav.php";
		?>
		<main>
			<!-- grid-div -->
			<div class="grid-div">
				<!-- grid-item -->
				<div class="grid-item">
					<button class="big square" onclick="window.location.href='branches.php'">Branches</button>
				</div>
				<!-- end of grid-item -->
				<!-- grid-item -->
				<div class="grid-item">
					<button class="big square" onclick="window.location.href='departments.php'">Departments</button>
				</div>
				<!-- end of grid-item -->
				<!-- grid-item -->
				<div class="grid-item">
					<button class="big square" onclick="window.location.href='users.php'">Users</button>
				</div>
				<!-- end of grid-item -->
				<!-- grid-item -->
				<div class="grid-item">
					<button class="big square" onclick="window.location.href='countries.php'">Countries</button>
				</div>
				<!-- end of grid-item -->
				<!-- grid-item -->
				<div class="grid-item">
					<button class="big square" onclick="window.location.href='airports.php'">Airports</button>
				</div>
				<!-- end of grid-item -->
				<!-- grid-item -->
				<div class="grid-item">
					<button class="big square" onclick="window.location.href='airlines.php'">Airlines</button>
				</div>
				<!-- end of grid-item -->
				<!-- grid-item -->
				<div class="grid-item">
					<button class="big square" onclick="window.location.href='frequentflyers.php'">Frequent Flyers</button>
				</div>
				<!-- end of grid-item -->
			</div>
			<!-- end of grid-div -->
		</main>
		<?php include "includes/footer.php"; ?>
	</div>
	<!-- end of content -->
</body>
</html>