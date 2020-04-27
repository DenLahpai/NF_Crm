<?php
require_once "functions.php";

//checking if UserId is num
check_num($_REQUEST['UsersId']);

//getting data from the table Users
$rows_Users = table_Users ('select_one', $_REQUEST['UsersId'], NULL);
foreach ($rows_Users as $row_Users) {
    # code...
}

//Submitting data to update
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //checking for duplication
    $rowCount = table_Users ('check_before_update', $_REQUEST['UsersId'], NULL);
    if ($rowCount == 0) {
        # updating data to the the table Users
        table_Users ('update_by_user', $_REQUEST['UsersId'], NULL);
    }
    else {
        $error = "Duplicate Entry!";
    }
}

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
    <?php
    $page_title = "Update: ".$_SESSION['Username'];
    include "includes/head.php";
    ?>
<body>
    <!-- content -->
    <div class="content">
        <?php
        include "includes/nav.php";
        $header = "Update User: ".$_SESSION['Username'];
        include "includes/header.php";
        ?>
        <main>
            <!-- user form -->
            <div class="user form">
                <form action="#" method="post">
                    <table>
                        <thead></thead>
                        <tbody>
                            <tr>
                                <td>Title: <span class="invisible" id="selected_Title"><? echo $row_Users->Title; ?></span></td>
                                <td>
                                    <select name="Title" id="Title">
                                       <option value="Mr.">Mr.</option>
                                       <option value="Mrs.">Mrs.</option>
                                       <option value="Ms.">Ms.</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Name:</td>
                                <td>
                                    <input type="text" name="Name" id="Name" value="<? echo $row_Users->Name;?>">
                                </td>
                            </tr>
                            <tr>
                                <td>New Password:</td>
                                <td>
                                    <input type="password" name="Password" id="Password">
                                </td>
                            </tr>
                            <tr>
                                <td>Re-type Password:</td>
                                <td>
                                    <input type="password" name="rePassword" id="rePassword">
                                </td>
                            </tr>
                            <tr>
                                <td>Email:</td>
                                <td>
                                    <input type="email" name="Email" id="Email" value="<? echo $row_Users->Email; ?>">
                                </td>
                            </tr>
                            <tr>
                                <th colspan="2" class="error">
                                    <?php
                                    if (!empty($error)) {
                                        echo $error;
                                    }
                                    ?>
                                </th>
                            </tr>
                            <tr>
                                <th colspan="2">
                                    <button type="button" class="medium button" name="buttonSubmit" id="buttonSubmit" onclick="twoPasswords ('Password', 'rePassword');checkSixFields('Name', 'Name', 'Name', 'Email', 'Email', 'Email');">Update</button>
                                </th>
                            </tr>
                        </tbody>
                    </table>
                </form>
            </div>
            <!-- end of user form -->
        </main>
        <?php include "includes/footer.php"; ?>
    </div>
    <!-- end of content -->
</body>
    <script type="text/javascript" src="scripts/main.js"></script>
    <script type="text/javascript">
        window.onload = selectOption("selected_Title", "Title");
    </script>
</html>
