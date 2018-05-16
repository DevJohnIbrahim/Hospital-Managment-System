<?php
    require_once ("..\Controller\UserTypeController.php");
    require_once ("..\Model\UserTypeModel.php");
    require_once ("..\Controller\UserController.php");
    $_SESSION['ID2'] = $_POST['ID'];
    $Results = UserTypeController::EditUserType();


?>
<html>
<head>
    <title>Enter the Desired User Type</title>
</head>
<body>
<form action = "..\Controller\UserController.php" method="post">
    <select name = "UTID">
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
    <input type = "submit" name = "EditUserType" value = "Edit">
</form>
</body>
</html>