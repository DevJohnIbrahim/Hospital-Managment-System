<?php
require_once ("../Model/PaymentMethodModel.php");
class PaymentMethodController{

    public static function getAllPayment(){
        $PaymentModel = new PaymentMethodModel();
        return $PaymentModel->Select();
    }
}
?>
