<?php
require_once ("..\Public\Interfaces\CRUDInterface.php");
require_once ("..\Public\Database\DBConnect.php");

class PendingPaymentModel implements CRUD
{
    public $ID;
    public $Appointment_ID;
    public $TotalPrice;

    public function Insert()
    {
        $DB = DB::getInstance();
        $sql = "INSERT INTO `pending_payment`(`Appointment_ID`, `TotalPrice`) VALUES
                ('" . $this->Appointment_ID . "','" . $this->TotalPrice . "')";
        $DB->execute($sql);
    }

    public function Delete()
    {
        $DB = DB::getInstance();
        $sql = "DELETE FROM pending_payment WHERE ID = '".$this->ID."'";
        echo $sql;
        $DB->execute($sql);
    }

    public function Modify()
    {
        // TODO: Implement Modify() method.
    }

    public function Select()
    {
        $sql = "SELECT * FROM pending_payment WHERE Appointment_ID = '" . $this->Appointment_ID . "'";
        $DB = DB::getInstance();
        $Result = $DB->execute($sql);
        if ($Result->num_rows > 0) {
            $row = mysqli_fetch_array($Result);
            $Object = new self();
            $Object->Appointment_ID = $row['Appointment_ID'];
            $Object->TotalPrice = $row['TotalPrice'];
            $Object->ID = $row['ID'];
            return $Object;
        } else {
            return NULL;
        }

    }

    public function SelectAppointment()
    {
        $sql = "SELECT * FROM pending_payment WHERE ID = '" .$this->ID. "'";
        $DB = DB::getInstance();
        $Result = $DB->execute($sql);
        if ($Result->num_rows > 0) {
            $row = mysqli_fetch_array($Result);
            $Object = new self();
            $Object->Appointment_ID = $row['Appointment_ID'];
            $Object->TotalPrice = $row['TotalPrice'];
            $Object->ID = $row['ID'];
            return $Object;
        } else {
            return NULL;
        }

    }

    public function GetAllPending($DepID)
    {
        $DB = DB::getInstance();
        $sql = "SELECT * FROM pending_payment WHERE Appointment_ID IN (SELECT id FROM appointment WHERE doctor_id IN(SELECT ID FROM doctor WHERE Employee_ID IN(SELECT id FROM employee WHERE dep_id = '" . $DepID . "')))";
        $Result = $DB->execute($sql);

        if ($Result->num_rows > 0) {
            $Objects = array();
            $x = 0;
            while ($row = mysqli_fetch_array($Result)) {
                $Objects[$x] = new self();
                $Objects[$x]->ID = $row['ID'];
                $Objects[$x]->Appointment_ID = $row['Appointment_ID'];
                $Objects[$x]->TotalPrice = $row['TotalPrice'];
                $x++;
            }
            return $Objects;
        } else {
            return NULL;
        }
    }

    public function getPatientName($ID){
        $sql = "SELECT FirstName , LastName FROM user WHERE ID = (SELECT patient_id FROM appointment WHERE id = (SELECT Appointment_ID FROM pending_payment WHERE ID = '".$ID."'))";
        $DB = DB::getInstance();
        $Result = $DB->execute($sql);
        $row = mysqli_fetch_array($Result);
        return $row['FirstName']." ".$row['LastName'];
    }
}

?>
