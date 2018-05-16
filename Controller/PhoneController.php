<?php
require_once ("..\Model\PhoneModel.php");
class PhoneController{
    public function AddPhone($User_ID , $Phone){
        $PhoneObject = new PhoneModel();
        $PhoneObject->Phone = $Phone;
        $PhoneObject->User_ID = $User_ID;
        $PhoneObject->Insert();
    }
    public function getPhones ($User_ID){
        $PhoneObject = new PhoneModel();
        $PhoneObject->User_ID = $User_ID;
        $Result = $PhoneObject->Select();
        return $Result;
    }
}
?>