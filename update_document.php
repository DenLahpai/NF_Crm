<?php
require_once "functions.php";

#checking if DocumentsId is a number
check_num ($_REQUEST['DocumentsId']);

# getting data from the table Documents
$rows_Documents = table_Documents ('select_one', $_REQUEST['DocumentsId'], NULL);
foreach ($rows_Documents as $row_Documents) {
    # Code...
}

#getting data from the table Clients 
$rows_Clients = table_Clients ('select_one', $row_Documents->ClientsId, NULL, NULL, NULL);
foreach ($rows_Clients as $row_Clients) {
    # Code...
}

if ($_SERVER['REQUEST_METHOD'] == 'POST'){    
    $file = $_FILES['file'];
    
    #getting the file extension
    $ext = explode('.', $file['name']);
    $file_ext = strtolower(end($ext));

    # checking if there is any error
    if ($file['error'] == 0) {

        # checking if file size is over 30MB
        if ($file['size'] <= 31457280) {

            # checking for allowed file extension
            $allowed_ext = array('jpg', 'jpeg', 'png'); 
            if (in_array($file_ext, $allowed_ext)) {

                # deleting the current file
                $file_delete = 'Documents/'.$row_Documents->FileName;
                unlink($file_delete); 

                #generating file name
                $file_name = $row_Documents->DocType.'_ClientsId'.$row_Clients->Code.'.'.$file_ext;

                $file_destination = 'Documents/'.$file_name;
                move_uploaded_file($file['tmp_name'], $file_destination);

                # inserting file data to the table Documents
                table_Documents ('update', $_REQUEST['DocumentsId'], $file_name);           
            }

            else {
                # error for not allowed file extension
                echo "<span style=\"color: red;\">";
                echo "Only files with the following extensions are allowed: jpg, jpeg, png and pdf. <br>";
                echo "Please go back and try again!";
                echo "</span>";
            }
        }

        else {
            echo "<span class=\"error\">";
            echo "The file size is too large! Please select a file that is smaller than 30MB";
            echo "Please go back and try again!";
            echo "</span>";
        }               
    }

    else {
        # Error in file upload
        echo "<span class=\"error\">";
        echo "There was an error uploading file!";
        echo "Please go back and try again!";
        echo "</span>";
    }
}

?>
<html lang="en" dir="ltr">
<?php
$page_title = $row_Documents->DocType." - ".$row_Clients->Name;
include "includes/head.php";
?>
<body>
    <!-- content  -->
    <div class="content">
        <?php  
        include "includes/nav.php";
        $header = $page_title;
        include "includes/header.php";
        ?>
        <main>
            <!-- image  -->
            <div class="image">
                <!-- img-menu -->
                <div class="img-menu">
                    <span class="error" style="text-decoration: underline; cursor: pointer; margin-right: 72px;" onclick="deleteImg(<? echo $_REQUEST['DocumentsId']; ?>);">&#10008 Delete</span>
                    <form action="#" method="post" enctype="multipart/form-data">
                       <input type="file" name="file" title="Choose a file to replace the current file!">
                       <button type="button" id="buttonSubmit" onclick="updateImg(<? echo $_REQUEST['DocumentsId']; ?>)">Replace</button>
                    </form>
                </div>
                <!-- end of img-menu -->
                <!-- img-full  -->
                <div class="img-full">
                    <p class="error">
                        <?php  
                        if (!empty($error)) {
                            echo $error;
                        } 
                        ?>    
                    </p>
                    <img src="<? echo "Documents/".$row_Documents->FileName; ?>" alt="">
                </div>
                <!-- end of img-full  -->                
            </div>
            <!-- end of image  -->
        </main>
    <?php include "includes/footer.php"; ?>
    </div>
    <!-- end of content  -->
</body>
<script type="text/javascript">
    //function to delete document
    function deleteImg (DocumentsId) {
        
        var q = confirm ('Are you sure to delete? \nOnce deleted, it cannot be recovered.');
        if (q == true) {
            window.location.href='delete_document.php?DocumentsId='+DocumentsId;
        }
    }

    //function to update document
    function updateImg (DocumentsId) {
        var reply = confirm ('Are you sure to replace the existing file with this?');
        if (reply == true) {
            document.getElementById('buttonSubmit').type = "submit";
        }
       
    }
</script>
</html>