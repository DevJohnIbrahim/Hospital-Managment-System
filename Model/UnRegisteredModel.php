<?php
require_once ("..\Public\Interfaces\CRUDInterface.php");
require_once ("..\Public\Database\DBConnect.php");

class UnRegisteredModel implements CRUD {
    public $ID;
    public $User_ID;
    public $Number;

    public function Insert()
    {   self::GenerateNumber();
        $DB = DB::getInstance();
        $sql = "INSERT INTO `unregister`(`User_ID`, `Number`) VALUES ('".$this->User_ID."','".$this->Number."')";
        $DB->execute($sql);
        return $this->Number;
    }

    public function Delete()
    {
        $DB = DB::getInstance();
        $sql= "DELETE FROM `unregister` WHERE Number = '".$this->Number."'";
        $DB->execute($sql);
    }

    public function Modify()
    {
        // TODO: Implement Modify() method.
    }

    public function Select()
    {
        $DB = DB::getInstance();
        $sql = "SELECT * FROM `unregister` WHERE Number = '".$this->Number."'";
        $result = $DB->execute($sql);
        if ($result->num_rows>0){
            $row = mysqli_fetch_array($result);
            return $row['User_ID'];
        }
        else{
            return NULL;
        }

    }

    public function SelectUser_ID(){
        $DB = DB::getInstance();
        $sql = "SELECT * FROM `unregister` WHERE User_ID = '".$this->User_ID."'";
        $result = $DB->execute($sql);
        if ($result->num_rows>0){
            $row = mysqli_fetch_array($result);
            return $row['Number'];
        }
        else{
            return NULL;
        }
    }

    public function GenerateNumber(){
        $this->Number = rand(1000000,1000000000);
    }
}
?>