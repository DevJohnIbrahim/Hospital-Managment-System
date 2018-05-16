<?php
require_once ("../Model/BillModel.php");

class DashboardController{
    public function getChartdata(){
        $BillModel = new BillModel();
        $Result = $BillModel->Select();
        $FinalArray = $BillModel->Classifying($Result);
        return array($FinalArray);

    }
}
?>