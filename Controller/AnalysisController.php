<?php
require_once ("../Model/AnalysisModel.php");

class AnalysisController{
    public function GetAll(){
        $AnalysisModelObject = new AnalysisModel();
        $Result = $AnalysisModelObject->SelectAll();
        return $Result;
    }
    public function GetName ($ID){
        $AnalysisModelObject= new AnalysisModel();
        $AnalysisModelObject->ID = $ID;
        $Result = $AnalysisModelObject->Select();
        return $Result->Name;
    }
    public function GetPrice($ID){
        $AnalysisModelObject= new AnalysisModel();
        $AnalysisModelObject->ID = $ID;
        $Result = $AnalysisModelObject->Select();
        return $Result->Price;
    }
}
?>