<?php
require_once ("../Public/Database/DBConnect.php");
require_once ("../Public/Interfaces/CRUDInterface.php");

class EquipmentModel implements CRUD{
    public $ID;
    public $Name;
    public $Price;
    public $Counter;
    public function Insert()
    {
        $DB = DB::getInstance();
        $sql = "INSERT INTO `equipment`(`Name` , Price , Counter) VALUES ('".$this->Name."' , '".$this->Price."', '".$this->Counter."')";
        $DB->execute($sql);
    }

    public function Delete()
    {
        $DB = DB::getInstance();
        $sql = "DELETE FROM equipment WHERE ID = '".$this->ID."'";
        $DB->execute($sql);
    }

    public function Modify()
    {
       $sql = "UPDATE `equipment` SET `Name`='".$this->Name."',`Price`='".$this->Price."',`Counter`='".$this->Counter."' WHERE ID = '".$this->ID."'";
       $DB = DB::getInstance();
       $DB->execute($sql);
    }

    public function SelectModify(){
        $sql = "SELECT * FROM equipment WHERE ID = '".$this->ID."'";
        $DB = DB::getInstance();
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
        $sql = "SELECT * FROM equipment";
        $Result = $DB->execute($sql);
        if ($Result->num_rows>0){
            $Objects = array();
            $x=0;
            while ($row = mysqli_fetch_array($Result)){
                $Objects[$x] = new self();
                $Objects[$x]->Name = $row['Name'];
                $Objects[$x]->ID = $row['ID'];
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
        $sql = "SELECT Price FROM equipment WHERE Name = '".$this->Name."'";
        $Result = $DB->execute($sql);
        $Row = mysqli_fetch_array($Result);
        return $Row['Price'];
    }
}
?>