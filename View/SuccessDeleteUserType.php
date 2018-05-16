<?php
require_once ("..\Controller\UserTypeController.php");
require_once ("..\Model\UserTypeModel.php");
$Results = UserTypeController::EditUserType();

?>

<html>
<head>
    <title>Delete User Type</title>
</head>

<body>
<h4 style="color: green;">User Type Deleted Successfully</h4>
<h4 style="color: red;">Please Know that Deleteing Certain User Type will Delete Add Users Associated with this User Type</h4>

<form action = "..\Controller\UserTypeController.php" method="post">
    <select name = "UserType">
        <?php

        if ($Results == NULL){
            echo "<option>No Data To Show Please Enter Some UserTypes First</option>";
        }
        else{
            $Size = count($Results);
            for ($x=0;$x<$Size;$x++){
                echo '<option value = '.$Results[$x]->ID.'>'.$Results[$x]->Type.'</option>';
            }
        }
        ?>
    </select>
    <input type = "submit" name = "DeleteUserType" Value = "Delete">
    <a href="Menue.php"><input type="button" value="Back"></a>

</form>

</body>
</html>
