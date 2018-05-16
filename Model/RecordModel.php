<?php
require_once ("../Public/Database/DBConnect.php");
require_once ("../Public/Interfaces/CRUDInterface.php");
class RecordModel implements CRUD {
    public $id; //Auto Increment
    public $patient_id;
    public $doctor_id;
    public $Record_Date; //Time Stamp
    public $Record_Path;

    public function Insert()
    {
        $DB = DB::getInstance();
        $sql = "INSERT INTO `record`(`patient_id`, `doctor_id`,`Record_Path`) VALUES 
                ('".$this->patient_id."','".$this->doctor_id."','".$this->Record_Path."')";
        $DB->execute($sql);
    }

    public function Delete()
    {
        $DB = DB::getInstance();
        $sql= "DELETE FROM record WHERE id = '".$this->id."'";
        $DB->execute($sql);
    }

    public function Modify()
    {
        // TODO: Implement Modify() method.
    }

    public function Select()
    {
        $DB = DB::getInstance();
        $sql = "SELECT * FROM record WHERE id = '".$this->id."'";
        $Result = $DB->execute($sql);
        if ($Result->num_rows>0){
            $row = mysqli_fetch_array($Result);
            $RecordModelObject = new RecordModel();
            $RecordModelObject->id = $row['id'];
            $RecordModelObject->patient_id = $row['patient_id'];
            $RecordModelObject->doctor_id = $row['doctor_id'];
            $RecordModelObject->Record_Date = $row['Record_Date'];
            $RecordModelObject->Record_Path = $row['Record_Path'];
            return $RecordModelObject;
        }
        else{
            return NULL;
        }
    }

    public function SelectPatientRecords(){
        $DB = DB::getInstance();
        $sql = "SELECT * FROM record WHERE patient_id = '".$this->patient_id."'";
        $Result = $DB->execute($sql);
        if ($Result->num_rows>0){
            $Objects = array();
            $x=0;
            while ($row = mysqli_fetch_array($Result)){
                $Objects[$x] = new RecordModel();
                $Objects[$x]->id = $row['id'];
                $Objects[$x]->patient_id = $row['patient_id'];
                $Objects[$x]->doctor_id = $row['doctor_id'];
                $Objects[$x]->Record_Date = $row['Record_Date'];
                $Objects[$x]->Record_Path = $row['Record_Path'];
                $x++;
            }
            return $Objects;
        }
        else{
            return NULL;
        }
    }
}
?>