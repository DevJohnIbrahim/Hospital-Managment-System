<?php
require_once ("../Model/pay.php");
require_once ("../Controller/PaymentMethodController.php");
require_once ("../Model/PaymentMethodModel.php");
require_once ("../Model/AppointmentModel.php");
require_once ("../Model/UserModel.php");
require_once ("../Controller/BillController.php");
if(!isset($_GET['ID'])){
  // header("Location:../View/NurseScreen.php");
}
$PaymentMethods = PaymentMethodController::getAllPayment();
$PendingPaymentModel = new PendingPaymentModel();
$PendingPaymentModel->ID=$_GET['ID'];
$Result = $PendingPaymentModel->SelectAppointment();
/////////////////////////////////////////////////////////////////////////
$PaymentMethods = PaymentMethodController::getAllPayment();
/////////////////////////////////////////////////////////////////////////////
$AppointmentModel = new AppointmentModel();
$AppointmentModel->ID = $Result->Appointment_ID;
$Result2 = $AppointmentModel->Select();
////////////////////////////////////////////////////////////////////////////////
?>
<html>
<head><title>Payment</title></head>

<body>
  <br><br>Patient Name: <?php
    $user=new User();
    $user->ID=$Result2->Patient;
    $result3=$user->select();
    echo $result3->FirstName." ".$result3->LastName;

    ?>
  <br><br>Service Cost: <?php
  $pay=new payment($Result->TotalPrice,$Result2->Patient);
  $SC=$pay->GetPayment();
  echo $SC;
    ?>

  <br><br>Service Cost + LatePayments:
  <?php
   $pay=new LatePayments($pay);
   $SCPLP=$pay->GetPayment();
   echo $SCPLP;
    ?>

<form action = "PayView.php?ID=<?php echo $_GET['ID']; ?>" method="post">
    Please Enter the amount the patient will pay: <input type="number" name="paid_money" value=""><br><br>
    Payment Method :
    <?php
    for ($x=0;$x<count($PaymentMethods);$x++){
        echo $PaymentMethods[$x]->name.'<input type ="radio"  value="'.$PaymentMethods[$x]->id.'" name ="Ptype">';
            }
    ?>
    <br><br>
    Discount : <input type = "number" name = "discount" value="0" placeholder="eg.20%" required><br>
    <input type = "submit" name = "Pay" value="Pay">
</form>
</body>
</html>
<?php
if (isset($_POST['Pay'])){

  $pay2=new payment($_POST['paid_money'],$Result2->Patient);
  $pay2=new Discount($pay2);
  $pay2->SetDiscount($_POST['discount']);

  BillController::AddNewBill($pay,$pay2,$_POST['Ptype'],$_POST['paid_money'],$Result,$Result2,$AppointmentModel,$PendingPaymentModel);
}
?>
