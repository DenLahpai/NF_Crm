<section>
	<!-- search	 -->
	<div class="search">
		<form action="#" method="post">
			<table>
				<thead>
					<tr>
						<td>
							<input type="text" name="search" id="search" placeholder="Search" value="<? if (!empty($_REQUEST['search'])) { echo $_REQUEST['search']; } ?>">
							<button class="button medium" name="buttonSearch" id="buttonSearch">Search</button>
						</td>
					</tr>
				</thead>
			</table>
		</form>
	</div>
	<!-- end of search -->
</section>