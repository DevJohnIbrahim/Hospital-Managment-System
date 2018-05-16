<?php
require_once ("..\Public\Interfaces\CRUDInterface.php");
require_once ("..\Public\Database\DBConnect.php");

class PhoneModel implements CRUD {
    public $ID;
    public $Phone;
    public $User_ID;

    public function Insert()
    {
       $DB = DB::getInstance();
       $sql = "INSERT INTO `phone`(Phone,User_ID) VALUES ('".$this->Phone."','".$this->User_ID."')";
       return $DB->execute($sql);
    }

    public function Delete()
    {
        // TODO: Implement Delete() method.
    }

    public function Modify()
    {
        // TODO: Implement Modify() method.
    }

    public function Select()
    {
        $DB = DB::getInstance();
        $sql = "SELECT * FROM `phone` WHERE User_ID = '".$this->User_ID."'";
        $result = $DB->execute($sql);
        if ($result->num_rows>0){
            $Objects = array();
            $x=0;
            while ($row = mysqli_fetch_array($result)){
                $Objects[$x] = new self();
                $Objects[$x]->ID = $row['ID'];
                $Objects[$x]->User_ID = $row['User_ID'];
                $Objects[$x]->Phone = $row['Phone'];
                $x++;
            }
            return $Objects;
        }else{
            return NULL;
        }
    }
}

?>