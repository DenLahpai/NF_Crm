<?php  
require_once "functions.php";

# getting data from the table Organizations
$rows_Organizations = table_Organizations ('select_all', NULL, NULL);
if (isset($_REQUEST['buttonSearch'])) {
	$search = trim($_REQUEST['search']);
	if (empty($search)) {
		$rows_Organizations = table_Organizations ('select_all', NULL, NULL);
	}
	else {
		$rows_Organizations = table_Organizations ('search', NULL, NULL);
	}
}

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<?php  
$page_title = "Table: Organizations";
include "includes/head.php";
?>
<body>
	<!-- content -->
	<div class="content">
		<?php  
		$header = "Organizations";
		include "includes/nav.php";
		include "includes/header.php";
		include "includes/search.php";
		?>
		<main>
			<!-- report table -->
			<div class="report table">
				<table>
					<thead>
						<tr>
							<th>#</th>
							<th>Name</th>
							<th>Branch</th>
							<th>Type</th>
							<th>Address</th>
							<th>Township</th>
							<th>City</th>
							<th>State</th>
							<th>Country</th>
							<th>Website</th>
							<th>##</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($rows_Organizations as $row_Organizations): ?>
						<tr>
							<td><? echo $row_Organizations->Id; ?></td>
							<td><? echo $row_Organizations->Name; ?></td>
							<td><? echo $row_Organizations->Branch; ?></td>
							<td><? echo $row_Organizations->Type; ?></td>
							<td><? echo $row_Organizations->Address; ?></td>
							<td><? echo $row_Organizations->Township; ?></td>
							<td><? echo $row_Organizations->City; ?></td>
							<td><? echo $row_Organizations->State; ?></td>
							<td><? echo $row_Organizations->Country; ?></td>
							<td><? echo "<a href=\"http://$row_Organizations->Website\">".$row_Organizations->Website."</a>"; ?></td>
							<td style="text-align: center;">
								<a href="<? echo "edit_organization.php?OrganizationsId=$row_Organizations->Id"; ?>"><button class="medium button">Edit</button></a>
							</td>
						</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
			<!-- end of report table -->
		</main>
		<?php include "includes/footer.php"; ?>
	</div>
	<!-- end of content -->
</body>
</html>