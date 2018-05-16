<?php
require_once ("../Public/Database/DBConnect.php");
require_once ("../Public/Interfaces/CRUDInterface.php");

class AnalysisModel implements CRUD{
    public $ID;
    public $Name;
    public $Value;
    public $Counter;
    public function Insert()
    {
       $DB = DB::getInstance();
       $sql = "INSERT INTO `analysis`(`Name`, `Value`, `Counter`) VALUES
                ('".$this->Name."','".$this->Value."',0)";
       $DB->execute($sql);
    }

    public function Delete()
    {
       $DB = DB::getInstance();
       $sql = "DELETE FROM analysis WHERE ID = '".$this->ID."'";
       $DB->execute($sql);
    }

    public function Modify()
    {
        $sql = "UPDATE `analysis` SET `Name`='".$this->Name."',`Value`='".$this->Value."',`Counter`='".$this->Counter."' WHERE ID = '".$this->ID."'";
        $DB = DB::getInstance();
        $DB->execute($sql);
    }

    public function Select()
    {
        $sql = "SELECT * FROM analysis WHERE ID = '".$this->ID."'";
        $DB = DB::getInstance();
        $Result = $DB->execute($sql);
        if ($Result->num_rows>0){
            $row = mysqli_fetch_array($Result);
            $Object = new self();
            $Object->ID = $row['ID'];
            $Object->Counter = $row['Counter'];
            $Object->Value = $row['Value'];
            $Object->Name = $row['Name'];
            return $Object;
        }
        else{
            return NULL;
        }
    }

    public function SelectAll(){
        $sql = "SELECT * FROM analysis";
        $DB = DB::getInstance();
        $Result = $DB->execute($sql);
        if ($Result->num_rows>0){
            $Objects = array();
            $x = 0;
            while ($row = mysqli_fetch_array($Result)){
                $Objects[$x] = new self();
                $Objects[$x]->Name = $row['Name'];
                $Objects[$x]->ID = $row['ID'];
                $x++;
            }
        }
        else{
            return NULL;
        }
    }
}
?>