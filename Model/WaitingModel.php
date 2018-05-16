<?php
require_once ("..\Public\Interfaces\CRUDInterface.php");
require_once ("..\Public\Database\DBConnect.php");
class Waiting implements CRUD{
    public $ID;
    public $patient_id;
    public $dep_id;
    public $waiting_date;
    public $waiting_number;


    public function Insert()
    {
        $DB = DB::getInstance();
        $sql = 'INSERT INTO waiting (dep_id,patient_id,waiting_date,waiting_number) VALUES ("'.$this->dep_id.'","'.$this->patient_id.'","'.$this->waiting_date.'","'.$this->waiting_number.'")';
        $DB->execute($sql);
    }

    public function Delete()
    {
        $DB = DB::getInstance();
        $sql = "DELETE FROM waiting WHERE id = '".$this->ID."'";
        $result=$DB->execute($sql);
        return $result;
    }

    public function Modify()
    {
        $DB = DB::getInstance();
        $sql = '';
        $DB->execute($sql);
    }

    public function Select()
    {
        $DB = DB::getInstance();
        $sql = 'SELECT * FROM waiting INNER JOIN user on waiting.patient_id=user.id where dep_id ="'.$this->dep_id.'" ORDER BY waiting_number DESC';
        $result =$DB->execute($sql);
        if ($result != null){
            return $result;
        }
        else {
            return 0;
        }
    }

}
?>