<?php
require_once ("..\Public\Interfaces\CRUDInterface.php");
require_once ("..\Public\Database\DBConnect.php");

class MedicationModel implements CRUD{
    public $Name;
    public $ID;
    public $Price;
    public $Counter;
    public function Insert()
    {
        $DB = DB::getInstance();
        $sql = "INSERT INTO `medication`(`Name` , Price , Counter) VALUES ('".$this->Name."' , '".$this->Price."','".$this->Counter."')";
        $DB->execute($sql);
    }

    public function Delete()
    {
        $DB = DB::getInstance();
        $sql = "DELETE FROM medication WHERE ID = '".$this->ID."'";
        $DB->execute($sql);
    }

    public function Modify()
    {
        $DB = DB::getInstance();
        $sql = "UPDATE `medication` SET `Name`='".$this->Name."',`Price`='".$this->Price."',`Counter`='".$this->Counter."' WHERE ID = '".$this->ID."'";
        $DB->execute($sql);
    }
    public function SelectModify(){
        $DB = DB::getInstance();
        $sql = "SELECT * FROM medication WHERE ID = '".$this->ID."'";
        $Result = $DB->execute($sql);
        if ($Result->num_rows>0){
            $row = mysqli_fetch_array($Result);
            $Object = new self();
            $Object->ID = $row['ID'];
            $Object->Counter = $row['Counter'];
            $Object->Price = $row['Price'];
            $Object->Name = $row['Name'];
            return $Object;
        }
        else{
            return NULL;
        }
    }

    public function Select()
    {
        $DB = DB::getInstance();
        $sql = "SELECT * FROM medication";
        $Result = $DB->execute($sql);
        if ($Result->num_rows>0){
            $Objects = array();
            $x=0;
            while ($row = mysqli_fetch_array($Result)){
                $Objects[$x] = new self();
                $Objects[$x]->ID = $row['ID'];
                $Objects[$x]->Name = $row['Name'];
                $Objects[$x]->Counter = $row['Counter'];
                $x++;
            }
            return $Objects;
        }
        else{
            return NULL;
        }
    }

    public function SelectPrice(){
        $DB = DB::getInstance();
        $sql = "SELECT Price FROM medication WHERE Name = '".$this->Name."'";
        $Result = $DB->execute($sql);
        $Row = mysqli_fetch_array($Result);
        return $Row['Price'];
    }
}
?>