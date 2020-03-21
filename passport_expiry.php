<?php
require_once "functions.php";

#getting data from the table Clients
$rows_Clients = table_Clients ('select_all', NULL, NULL);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    table_PassportReminders ('insert', NULL, NULL);
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<?php
$page_title = "Expiring Passports";
include "includes/head.php";
?>
<body>
    <!-- content -->
    <div class="content">
        <?php
        $header = "Passport Expiry";
        include "includes/header.php";
        include "includes/nav.php";
        ?>
        <main>
            <!-- grid-div -->
            <div class="grid-div">
                <?php
                foreach ($rows_Clients as $row_Clients):
                ?>
                <?php
                    $limit = date('Y-m-d', strtotime('210 days'));
                    if ($limit >= $row_Clients->Expiry):
                ?>
                <!-- grid-item -->
                <div class="grid-item">
                    <ul>
                        <li>
                            <? echo $row_Clients->Title." ".$row_Clients->Name; ?>
                        </li>
                        <li>
                            Passport No: <? echo $row_Clients->PassportNo; ?>
                        </li>
                        <li>
                            Passport Expiry:
                            <?
                            $today = date('Y-m-d');
                            $six_month = date('Y-m-d', strtotime('180 days'));
                            if ($today > $row_Clients->Expiry) {
                                echo "<span class=\"error\">".date('d-M-Y', strtotime($row_Clients->Expiry))." EXPIRED!!!";
                            }
                            else {
                                echo date('d-M-Y', strtotime($row_Clients->Expiry));
                            }
                            ?>
                        </li>
                        <li>
                            Phone: <? echo $row_Clients->Mobile; ?>
                        </li>
                        <li>
                            Email: <? echo $row_Clients->Email; ?>
                        </li>
                        <li style="text-align: center;">
                            <a href="<? echo "edit_client.php?ClientsId=$row_Clients->Id";?>" target="_blank"><button type="button" class="medium button" name="button">Update</button></a>
                        </li>
                        <li>
                            <!-- small form -->
                            <div class="small form">
                                <form method="post" action="#">
                                    <table>
                                        <thead>
                                            <tr>
                                                <th colspan="3">Reminders</th>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <button type="submit" class="medium button">Add</button>
                                                    <input type="hidden" name="ClientsId" id="ClientsId" value="<? echo $row_Clients->Id; ?>">
                                                </td>
                                                <td colspan="2">
                                                    <input type="text" name="Method" id="Method" placeholder="Phone, Email, SMS" required>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Date Time</th>
                                                <th>Method</th>
                                                <th>User</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            # getting data from the table Passport_Reminders
                                            $rows_PassportReminders = table_PassportReminders ('select_for_one_client', $row_Clients->Id, NULL);
                                            foreach ($rows_PassportReminders as $row_PassportReminders):
                                            ?>
                                            <tr>
                                                <td>
                                                    <? echo date('d-M-Y @ H:i', strtotime($row_PassportReminders->Created)); ?>
                                                </td>
                                                <td>
                                                    <?php echo $row_PassportReminders->Method; ?>
                                                </td>
                                                <td>
                                                    <?php echo $row_PassportReminders->Username; ?>
                                                </td>
                                            </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </form>
                            </div>
                            <!-- end of small form -->
                        </li>
                    </ul>
                </div>
                <!-- end of grid-item -->
                <?php endif; ?>
                <?php endforeach;?>
            </div>
            <!-- end of grid-div -->
        </main>
        <?php include "includes/footer.php"; ?>
    </div>
    <!-- end of content -->
</body>
<script type="text/javascript" src="scripts/main.js">

</script>
</html>
