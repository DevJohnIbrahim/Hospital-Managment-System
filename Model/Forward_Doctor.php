<?php
require_once ("..\Public\Database\DBConnect.php");
require_once ("..\Public\Interfaces\CRUDInterface.php");
class Forward_Doctor implements CRUD{
    public $ID;
    public $Appointment_ID;
    public function Insert()
    {
        $DB = DB::getInstance();
        $sql = "INSERT INTO `forward_doctor`(`Appointment_ID`) VALUES ('".$this->Appointment_ID."')";
        $DB->execute($sql);
    }

    public function Delete()
    {
       $DB = DB::getInstance();
       $sql = "DELETE FROM `forward_doctor` WHERE Appointment_ID = '".$this->Appointment_ID."'";
       $DB->execute($sql);
    }

    public function Modify()
    {
        // TODO: Implement Modify() method.
    }

    public function Select()
    {
        $DB = DB::getInstance();
        $sql = "SELECT * FROM forward_doctor WHERE ID = '".$this->ID."'";
        $Result = $DB->execute($sql);
        $row = mysqli_fetch_array($Result);
        $Object = new self();
        $Object->ID = $row['ID'];
        $Object->Appointment_ID = $row['Appointment_ID'];
        return $Object;
    }

    public function SelectAppointment($ID){
        $DB = DB::getInstance();
        $sql = "SELECT ID FROM forward_doctor WHERE Appointment_ID = (SELECT ID FROM appointment WHERE doctor_id = '".$ID."')";
        $Result = $DB->execute($sql);
        $row = mysqli_fetch_array($Result);
        return $row['ID'];
    }

    public function SelectDrAppointment ($ID){
        $DB = DB::getInstance();
        $sql = "SELECT Appointment_ID FROM forward_doctor WHERE Appointment_ID IN (SELECT ID FROM appointment WHERE doctor_id = '".$ID."')";
        $Result = $DB->execute($sql);
        if ($Result->num_rows>0){
            $row = mysqli_fetch_array($Result);
            return $row['Appointment_ID'];
        }
        else{
            return NULL;
        }
    }

   /* public function checkdoctor ($ID){
        $sql = "SELECT doctor_id FROM appointment WHERE ID "
    }*/
}
?>