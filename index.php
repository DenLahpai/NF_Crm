<?php
require_once "handler.php";

if (isset($_REQUEST['error'])) {
    $error = trim($_REQUEST['error']);
}
else {
    $error = NULL;
}

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
    <?php
    $page_title = 'Welcome';
    include "includes/head.php";
    ?>
    <body>
        <!-- content -->
        <div class="content">
            <?php
            $header = 'Welcome to CRM';
            include "includes/header.php"
            ?>
            <main>
                <!-- login -->
                <div class="login">
                    <form action="login.php" method="post">
                        <p>Please login!</p>
                         <p class="error">
                            <?php if (!empty($error)) { echo $error; } ?>
                        </p>
                        <input type="text" name="Username" placeholder="Username" required>
                        <br>
                        <input type="password" name="Password" placeholder="Password" required>
                        <br>                        
                        <button type="submit" class="medium button" name="buttonSubmit" id="buttonSubmit">Login</button>
                    </form>
                </div>
                <!-- end of login -->
            </main>
            <?php include "includes/footer.php"; ?>
        </div>
        <!-- end of content -->
    </body>
</html>