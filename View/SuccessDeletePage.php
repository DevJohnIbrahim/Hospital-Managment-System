<?php
require_once ("..\Controller\PageController.php");
require_once ("..\Model\PageModel.php");
$Objects = PageController::getAllPages();
?>
<html>
<head>
    <title>Delete Page</title>
</head>
<h4 style="color: green;">Page Delete Successfully</h4>
<h4 style="color: red;">Please Note that Deleteing Page is going to Delete Page from the Database not from the Disk</h4>
<body>
<form action = "..\Controller\PageController.php" method="post">
    <select name = "ID">
        <?php
        for ($x=0;$x<count($Objects);$x++){
            echo "<option value = ".$Objects[$x]->ID.">".$Objects[$x]->Friendly_Name."</option>";

        }
        ?>
    </select><br>
    <input type = "submit" name = "DeletePage" value = "Delete">
    <a href="Menue.php"><input type="button"value="Back"></a>

</form>
</body>
</html>
