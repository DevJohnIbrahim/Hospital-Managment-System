<?php
require_once ("../Model/MedicationModel.php");

class MedicationController{
    public function getAllMedications(){
        $Result = MedicationModel::Select();
        return $Result;
    }

    public function GetName($ID){
        $MedicationmodelObjects = new MedicationModel();
        $MedicationmodelObjects->ID = $ID;
        $Result = $MedicationmodelObjects->SelectModify();
        return $Result->Name;
    }
    public function GetPrice($ID){
        $MedicationmodelObjects = new MedicationModel();
        $MedicationmodelObjects->ID = $ID;
        $Result = $MedicationmodelObjects->SelectModify();
        return $Result->Price;
    }
}
?>