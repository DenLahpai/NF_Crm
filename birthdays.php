<?php
require_once "functions.php";

# getting data from the table Clients
$rows_Clients = table_Clients ('select_all', NULL, NULL);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    echo Submit;
}
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
                $i = 1;
                foreach ($rows_Clients as $row_Clients) {
                    $birth_month = date('M', strtotime($row_Clients->DOB));
                    if ($this_month == $birth_month) {
                        echo "<!-- grid-item -->";
                        echo "<div class=\"grid-item\">";
                        echo "<form action=\"birthday_wish.php?ClientsId=$row_Clients->Id\" method=\"post\" id=\"myForm$i\">";
                        echo "<ul>";
                        echo "<li>".$row_Clients->Title." ".$row_Clients->Name."</li>";
                        echo "<li class=\"bold\">".date('d-M-Y', strtotime($row_Clients->DOB))."</li>";
                        echo "<li>";
                        # checking if birthday wish has been made this year
                        # checking the clients data in the the table BirthdayWish
                        $rowCount = table_BirthdayWishes ('check_wish_for_this_year', $row_Clients->Id, $this_year);
                        if ($rowCount == 0) {
                            echo "<input type=\"text\" name=\"Method$i\" id=\"Method$i\" placeholder=\"Phone, SMS or Email\">";
                            echo "&nbsp;";
                            echo "<button type=\"button\" class=\"medium button\" id=\"buttonSubmit$i\" name=\"buttonSubmit\" onclick=\"submitWish($i);\">Record</button>";
                        }
                        else {

                        }
                        echo "</li>";
                        echo "</ul>";
                        echo "</form>";
                        echo "</div>";
                        echo "<!-- end of grid-item -->";
                        $i ++;
                    }
                }
                ?>
            </div>
            <!-- end of grid-div -->
        </main>
    </div>
    <!-- end of content -->
</body>
<script type="text/javascript">

//function to submit wish
function submitWish (i) {
    var Method = document.getElementById('Method' + i);
    if (!Method.value || Method.value == " ") {
        Method.style.background = '#A52B2A';
    }
    // alert(Method.value);
    
}

</script>
</html>
