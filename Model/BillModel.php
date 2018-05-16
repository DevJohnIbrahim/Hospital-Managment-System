<?php
require_once ("../Public/Database/DBConnect.php");
require_once ("../Public/Interfaces/CRUDInterface.php");
require_once ("DoctorModel.php");
class BillModel implements CRUD {
   public $id;
   public $patient_id;
   public $Doctor_ID;
   public $payment_method_id;
   public $price;
   public $discount;
   public $total;
   public $DateAndTime;

    public function Insert()
    {
        $DB = DB::getInstance();
        $sql = "INSERT INTO `bill`(`patient_id`, `Doctor_ID`, `payment_method_id`, `price`, `discount`, `total`) VALUES
                ('".$this->patient_id."','".$this->Doctor_ID."','".$this->payment_method_id."','".$this->price."','".$this->discount."','".$this->total."')";
        $DB->execute($sql);
        echo $sql;
    }

    public function Delete()
    {
        $DB = DB::getInstance();
        $sql = "DELETE FROM `bill` WHERE id = '".$this->id."'";
        $DB->execute($sql);
    }

    public function Modify()
    {
        // TODO: Implement Modify() method.
    }

    public function Select()
    {
       $DB = DB::getInstance();
       $sql = "SELECT total , Doctor_ID FROM `bill` WHERE DATE(bill.DateAndTime) = CURDATE()";
       $Result = $DB->execute($sql);
       if ($Result->num_rows>0){
           $Objects = array();
           $x=0;
           while ($row = mysqli_fetch_array($Result)){
               $Objects[$x] = new self();
               $Objects[$x]->total = $row['total'];
               $Objects[$x]->Doctor_ID = $row['Doctor_ID'];
               $x++;
           }
           return $Objects;
       }
       else{
           return NULL;
       }
    }

    public function Classifying($Objects){
        $DB  = DB::getInstance();
        $sql = "SELECT name , id FROM department";
        $Result = $DB->execute($sql);
        $DepartmentsNames = array();
        $DepartmentsID = array();
        $x=0;
        while ($row = mysqli_fetch_array($Result)){
            $DepartmentsNames[$x] = $row['name'];
            $DepartmentsID[$x] = $row['id'];
            $x++;
        }
        $DoctorModel = new DoctorModel();
        $TotalBills = array();
        for ($x=0;$x<count($Objects);$x++){
            $DepID = $DoctorModel->GetDrDep($Objects[$x]->Doctor_ID);
            for ($y=0;$y<count($DepartmentsID);$y++){
                    if (! isset($TotalBills[$y])){
                        $TotalBills[$y] = 0;
                    }
                if ($DepID == $DepartmentsID[$y]){
                    $TotalBills[$y] = $TotalBills[$y]+$Objects[$x]->total;
                }
                else{
                    continue;
                }
            }
        }
           $FinalArray = array();
        for ($x=0;$x<count($DepartmentsID);$x++){
            if (! isset($FinalArray)){
                $FinalArray = 0;
            }
            $FinalArray = array($DepartmentsNames[$x],$TotalBills[$x]);
        }
        return $FinalArray;

    }


}
?>
