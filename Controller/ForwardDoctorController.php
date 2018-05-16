<?php
require_once ("../Model/Forward_Doctor.php");
require_once ("../Model/AppointmentModel.php");

class ForwardDoctorController{
    public function getAllDrAppointments($DRID){
        $ForwardDoctorModel = new Forward_Doctor();
        $Appointment_ID = $ForwardDoctorModel->SelectDrAppointment($DRID);
        $AppointmentModel = new AppointmentModel();
        $AppointmentModel->ID = $Appointment_ID;
        $AppointmentObject = $AppointmentModel->Select();
        return $AppointmentObject;
    }
}
?>