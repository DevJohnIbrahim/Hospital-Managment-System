<?php
require_once ("../Controller/DepartmentController.php");
require_once ("../Model/DepartmentModel.php");

$Departments = DepartmentController::getAllDep();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Doctor</title>
</head>
<body>
  <h3>Add Doctor</h3>
<form action = "../Controller/DoctorController.php" method="post">
    User ID : <input type = "number" name = "UID" required><br><br>
    Department: <select name = "Dep_ID">
        <?php
            for ($x=0;$x<count($Departments);$x++){
                echo "<option value = ".$Departments[$x]->id.">".$Departments[$x]->name."</option>";
            }
        ?>

    </select>
    <br><br>
  Job Type: <select name = "job_type">
        <option value ="1">Full Time</option>
        <option value ="2">Part Time</option>
    </select>
    <br><br>
    <input type = "submit" name = "AddDoctor" value="Save Data">
</form>
</body>
</html>
