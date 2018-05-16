<?php
require_once ("../Model/PendingPaymentModel.php");

class PendingPaymentController{
    public function getAllPending($ID){
        $PendingPaymentObject = new PendingPaymentModel();
        $Result = $PendingPaymentObject->GetAllPending($ID);
        return $Result;
    }

    public function GetPatientName($ID){
        $PendingPaymentModel = new PendingPaymentModel();
        return $PendingPaymentModel->getPatientName($ID);
    }
}
?>