<?php

require_once ("..\Model\AppointmentModel.php");
require_once ("..\Model\Forward_Doctor.php");
require_once ("../Model/DoctorModel.php");
require_once ("../Model/TimeSlotsModel.php");
require_once ("../Controller/UserController.php");
if (isset($_POST['Add'])){
    AppointmentController::AddAppointment();
}
elseif (isset($_GET['Doctors'])){
    AppointmentController::AjaxFunction();
}
elseif (isset($_GET['ID'])){
    AppointmentController::ForwardDoctor();
}

class AppointmentController
{
    public function AddAppointment()
    {
        $PatientID = $_POST['ID'];
        $DoctorID = $_POST['Doctors'];
        $TimeSlotID = $_POST['TimeSlots'];
        //****Cehcking User In the Database
        $UserControllerObject = new UserController();
        $Result = $UserControllerObject->Check($PatientID);
        if ($Result == NULL){
            header("Location:../View/FaildAddAppointment.php");
            exit;
        }
        else{
            $AppointmentModelObject = new AppointmentModel();
            $AppointmentModelObject->Patient = $PatientID;
            $AppointmentModelObject->Doctor = $DoctorID;
            $AppointmentModelObject->TimeSlot_ID = $TimeSlotID;
            $AppointmentModelObject->status = 0;
            $Result = $AppointmentModelObject->Check();
            if ($Result){
                header("Location:../View/ExistingAppointment.php");
                exit;
            }
            else{
                $AppointmentModelObject->Insert();
                header("Location:../View/AddAppointment.php");
                exit;
            }

        }

    }
    public function AjaxFunction(){
        $DoctorID = $_GET['Doctors'];
        $AppDate = $_GET['Date'];

        $TimeSlotsObject = new TimeSlotsModel();
        $TimeSlotsObject->Doctor_ID = $DoctorID;
        $TimeSlotsObject->Day = $AppDate;
        $Results = $TimeSlotsObject->Select();
        $StringArray = array();
        if ($Results == NULL){
            return NULL;
        }
        else{
            for ($x=0;$x<count($Results);$x++){
                $StringArray[$x] = $Results[$x]->From."-".$Results[$x]->To;
                echo json_encode("<option value = ".$Results[$x]->ID.">".$Results[$x]->From."-".$Results[$x]->To);
            }

        }


        }
    public function GetAppointments($ID){
        $AppointmentModel = new AppointmentModel();
        return $AppointmentModel->SelectAppointments($ID);

    }

    public function ForwardDoctor(){
        $Forward = new Forward_Doctor();
        $Forward->Appointment_ID = $_GET['ID'];
        $Forward->Insert();
        header("Location:../View/NurseScreen.php");
        exit;
    }

    public function GetDoctorAppointments($ID){
        $Forward = new Forward_Doctor();
        $ForwardID =  $Forward->SelectAppointment($ID);
        $Forward->ID = $ForwardID;
        $ForwardObject = $Forward->Select();
        $AppointmentID = $ForwardObject->Appointment_ID;
        $AppointmentModelObject = new AppointmentModel();
        $AppointmentModelObject->ID = $AppointmentID;
        $AppointmentObject = $AppointmentModelObject->Select();
        return $AppointmentObject;
    }
}
    ?>