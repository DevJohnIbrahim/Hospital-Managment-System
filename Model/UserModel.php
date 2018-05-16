<?php
require_once ("..\Public\Interfaces\CRUDInterface.php");
require_once ("..\Public\Database\DBConnect.php");

class User implements CRUD{
    public $ID;
    public $FirstName;
    public $MiddleName;
    public $LastName;
    public $Address_ID;
    public $UserType_ID;
    public $Gender;
    public $SocialSecuirityNumber;
    public $DateOfBirith;
    public $LoginStatus;
    public $Dep_Number;
    public function Insert()
    {
        $DB = DB::getInstance();
        $sql = "INSERT INTO `user`(FirstName,MiddleName,LastName,Address_ID,UserType_ID,Gender,SocialSecuirityNumber,DateOfBirith,LoginStatus) VALUES 
                ('".$this->FirstName."','".$this->MiddleName."','".$this->LastName."','".$this->Address_ID."','".$this->UserType_ID."','".$this->Gender."','".$this->SocialSecuirityNumber."','".$this->DateOfBirith."','".$this->LoginStatus."')";
        $DB->execute($sql);
        $patient_id=mysqli_insert_id($DB->con);
        echo $patient_id;
        $sql="INSERT INTO latepayments (patient_id,value) VALUES (".$patient_id.",0)";
        $DB->execute($sql);
        return $patient_id;
    }
    public function Delete()
    {
        $DB = DB::getInstance();
        $sql = "DELETE FROM user WHERE ID = '".$this->ID."'";
        $DB->execute($sql);

    }
    public function Modify()
    {
        $DB = DB::getInstance();
        $sql = "UPDATE `user` SET `FirstName`='".$this->FirstName."',`MiddleName`='".$this->MiddleName."',`LastName`='".$this->LastName."',`Address_ID`='".$this->Address_ID."',`UserType_ID`='".$this->UserType_ID."',`Gender`='".$this->Gender."',`SocialSecuirityNumber`='".$this->SocialSecuirityNumber."',`DateOfBirith`='".$this->DateOfBirith."',`LoginStatus`='".$this->LoginStatus."' , Dep_ID = '".$this->Dep_Number."' WHERE ID = '".$this->ID."'";
        $DB->execute($sql);
    }
    public function Select()
    {
        $DB = DB::getInstance();
        $sql = "SELECT * FROM user WHERE ID = '".$this->ID."'";
        $result = $DB->execute($sql);
        if ($result->num_rows>0) {
            $Object = new User();
            $row = mysqli_fetch_array($result);
            $Object->ID = $row['ID'];
            $Object->FirstName = $row['FirstName'];
            $Object->MiddleName = $row['MiddleName'];
            $Object->LastName = $row['LastName'];
            $Object->Address_ID = $row['Address_ID'];
            $Object->UserType_ID = $row['UserType_ID'];
            $Object->Gender = $row['Gender'];
            $Object->SocialSecuirityNumber = $row['SocialSecuirityNumber'];
            $Object->DateOfBirith = $row['DateOfBirith'];
            $Object->LoginStatus = $row['LoginStatus'];
            $Object->Dep_Number = $row['Dep_ID'];
            return $Object;
        }
        else{
            return NULL;
        }
    }

    public function Check(){
       $DB = DB::getInstance();
       $sql = "SELECT * FROM user WHERE SocialSecuirityNumber = '".$this->SocialSecuirityNumber."'";
       $Result = $DB->execute($sql);
       if ($Result->num_rows>0){
           return $Result;
       }
       else{
           return NULL;
       }

    }

    public function getName($ID){
        $DB = DB::getInstance();
        $sql = "SELECT FirstName , LastName FROM user WHERE ID = (SELECT user_id FROM employee WHERE ID = '".$ID."')";
        $Result = $DB->execute($sql);
        $row = mysqli_fetch_array($Result);
        $Name = $row['FirstName']." ".$row['LastName'];
        return $Name;
    }
    public function getPatientName ($ID){
        $DB = DB::getInstance();
        $sql = "SELECT FirstName , LastName FROM user WHERE ID = '".$ID."'";
        $Result = $DB->execute($sql);
        $row = mysqli_fetch_array($Result);
        $Name = $row['FirstName']." ".$row['LastName'];
        return $Name;
    }

    public function getDoctorName($ID){
        $DB = DB::getInstance();
        $sql = "SELECT FirstName, LastName FROM user WHERE ID = (SELECT user_id FROM employee WHERE ID = (SELECT Employee_ID FROM doctor WHERE ID = '".$ID."'))";
        $Result = $DB->execute($sql);
        $row = mysqli_fetch_array($Result);
        $Name = $row['FirstName']." ".$row['LastName'];
        return $Name;
    }
}
?>