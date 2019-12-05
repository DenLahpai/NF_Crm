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
		$header = "Welcome ".$_SESSION['Name'];
		include "includes/header.php";
		?>
		<main>
			<!-- TODO -->
		</main>
	</div>
	<!-- end of content -->
</body>
</html>