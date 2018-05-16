<?php
require_once ("../Model/EquipmentModel.php");

class EquipmentController{
    public function GetAllEq(){
        $Result = EquipmentModel::Select();
        return $Result;
    }

    public function GetName($ID){
        $EquipmentmodelObject = new EquipmentModel();
        $EquipmentmodelObject->ID = $ID;
        $Result = $EquipmentmodelObject->SelectModify();
        return $Result->Name;
    }
    public function GetPrice($ID){
        $EquipmentmodelObject = new EquipmentModel();
        $EquipmentmodelObject->ID = $ID;
        $Result = $EquipmentmodelObject->SelectModify();
        return $Result->Price;
    }
}
?>