<html>
<head>
    <meta charset="utf-8">
    <title>Medical Report</title>
    <?php
    require_once ("..\Controller\RecordController.php");
    ?>
</head>
<body>

<form  action="<?php echo "..\Controller\RecordController.php?patient_id=".$patient_id; ?>" method="post" id="medicalreport">
    <br> Patient Name: <input type="text" name="patient_name" id="PatientNameid" value="<?php echo $patient_name;?>" style="border :none " required> <br>
    <br> Date: <input type="text" name="date" value="<?php echo $date;?>"  style="border :none " required>  <br>
    <br> Physician Name: <input type="text" name="doctor_name" value="<?php echo $doctor_name;?>"  style="border :none " required>  <br>
    <h2>Medical Report</h2>

    <br> <textarea name="report" rows="30" cols="90" form="medicalreport" value="" style="border :none " required>On making a medical examination on Mr./Mrs. <?php echo $patient_name." ";?></textarea>  <br>
    <h3>Hospital Manager   &nbsp;&nbsp;  &nbsp;&nbsp;   &nbsp;&nbsp;  &nbsp;&nbsp;  &nbsp;&nbsp;  &nbsp;&nbsp;    &nbsp;&nbsp;  &nbsp;&nbsp;  &nbsp;&nbsp;  &nbsp;&nbsp;   Physician</h3>
    <br> <input type="submit" name="AddRecord" value="Save">
</form>
<button type="button" name="backbutn" id="backbutn" onclick="goback()">back</button>
<button onclick="myFunction()">Print</button>

</body>
</html>