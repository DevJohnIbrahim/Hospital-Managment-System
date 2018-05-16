<?php
require_once ("../Model/RecordModel.php");
require_once ("../Model/AnalysisModel.php");
require_once ("../Model/MedicationModel.php");
require_once ("../Model/EquipmentModel.php");
require_once ("../Controller/ForwardDoctorController.php");
require_once ("../Controller/DoctorController.php");
require_once ("../Controller/UserController.php");
require_once ("../Controller/RecordController.php");
require_once ("../Controller/AnalysisController.php");
require_once ("../Controller/MedicationController.php");
require_once ("../Controller/EquipmentController.php");
$DoctorControllerObject = new DoctorController();
echo "<form action = 'DoctorScreen.php' method = 'post'>";
echo "<input type = 'submit' name = 'logout' value = 'Logout'>";
echo "</form>";

if (isset($_POST['logout'])){
    session_destroy();
    header("Location:DoctorScreen.php");
    exit;
}
if (!isset($_SESSION['ID'])){
    header("Location:Login.html");
    exit;
}
$_SESSION['DRID'] = $DoctorControllerObject->GetDrID($_SESSION['ID']);
$UserControllerObject = new UserController();
$DoctorName = $UserControllerObject->getDoctorName($_SESSION['DRID']);
$ForwardDoctorObject = new ForwardDoctorController();
$AppointmentObject = $ForwardDoctorObject->getAllDrAppointments($_SESSION['DRID']);

$MedicationControllerObject = new MedicationController();
$EquipmentControllerObject = new EquipmentController();
$AnalysisControllerObject = new AnalysisController();

$Medications = $MedicationControllerObject->getAllMedications();
$Equipments = $EquipmentControllerObject->GetAllEq();
$Analysis = $AnalysisControllerObject->GetAll();
echo "<h4>Welcome DR. ".$DoctorName."</h4>";
if ($AppointmentObject == NULL){
    echo "<h4>You Currently Don't Have any patients</h4>";
}
else{
    $RecordControllerObject = new RecordController();
    $Records = $RecordControllerObject->GetPatientAllRecords($AppointmentObject->Patient);
    $PatientName = $UserControllerObject->getPatientName($AppointmentObject->Patient);

    echo "<h4>Patient Name :".$PatientName."</h4>";
    if ($Records == NULL){
        echo "<h4 style = 'color:red;'>This Patient doesn't Have any Records</h4>";
    }
    else{
        echo "<table width = '200' border = '1'>";
        echo "<tr>";
        echo "<th>Doctor Name</th>";
        echo "<th>Date</th>";
        echo "<th>Read</th>";
        echo "<tr>";
        for ($x=0;$x<count($Records);$x++){
            echo "<tr>";
            echo "<td>".$UserControllerObject->getDoctorName($Records[$x]->doctor_id)."</td>";
            echo "<td>".$Records[$x]->Record_Date."</td>";
            echo "<td><a href='../View/ViewPDF.php?ID=".$Records[$x]->Record_Path."' target='_blank'><button>Read</button></a></td>";        echo "<tr>";
        }
        echo "</table>";
    }
    echo "<form action = '../Controller/RecordController.php' method='post'>";
    echo "<b>Doctor Examination:</b><br>";
    echo "<textarea rows='10' cols='50' name = 'Examination' required></textarea><br>";
    echo "<select name = 'Medications'>";
    if ($Medications == NULL){
        echo "<option value = '-1'>No Data To show</option>";
    }
    else{
        for ($x=0;$x<count($Medications);$x++){
            echo "<option value =".$Medications[$x]->ID.">".$Medications[$x]->Name."</option>";
        }
    }

    echo "</select><br>";
    echo "<select name = 'Equipments'>";
    if ($Equipments == NULL){
            echo "<option value = '-1'>No Data To Show</option>";
    }
    else{
        for ($x=0;$x<count($Equipments);$x++){
            echo "<option value =".$Equipments[$x]->ID.">".$Equipments[$x]->Name."</option>";
        }
    }

    echo "</select><br>";
    echo "<select name = 'Analysis'>";
    if ($Analysis == NULL){
        echo "<option value = '-1'>No Data to Show</option>";
    }
    else{
        for ($x=0;$x<count($Analysis);$x++){
            echo "<option value =".$Analysis[$x]->ID.">".$Analysis[$x]->Name."</option>";
        }
    }
    echo "<input type = 'number' name = 'PatientID' value = '".$AppointmentObject->Patient."' style = ' visibility: hidden;'>";
    echo "<input type = 'number' name = 'AppointmentID' value = '".$AppointmentObject->ID."' style = ' visibility: hidden;'>";

    echo "</select><br>";
    echo "<input type = 'submit' name = 'AddRecord' value = 'Done'>";

}
?>