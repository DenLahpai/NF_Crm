<?php
require_once "functions.php";

# getting data from the table Clients
$rows_Clients = table_Clients ('select_all', NULL, NULL);
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<?php
$page_title = "Upcoming Birthdays";
include "includes/head.php";
?>
<body>
    <!-- content -->
    <div class="content">
        <?php
        $header = "Upcoming Birthdays in ".date('M Y');
        include "includes/header.php";
        include "includes/nav.php";
        ?>
        <main>
            <!-- grid-div -->
            <div class="grid-div">
                <?php
                $this_month = date('M');
                $this_year = date('Y');
                foreach ($rows_Clients as $row_Clients) {
                    echo $birth_month = date('M', strtotime($row_Clients->DOB));
                    if ($this_month == $birth_month) {
                        echo "<!-- grid-item -->";
                        echo "<div class=\"grid-item\">";
                        echo "<form action=\"birthday_wish.php?ClientsId=$row_Clients->Id\" method=\"post\">";
                        echo "<ul>";
                        echo "<li>".$row_Clients->Title." ".$row_Clients->Name."</li>";
                        echo "<li class=\"bold\">".date('d-M-Y', strtotime($row_Clients->DOB))."</li>";
                        # checking if birthday wish has been made this year
                        # checking the clients data in the the table BirthdayWish
                        $row_BirthdayWishes = table_BirthdayWishes ('check_wish_for_this_year', $row_Clients->Id, $this_year);
                        echo "</ul>";
                        echo "</form>";
                        echo "</div>";
                        echo "<!-- end of grid-item -->";
                    }
                }
                ?>
            </div>
            <!-- end of grid-div -->
        </main>
    </div>
    <!-- end of content -->
</body>
</html>
