<?php
require_once ("..\Model\AddressModel.php");
class AddressController{
    public function AddUserAddress($ParentID){
        $AddressObject = new AddressModel();
        $AddressObject->Parent_ID = $ParentID;
        $Result = $AddressObject->SelectParentID();
        return $Result;
    }
    public function SelectAddress($Address_ID){
        $AddressObject = new AddressModel();
        $AddressObject->ID = $Address_ID;
        $Result = $AddressObject->Select();
        return $Result;
    }
}

?>