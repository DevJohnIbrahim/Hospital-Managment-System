<?php
require_once ("..\Public\Interfaces\CRUDInterface.php");
require_once ("..\Public\Database\DBConnect.php");
class DoctorModel implements CRUD
{
    public $ID;
    public $Employee_ID;
    public $Start_Working_Date;
    public $Working_Hours;
    public $Capacity;
    public function Insert()
    {
        $DB = DB::getInstance();
        $sql = "INSERT INTO `doctor`(Employee_ID, Working_Hours) VALUES ('".$this->Employee_ID."','".$this->Working_Hours."')";
        $DB->execute($sql);
    }

    public function Delete()
    {
        $DB =DB::getInstance();
        $sql = "DELETE FROM `doctor` WHERE ID = '".$this->ID."'";
        $DB->execute($sql);
    }

    public function Modify()
    {
        $DB = DB::getInstance();
        $sql = "UPDATE `doctor` SET `Capacity`='".$this->Capacity."' WHERE ID = '".$this->ID."'";
        $DB->execute($sql);
    }

    public function Select()
    {
       $DB = DB::getInstance();
       $sql = "SELECT * FROM `doctor` WHERE ID = '".$this->ID."'";
       $Result = $DB->execute($sql);
       if ($Result->num_rows>0){
           $row = mysqli_fetch_array($Result);
           $Object = new self();
           $Object->ID = $row['ID'];
           $Object->Working_Hours = $row['Working_Hours'];
           $Object->Employee_ID = $row['Employee_ID'];
           $Object->Start_Working_Date = $row['Start_Working_Date'];
           $Object->Capacity = $row['Capacity'];
           return $Object;
       }
       else{
           return NULL;
       }
    }

    public function SelectAll(){
        $DB = DB::getInstance();
        $sql = "SELECT * FROM `doctor`";
        $Result = $DB->execute($sql);
        if ($Result->num_rows>0){
            $Objects = array();
            $x = 0;
            while ($row = mysqli_fetch_array($Result)){
                $Objects[$x] = new self();
                $Objects[$x]->ID = $row['ID'];
                $Objects[$x]->Working_Hours = $row['Working_Hours'];
                $Objects[$x]->Employee_ID = $row['Employee_ID'];
                $Objects[$x]->Start_Working_Date = $row['Start_Working_Date'];
                $x++;
            }
            return $Objects;
        }
        else{
            return NULL;
        }
    }

    public function SelectDepDr($DepID){
        $DB = DB::getInstance();
        $sql  = "SELECT * FROM doctor WHERE Employee_ID IN (SELECT id FROM employee WHERE dep_id = '".$DepID."')";
        $Result = $DB->execute($sql);
        if ($Result->num_rows>0){
            $Object = array();
            $x = 0;
            while ($row = mysqli_fetch_array($Result)){

                    $Object[$x] = new self();
                    $Object[$x]->ID = $row['ID'];
                    $Object[$x]->Employee_ID = $row['Employee_ID'];
                    $x++;
                }
            return $Object;
        }
        else{
            return NULL;
        }

    }

    public function getDrName (){
        $DB = DB::getInstance();
        $sql = "SELECT FirstName , LastName FROM user WHERE ID = (SELECT user_id FROM employee WHERE id = (SELECT Employee_ID FROM doctor WHERE ID = '".$this->ID."'))";
        $Result = $DB->execute($sql);
        $row = mysqli_fetch_array($Result);
        return $row['FirstName']." ".$row['LastName'];
    }

    public function getDrID($UserID){
        $sql = "SELECT ID FROM doctor WHERE Employee_ID IN (SELECT id FROM employee WHERE user_id = ".$UserID.")";
        $DB = DB::getInstance();
        $Result = $DB->execute($sql);

        $row = mysqli_fetch_array($Result);
        return $row['ID'];

    }

    public function GetDrDep ($ID){
        $DB = DB::getInstance();
        $sql = "SELECT dep_id FROM employee WHERE id = (SELECT Employee_ID FROM doctor WHERE ID = '".$ID."')";
        $Result = $DB->execute($sql);
        $row = mysqli_fetch_array($Result);
        return $row['dep_id'];
    }
}
?>