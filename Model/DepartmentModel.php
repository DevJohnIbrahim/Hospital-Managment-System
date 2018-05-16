<?php
require_once ("..\Public\Database\DBConnect.php");
require_once ("..\Public\Interfaces\CRUDInterface.php");
class DepartmentModel implements CRUD {
    public $id;
    public $name;
    public $dep_manager_id;
    public $Working_doctors;
    public $working_stuff;
    public function Insert()
    {
        $DB = DB::getInstance();
        $sql = "INSERT INTO department(name,dep_manager_id,Working_doctors,working_staff) VALUES ('".$this->name."','".$this->dep_manager_id."','".$this->working_doctors."','".$this->working_staff."')";
        $DB->execute($sql);
    }

    public function Delete()
    {
        $DB = DB::getInstance();
        $sql = "DELETE FROM department WHERE id = '".$this->ID."'";
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
        $sql = 'SELECT * from department where id = "'.$this->ID.'"';
        $result=$DB->execute($sql);
        if ($result != null){
            return $result;
        }
        else {
            return 0;
        }
    }
    public static function SelectAll(){
        $DB = DB::getInstance();
        $sql = "SELECT * FROM department";

        $Result = $DB->execute($sql);
        if ($Result->num_rows>0){
            $Object = array();
            $x = 0;

            while ($row = mysqli_fetch_array($Result)){
                $Object[$x] = new self();
                $Object[$x]->id = $row['id'];
                $Object[$x]->name = $row['name'];
                $Object[$x]->dep_manager_id = $row['dep_manager_id'];
                $Object[$x]->Working_doctors = $row['Working_doctors'];
                $Object[$x]->working_stuff = $row['working_stuff'];
                $x++;
            }
            return $Object;
        }
        else{
            return NULL;
        }
    }
}

?>
