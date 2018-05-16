<?php
require_once ("..\Public\Interfaces\CRUDInterface.php");
require_once ("..\Public\Database\DBConnect.php");
class SalaryModel implements CRUD{
    public $ID;
    public $salary;
    public $tax;
    public $incentives;
    public $economic_sal;

    public function Insert()
    {
        $DB = DB::getInstance();
        $sql = 'INSERT INTO salary (salary,tax,incentives,economic_sal) VALUES ("'.$this->salary.'","'.$this->tax.'","'.$this->incentives.'","'.$this->economic_sal.'")';
        $DB->execute($sql);
        return mysqli_insert_id($DB->con);
    }

    public function Delete()
    {
        $DB = DB::getInstance();
        $sql = "DELETE FROM salary WHERE id = '".$this->ID."'";
        $result=$DB->execute($sql);
        return $result;
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
      $sql = "SELECT FROM salary WHERE id = '".$this->ID."'";
      $result=$DB->execute($sql);
      return $result;
    }
}
?>
