<?php
session_start();
require_once ("..\Public\Database\DBConnect.php");
require_once ("../Controller/DoctorController.php");

$DoctorController1 = new DoctorController();
$query = "SELECT * FROM appointment where doctor_id=".$DoctorController1->getDrID($_SESSION['ID']);
$DB = DB::getInstance();
$result = $DB->execute($query);
$hint = '';
while ($row = mysqli_fetch_array($result)) {
  $query1 = "SELECT * FROM user where ID=".$row["patient_id"];

  $result1 = $DB->execute($query1);
  $row1 = mysqli_fetch_array($result1);
$hint=$hint." <br>".$row1["FirstName"]." ".$row1["LastName"];

}
if ($hint=="") {
  $response="no notification";
} else {
  $response=$hint;
}

//output the response
echo $response;
