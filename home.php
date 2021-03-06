<?php
require_once "handler.php";
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
	<?php
	$page_title = "Home";
	include "includes/head.php";
	?>
<body>
	<!-- content -->
	<div class="content">
		<?php
		include "includes/nav.php";
		$header = "Modules";
		include "includes/header.php";
		?>
		<main>
			<!-- grid-div -->
			<div class="grid-div">
				<!-- grid-item -->
				<div class="grid-item">
					<button class="big square" onclick="window.location.href='organizations.php';">Organizations</button>
				</div>
				<!-- end of grid-item -->
				<!-- grid-item -->
				<div class="grid-item">
					<button class="big square" onclick="window.location.href='clients.php';">Clients</button>
				</div>
				<!-- end of grid-item -->
				<!-- grid-item -->
				<div class="grid-item">
					<button class="big square" onclick="window.location.href='passport_expiry.php';">Passports Expiry</button>
				</div>
				<!-- end of grid-item -->
				<!-- grid-item -->
				<div class="grid-item">
					<button class="big square" onclick="window.location.href='birthdays.php';">Birthdays</button>
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
