<?php
require_once ("../Model/BillModel.php");
require_once ("../View/PayView.php");
require_once ("../Model/PendingPaymentModel.php");
require_once ("../Model/AppointmentModel.php");
require_once ("../Public/External Libraries/FPDF/fpdf.php");


class BillController{
    public static function AddNewBill($pay,$pay2,$method,$paid_money,$Result,$Result2,$AppointmentModel,$PendingPaymentModel){
        $PaymentMethodID = $method;
        $BillModel = new BillModel();
        $BillModel->price = $paid_money;
        $BillModel->discount = $pay2->disc;
        $BillModel->total = $pay2->GetPayment();
        $AfterDiscount =$pay2->GetPayment();
        $pay->SetLatePayment($pay->GetPayment()-$pay2->GetPayment());
        $BillModel->payment_method_id = $PaymentMethodID;
        $BillModel->patient_id = $Result2->Patient;
        $BillModel->Doctor_ID = $Result2->Doctor;
        $BillModel->Insert();

        $PDF = new FPDF();
        $PDF->AddPage();
        $PDF->SetFont('Arial','',15);
        $PDF->Cell(40,10,"Invoice");
        $PDF->Ln();
        $PDF->Cell(40,10,'Total Price :'.$Result->TotalPrice);
        $PDF->Ln();
        $PDF->Cell(40,10,'Paid Money :'.$paid_money);
        $PDF->Ln();
        $PDF->Cell(40,10,"After Discount : ".$pay2->GetPayment());
        $PDF->Ln();
        $Rand = rand();
        $FileName = $Result2->Patient.$Result2->Doctor.$Rand.".pdf";
        $dir = "../Bills/";
        $PDF->Output($dir.$FileName,'F');
        $PendingPaymentModel->Delete();
        $AppointmentModel->Delete();
        // header("Location:../View/NurseScreen.php");
    }
}
?>
