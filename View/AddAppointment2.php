<?php
require_once ("..\Controller\DoctorController.php");
require_once ("..\Model\DoctorModel.php");
require_once ("..\Controller\UserController.php");
$DoctorObjects = new DoctorController();
$Objects = $DoctorObjects->GetDepDR($_POST['Dep']);
$Usercontroller = new UserController();
?>

<html>
<body>
<form action="..\Controller\AppointmentController.php" method="post">
    Patient ID : <input type="number" name = "ID" required>
   Select Doctor: <select name = "DoctorID">
        <?php
            for ($x=0;$x<count($Objects);$x++){
                echo "<option value = ".$Objects[$x]->ID.">".$Usercontroller->getName($Objects[$x]->Employee_ID)."</option>";
            }
        ?>
    </select>
    <input type = "submit" value="Add Appointment" name = "add">
</form>
</body>
</html>
