<?php
require_once ("../Model/RecordModel.php");
require_once ("../Model/DoctorModel.php");
require_once ('../Public/External Libraries/FPDF/fpdf.php');
require_once ("../Model/PendingPaymentModel.php");
require_once ("../Model/EquipmentModel.php");
require_once ("../Model/MedicationModel.php");
require_once ("../Model/AnalysisModel.php");
require_once ("../Controller/AppointmentController.php");
require_once ("../Controller/UserController.php");
require_once ("../Controller/EquipmentController.php");
require_once ("../Controller/MedicationController.php");
require_once ("../Controller/AnalysisController.php");
if (isset($_POST['AddRecord'])){
    RecordController::AddRecord();
}
class RecordController{
    public function GetPatientAllRecords($ID){
        $RecordModelObject = new RecordModel();
        $RecordModelObject->patient_id = $ID;
        $Records = $RecordModelObject->SelectPatientRecords();
        return $Records;
    }

    public function AddRecord(){
        $Examination = $_POST['Examination'];
        $Medication = $_POST['Medications'];
        $Equipment = $_POST['Equipments'];
        $Analysis = $_POST['Analysis'];
        $PatientID = $_POST['PatientID'];
        $DoctorID = $_SESSION['DRID'];
        $UserObject = new UserController();
        $PatientName = $UserObject->getPatientName($PatientID);
        $DoctorName = $UserObject->getDoctorName($DoctorID);
        $AppointmentID = $_POST['AppointmentID'];
        if ($Medication == -1){
            $MedicationName = "Nothing";
            $MedicationPrice = 0;
        }
        else{
            $MedicationObject = new MedicationController();
            $MedicationName = $MedicationObject->GetName($Medication);
            $MedicationPrice = $MedicationObject->GetPrice($Medication);
        }
        if ($Equipment == -1){
            $EquipmentName = "Nothing";
            $EquipmentPrice = 0;
        }
        else{
            $EquipmentObject = new EquipmentController();
            $EquipmentName = $EquipmentObject->GetName($Equipment);
            $EquipmentPrice = $EquipmentObject->GetPrice($Equipment);

        }
        if ($Analysis == -1){
            $AnalysisName = "Nothing";
            $AnalysisPrice = 0;
        }
        else{
            $AnalysisObject = new AnalysisController();
            $AnalysisName = $AnalysisObject->GetName($Analysis);
            $AnalysisPrice = $AnalysisObject->GetPrice($Analysis);

        }
        //******Creating PDF File and Saving it On the Local Storage
        $PDF = new FPDF();
        $PDF->AddPage();
        $PDF->SetFont("Arial","",13);
        $PDF->Cell(40,10,"DR. ".$DoctorName);
        $PDF->Ln();
        $PDF->Cell(40,10,"Patient Name : ".$PatientName);
        $PDF->Ln();
        $PDF->Cell(40,10,"Examination : ".$Examination);
        $PDF->Ln();
        $PDF->Cell(40,10,"Medications: ".$MedicationName);
        $PDF->Ln();
        $PDF->Cell(40,10,"Equipments Used: ".$EquipmentName);
        $PDF->Ln();
        $PDF->Cell(40,10,'Analysis: '.$AnalysisName);
        $Rand = rand();
        $FileName = $PatientID.$DoctorID.$DoctorName.$Rand.".pdf";
        $dir = "../Record/";
        $PDF->Output($dir.$FileName,'F');
        //******Adding the New Record and The saved File Path into  The Record table

        $RecordObject = new RecordModel();
        $RecordObject->Record_Path = "../Record/".$FileName;
        $RecordObject->doctor_id = $DoctorID;
        $RecordObject->patient_id = $PatientID;
        $RecordObject->Insert();
        //*******Getting the Total Price and Adding new Record in the Pending Payment Table..


        $PendingPayment = new PendingPaymentModel();
        $PendingPayment->Appointment_ID = $AppointmentID;
        $PendingPayment->TotalPrice = $AnalysisPrice+$EquipmentPrice+$MedicationPrice;
        $PendingPayment->Insert();

        //*****Deleting the Appointment record From the Forward DR
        $ForwardDoctorObject = new Forward_Doctor();
        $ForwardDoctorObject->Appointment_ID = $AppointmentID;
        $ForwardDoctorObject->Delete();
        header("Location:../View/DoctorScreen.php");
        exit;


    }
}
?>