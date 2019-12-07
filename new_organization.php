<?php  
require_once "functions.php";
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<?php  
$page_title = "New Organization";
include "includes/head.php";
?>
<body>
	<!-- content -->
	<div class="content">
		<?php  
		$header = "New Organization";
		include "includes/header.php";
		include "includes/nav.php";		
		?>
		<main>
			<div class="big form">
				<table>
					<thead>
						<tr>
							<th colspan="2">Create a New Organization</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>Name:</td>
							<td>
								<input type="text" name="Name" id="Name" placeholder="Name of the organization" required>
							</td>
						</tr>
						<tr>
							<td>Branch:</td>
							<td>
								<input type="text" name="Branch" id="Branch" placeholder="Main Branch or City Branch">
							</td>
						</tr>
						<tr>
							<td>Type:</td>
							<td><input type="text" name="Type" id="Type" placeholder="Company, NGO, Gov, or Embassy"></td>
						</tr>
						<tr>
							<td>
								<!-- TODO -->
							</td>
						</tr>
					</tbody>
				</table>
			</div>
			<!-- end of big form -->
		</main>
	</div>
	<!-- end of content -->
</body>
</html>