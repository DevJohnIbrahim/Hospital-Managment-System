<?php
require_once ("..\Model\UserTypeModel.php");
require_once ("..\Model\PageModel.php");
require_once ("..\Controller\PageController.php");
require_once ("..\Controller\UserTypeController.php");
$UserTypesObjects = UserTypeController::EditUserType();
$PageObjects = PageController::getAllPages();
?>

<html>
<head>
    <title>Assign Pages To User Type</title>
</head>

<body>
<h4 style="color:red;">Sorry But this page isn't assigned to this user type please make sure about what you have entered and try again</h4>
<form action="..\Controller\User_PagesController.php" method="post">
    Pages : <select name = "PageID">
        <?php
        for ($x=0;$x<count($PageObjects);$x++){
            echo "<option value = ".$PageObjects[$x]->ID.">".$PageObjects[$x]->Friendly_Name."</option>";
        }

        ?>
    </select>

    <br>
    User Types : <select name = "UserTypeID">
        <?php
        for ($x=0;$x<count($UserTypesObjects);$x++){
            echo "<option value = ".$UserTypesObjects[$x]->ID.">".$UserTypesObjects[$x]->Type."</option>";
        }

        ?>
    </select><br>
    <input type = "submit" name = "Delete" value = "Remove">
    <a href="Menue.php"><input type="button" value="Back"></a>

</form>
</body>
</html>
