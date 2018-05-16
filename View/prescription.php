<html>
<head>
    <meta charset="utf-8">
    <title>Prescription</title>
    <?php
    require_once ("..\Controller\RecordController.php");
    ?>

</head>
<body>
<h2>Prescription</h2>
<form  action="<?php echo "..\Controller\RecordController.php?patient_id=".$patient_id.""; ?>" method="post" id="Prescription">
    <br> Patient Name: <input type="text" name="PatientName" id="PatientNameid" value="<?php echo $patient_name;?>" style="border :none " required>
    &nbsp;&nbsp;  &nbsp;&nbsp;  Date:  <input type="text" name="rec_date" value="<?php echo $date;?>"  style="border :none " required>
    <br>
    <br> PhysicianName: <input type="text" name="PhysicianName" id="PhysicianNameid" value="<?php echo $doctor_name;?>" style="border :none " required>
    &nbsp;&nbsp;   The organization affiliated with it: <input type="text" name="TOAWI" id="TOAWIid" style="border :none">  <br>
    <br> <textarea name="report" rows="30" cols="100" form="Prescription" placeholder="Write prescription here...."  style="border :none" required></textarea>  <br>
    <h3>Signature</h3>
    <br>
    <br> <input type="submit" name="AddRecord" value="Save">
</form>
<button type="button" name="backbutn" id="backbutn" onclick="goback()">back</button>
<button onclick="myFunction()">Print</button>
</body>
</html>