<?php
require_once ("..\Public\Interfaces\CRUDInterface.php");
require_once ("..\Public\Database\DBConnect.php");
class UserTypeModel implements CRUD {
    public $ID;
    public $Type;
    public function Insert()
    {
        $DB = DB::getInstance();
        $sql = "INSERT INTO `usertype`(`Type`) VALUES ('".$this->Type."')";
        $DB->execute($sql);
    }

    public function Delete()
    {
        $DB = DB::getInstance();
        $sql = "DELETE FROM `usertype` WHERE ID = '".$this->ID."'";
        $DB->execute($sql);
    }

    public function Modify()
    {

    }

    public function Select()
    {
        $DB = DB::getInstance();
        $sql = "SELECT * FROM usertype";
        $result = $DB->execute($sql);
        if ($result->num_rows>0){
            $Objects = array();
            $x = 0;
            while ($row = mysqli_fetch_array($result)){
                $Objects[$x] = new UserTypeModel();
                $Objects[$x]->ID = $row['ID'];
                $Objects[$x]->Type = $row['Type'];
                $x++;
            }
            return $Objects;
        }
        else{
            return NULL;
        }
    }

    public function Check(){
        $DB = DB::getInstance();
        $sql = "SELECT * FROM usertype WHERE Type LIKE '%".$this->Type."%'";
        $Result = $DB->execute($sql);
        if ($Result->num_rows>0){
            return $Result;
        }
        else{
            return NULL;
        }
    }
}
?>