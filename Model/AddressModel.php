<?php
require_once ("..\Public\Interfaces\CRUDInterface.php");
require_once ("..\Public\Database\DBConnect.php");
class AddressModel implements CRUD{
    public $ID;
    public $Name;
    public $Parent_ID;

    public function Insert()
    {
        $DB = DB::getInstance();
        $sql = "INSERT INTO `address`(Name,Parent_ID) VALUES ('".$this->Name."','".$this->Parent_ID."')";
        $DB->execute($sql);


    }

    public function Delete()
    {
        $DB = DB::getInstance();
        $sql = "DELETE FROM `address` WHERE ID = '".$this->ID."'";
        $DB->execute($sql);
    }

    public function Modify()
    {

    }

    public function Select()
    {
        $DB = DB::getInstance();
        $sql = "SELECT * FROM `address` WHERE ID = '".$this->ID."'";
        $result = $DB->execute($sql);
        $row = mysqli_fetch_array($result);
        $Object = new AddressModel();
        $Object->ID = $row['ID'];
        $Object->Name = $row['Name'];
        $Object->Parent_ID = $row['Parent_ID'];
        return $Object;
    }
    public function SelectParentID(){
        $DB = DB::getInstance();
        $sql = "SELECT * FROM `address` WHERE Parent_ID = '".$this->Parent_ID."'";
        $result = $DB->execute($sql);
        if ($result->num_rows>0){
            $Object = array();

            $x=0;
            while ($row = mysqli_fetch_array($result)){
                $Object[$x] = new self();
                $Object[$x]->ID = $row['ID'];
                $Object[$x]->Name = $row['Name'];
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