<?php
require_once "functions.php";

# checking if the FFMembersId is a number 
check_num ($_REQUEST['FFMembersId']);

# submitting data from the form 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    table_FFMembers ('update', $_REQUEST['FFMembersId'], NULL);
}

# getting data from the table FFMembers 
$rows_FFMembers = table_FFMembers ('select_one', $_REQUEST['FFMembersId'], NULL);
foreach ($rows_FFMembers as $row_FFMembers) {
    # code...
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
    <?php
    $page_title = "Update Frequent Flyer";
    include "includes/head.php";
    ?>
<body>
    <!-- content -->
    <div class="content">
        <?php
        $header = "Update Frequent Flyer";
        include "includes/nav.php";
        include "includes/header.php";
        ?>
        <main>
            <!-- form small table  -->
            <div class="form small table">
                <form action="#" method="post">
                    <table>
                        <thead>
                            <tr>
                                <th>Frequent Flyer No:</th>
                                <th>Frequent Flyer</th>
                            </tr>
                            <tr>
                                <td>
                                    <input type="text" name="FFNumber" id="FFNumber" value="<? echo $row_FFMembers->FFNumber; ?>">
                                </td>
                                <td>
                                    <? echo $row_FFMembers->FrequentFlyer; ?>
                                </td>
                                <td>
                                    <button type="button" class="medium button" name="buttonSubmit" id="buttonSubmit" onclick="checkSixFields('FFNumber', 'FFNumber', 'FFNumber', 'FFNumber', 'FFNumber', 'FFNumber');">Update</button>
                                </td>
                            </tr>
                            <tr>
                                <th colspan="3" class="error">
                                    <?php if (!empty($error)) { echo $error; } ?>
                                </th>
                            </tr>
                        </thead>
                    </table>
                </form>
            </div>
            <!-- end of form small table  -->
        </main>
        <?php include "includes/footer.php"; ?>
    </div>
    <!-- end of content -->
</body>
<script type="text/javascript" src="scripts/main.js"></script>    
</html>