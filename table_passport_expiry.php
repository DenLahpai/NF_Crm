<?php
require_once "functions.php";
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<?php
$page_title = "Expiring Passports";
include "includes/head.php";
?>
<body>
    <!-- content  -->
    <div class="content">
        <?php
        $header = "Passport Expiry";
        include "includes/header.php";
        include "includes/nav.php";
        ?>
    </div>
    <section>
        <!-- search	 -->
        <div class="search">
            <form>
                <table>
                    <thead>
                        <tr>
                            <td>
                                <input type="text" name="search" id="Search" placeholder="Search">
                                <button type="button" class="button medium" name="btnSearch" id="btnSearch" onclick="loadpassportExpiry();">Search</button>
                                <button type="button" class="button medium" name="btnClear" id="btnClear" onclick="document.getElementById('Search').value=''; loadPassportExpiry();">Clear</button>
                                <button type="button" class="button medium" name="btnExport" id="btnExport" onclick="exportData('export_table_passport_expiry.php');">Export</button>
                            </td>
                        </tr>
                    </thead>
                </table>
            </form>
        </div>
        <!-- end of search -->
	</section>
    <main>
        <!-- report table -->
        <div class="report table" id="passport-expiry-table">
        </div>
        <!-- end of report table -->
        <?php include "includes/footer.php"; ?>
    </main>
    <!-- end of content -->
</body>
<script type="text/javascript" src="scripts/jQuery.js"></script>
<script type="text/javascript" src="scripts/main.js"></script>
<script type="text/javascript">
		$(document).ready(function() {
			loadPassportExpiry();
		});
</script>
</html>
