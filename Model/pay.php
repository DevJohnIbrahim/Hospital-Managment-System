<?php
// Decorative Design Pattern
interface Pay {
	public function GetPayment();
}

abstract class PayDecorator implements Pay {
   abstract public function GetPayment();
}

class payment implements  Pay {
  private $Price;
  private $Paient_id;
  public function __construct($Price,$Patient_id) {
    $this->Price=$Price;
    $this->Paient_id=$Patient_id;
  }
  public function GetPayment(){
     return $this->Price;
  }
  public function GetPatientID(){
     return $this->Paient_id;
  }

}


class Discount extends  PayDecorator {
  public $pay;
  public $disc;
  public function __construct(Pay $pay) {
    $this->pay=$pay;
    $this->disc=0;
  }
  public function SetDiscount($disc){
    $this->disc=$disc;
  }
  public function GetPayment(){
  return  $this->pay->GetPayment()-($this->pay->GetPayment()*$this->disc/100);
  }

}

class LatePayments extends  PayDecorator {
  public $pay;
  public function __construct(Pay $pay) {
  $this->pay=$pay;
  }
  public function GetPayment(){
   $sql="SELECT value FROM latepayments where patient_id=".$this->pay->GetPatientID();
   $DB = DB::getInstance();
   $Result = $DB->execute($sql);
   $row=mysqli_fetch_array($Result);
   return  $this->pay->GetPayment()+$row["value"];
  }
  public function SetLatePayment($value){
   $sql="UPDATE latepayments SET value='".$value."' where patient_id=".$this->pay->GetPatientID();
   $DB = DB::getInstance();
   $Result = $DB->execute($sql);
  }

}


 ?>
