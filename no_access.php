<?php
require_once "functions.php";
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<?php
$page_title = "Access Denied!";
include "includes/head.php";
?>
<body>
    <!-- content -->
    <div class="content">
        <?php
        include "includes/nav.php";
        $header = "Access Denied";
        include "includes/header.php";
        ?>
        <main>
            <h3 style="text-align: center;">
                You do NOT permission to access these features. Please contact your admin if you need to access them.
            </h3>
        </main>
        <?php include "includes/footer.php"; ?>
    </div>
    <!-- end of content -->
</body>
</html>
