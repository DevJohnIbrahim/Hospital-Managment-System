<?php
require_once ("..\Public\Interfaces\CRUDInterface.php");
require_once ("..\Public\Database\DBConnect.php");
class schedule implements CRUD{
    public $ID;
    public $employee_id;
    public $dep_id;
    public $day;
    public $time_from;
    public $time_to;

    public function Insert()
    {
        $DB = DB::getInstance();
        $sql = 'INSERT INTO schedule (Employee_ID,Dep_ID,Day,Starting_time,Ending_time) VALUES ("'.$this->employee_id.'","'.$this->dep_id.'","'.$this->day.'","'.$this->time_from.'","'.$this->time_to.'")';
        $DB->execute($sql);
    }

    public function Delete()
    {
        $DB = DB::getInstance();
        $sql ="DELETE FROM schedule WHERE ID = ".$this->ID;
        $DB->execute($sql);

    }

    public function Modify()
    {
        $DB = DB::getInstance();
        $sql = "";
        $DB->execute($sql);
    }

    public function Select()
    {

      $DB = DB::getInstance();
      $sql = "SELECT * FROM schedule where Dep_ID =".$this->dep_id;
      $result=$DB->execute($sql);
      return $result;
    }
    public function Select_employee()
    {
      $DB = DB::getInstance();
      $sql = "SELECT * FROM schedule where Employee_ID =".$this->employee_id;
      $result=$DB->execute($sql);
      return $result;
    }
}
?>
