<?php
require_once ("..\Public\Interfaces\CRUDInterface.php");
require_once ("..\Public\Database\DBConnect.php");
class RegisteredModel implements CRUD{
    public $ID;
    public $User_ID;
    public $UserName;
    public $Pasword;

    public function Insert()
    {
        $DB = DB::getInstance();
        $this->Pasword = sha1($this->Pasword);
        $sql = "INSERT INTO `register`(`User_ID`, `UserName`, `Password`) VALUES ('".$this->User_ID."','".$this->UserName."','".$this->Pasword."')";
        $DB->execute($sql);
    }

    public function Delete()
    {
        $DB = DB::getInstance();
        $sql = "DELETE FROM `register` WHERE User_ID = '".$this->User_ID."'";
        $DB->execute($sql);
    }

    public function Modify()
    {
       $DB = DB::getInstance();
       $sql = "UPDATE `register` SET `UserName`='".$this->UserName."',`Password`='".$this->Pasword."' WHERE User_ID = '".$this->User_ID."'";
       $DB->execute($sql);
    }

    public function Select()
    {
        $DB = DB::getInstance();
        $sql = "SELECT * FROM `register` WHERE User_ID = '".$this->User_ID."'";
        $result = $DB->execute($sql);

        if ($result->num_rows>0){
            $row = mysqli_fetch_array($result);
            $Object = new self();
            $Object->ID = $row['ID'];
            $Object->User_ID = $row['User_ID'];
            $Object->UserName = $row['UserName'];
            $Object->Password = $row['Password'];
            return $Object;
        }
        else{
            return NULL;
        }
    }

    public function Login(){
        $DB = DB::getInstance();
        $this->Pasword = sha1($this->Pasword);
        $sql = "SELECT * FROM `register` WHERE UserName = '".$this->UserName."'AND Password = '".$this->Pasword."'";
        $result = $DB->execute($sql);
        if ($result->num_rows>0){
            $row = mysqli_fetch_array($result);
            return $row['User_ID'];
        }
        else{
            return NULL;
        }
    }
}
?>