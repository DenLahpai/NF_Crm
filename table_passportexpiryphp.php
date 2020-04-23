<?php
require_once "functions.php";

#getting data from the table Clients
$job = $_REQUEST['job'];
if ($job == 'insert') {
    table_PassportReminders ('insert', NULL, NULL);

}
else {
    $Search = $_REQUEST['Search'];
    $limit = 9999;
    if (empty($_REQUEST['sorting'])) {
        $sorting = "ORDER BY Expiry ASC ";
    }
    else {
        $sorting = $_REQUEST['sorting'];
    }
    $rows_Clients = table_Clients ($job, NULL, $Search, $limit, $sorting);
}
?>
<table>
    <thead>
        <tr>
        <th></th>
            <th>
                Name
                <span class="sorter" onclick="sortTablePassportExpiry('Name', 'ASC');" title="A -> Z">&#9650;</span>
                <span class="sorter" onclick="sortTablePassportExpiry('Name', 'DESC');" title="Z -> A">&#9660;</span>
            </th>
            <th>
                Passport No
            </th>
            <th>
                Passport Expiry
                <span class="sorter" onclick="sortTablePassportExpiry('Expiry', 'ASC');" title="Oldest -> Newest">&#9650;</span>
                <span class="sorter" onclick="sortTablePassportExpiry('Expiry', 'DESC');" title="Newest -> Oldest">&#9660;</span>
            </th>
            <th>
                Mobile
            </th>
            <th>
                Email
            </th>
            <th>
                Created by
                <span class="sorter" onclick="sortTablePassportExpiry('Username', 'ASC');" title="A -> Z">&#9650;</span>
                <span class="sorter" onclick="sortTablePassportExpiry('Username', 'DESC');" title="Z -> A">&#9660;</span>
            </th>
            <th>
                On
                <span class="sorter" onclick="sortTablePassportExpiry('Created', 'ASC');" title="Oldest -> Newest">&#9650;</span>
                <span class="sorter" onclick="sortTablePassportExpiry('Created', 'DESC');" title="Newest -> Oldest">&#9660;</span>
            </th>
            <th>
               Show All
               <label class="switch">
                    <input type="checkbox" onclick="openAllReminders();">
                    <span class="slider round"></span>
                </label>
            </th>
        </tr>
        <tr>
            <th colspan="9" style="text-align: center">
                <input type="hidden" name="sorting" id="sorting" value="<? echo $sorting; ?>">
            </th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 1;
        foreach ($rows_Clients as $row_Clients):
        ?>
        <tr>
            <td><? echo $i; ?></td>
            <td><? echo $row_Clients->Title." ".$row_Clients->Name; ?></td>
            <td><? echo $row_Clients->PassportNo; ?></td>
            <td>
                <?php
                $today = date('Y-m-d');
                $six_month = date('Y-m-d', strtotime('180 days'));
                if ($six_month > $row_Clients->Expiry) {
                    echo "<span class=\"error\">".date('d-M-Y', strtotime($row_Clients->Expiry))."</span>";
                }
                else {
                    echo date('d-M-Y', strtotime($row_Clients->Expiry));
                }
                ?>
            </td>
            <td>
                <? echo $row_Clients->Mobile; ?>
            </td>
            <td>
                <a href="<? echo "mailto: $row_Clients->Email"; ?>" title="<? echo $row_Clients->Email ;?>">Email</a>
            </td>
            <td>
                <? echo $row_Clients->Username; ?>
            </td>
            <td title="<? echo date("d-M-Y @ H:i", strtotime($row_Clients->Created));?>"><? echo date("d-M-Y", strtotime($row_Clients->Created));?></td>
            <td>
                Reminders
                <label class="switch">
                <input type="checkbox" onclick="openReminder('<? echo $row_Clients->Id;?>');">
                <span class="slider"></span>
                </label>
            </td>
        </tr>
        <tr>
            <td colspan="10">
                <!-- small form -->
                <div class="reminder-form" style="display: none;" id="<? echo "reminder".$row_Clients->Id; ?>">
                    <form id="<? "form".$row_Clients->Id; ?>">
                        <ul>
                            <li>
                                <input type="hidden" readonly name="ClientsId" id="<? echo "ClientsId".$row_Clients->Id; ?>" value="<? echo $row_Clients->Id?>">
                                <input type="text" name="Method" id="<? echo "Method".$row_Clients->Id; ?>" placeholder="Reminder by Phone, Email or SMS">
                                <button type="button" onclick="insertReminder('<? echo $row_Clients->Id; ?>');">Submit</button>
                            </li>
                        </ul>
                    </form>
                    <ul>
                    <?php
                    # getting data from the table Passport_Reminders
                    $rows_PassportReminders = table_PassportReminders ('select_for_one_client', $row_Clients->Id, NULL);
                    foreach ($rows_PassportReminders as $row_PassportReminders):
                    ?>
                    <li>
                        <? echo "By: ".$row_PassportReminders->Method." on ". date('d-M-Y @ H:i', strtotime($row_PassportReminders->Created)); ?>
                        <? echo " - ".$row_PassportReminders->Username; ?>
                    </li>
                    <?php endforeach; ?>
                    </ul>
                </div>
                <!-- end of small form -->
            </td>
        </tr>
        <?php
        $i++;
        endforeach;
        ?>
    </tbody>
</table>
<script src="scripts/jQuery.js"></script>
<script src="scripts/main.js"></script>
