<?php
require_once ("../Public/Database/DBConnect.php");
require_once ("../Public/Interfaces/CRUDInterface.php");

class EmployeeModel implements CRUD{
    public $id;
    public $user_id;
    public $dep_id;
    public $salary_id;

    public function Insert()
    {
        $DB = DB::getInstance();
        $sql= "INSERT INTO `employee`(`user_id`, `dep_id`, `salary_id`) VALUES
                ('".$this->user_id."','".$this->dep_id."','".$this->salary_id."')";
        $DB->execute($sql);
        return $this->Select();
    }


    public function Delete()
    {
        $DB = DB::getInstance();
        $sql = "DELETE FROM employee WHERE id = '".$this->ID."'";
        $result = $DB->execute($sql);
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
        $sql = "SELECT id FROM employee WHERE user_id = '".$this->user_id."'";
        $Result = $DB->execute($sql);
        $row = mysqli_fetch_array($Result);
        return $row['id'];
    }
    public function SelectEmpInfo()
    {
        $DB = DB::getInstance();
        $sql = 'SELECT * FROM employee  where id = "'.$this->ID.'"';
        $result=  $DB->execute($sql);
        if ($result != null){
            return $result;
        }
        else {
            return 0;
        }
    }
    public function SelectDepartment()
    {
        $DB = DB::getInstance();
        $sql = 'SELECT dep_id,department.name FROM employee INNER JOIN user on employee.user_id = user.id inner join department on employee.dep_id=department.id where user.id = "'.$this->ID.'"';
        $result=  $DB->execute($sql);


        if ($result != null){
            return $result;
        }
        else {
            return 0;
        }
    }
    public function Select_dep()
    {
        $DB = DB::getInstance();
        $sql = "SELECT * FROM employee where dep_id=".$this->dep_id;
        $result=  $DB->execute($sql);
        if ($result != null){
            return $result;
        }
        else {
            return 0;
        }
    }
}
?>
