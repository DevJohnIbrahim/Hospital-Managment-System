<?php
require_once ("TimelSlotsModel.php");
require_once ("UserController.php");
require_once ("DoctorController.php");
$cond="";
$err="";
$user = new UserController();
$emp = new DoctorController();
$SC = new TimeslotsController();



class TimeslotsController{

    public static function AddTS(){
        $SC=new TimeSlots();
        $SC->Doctor_ID=$_POST["Doctor_ID"];
        $SC->From=$_POST["From"];
        $SC->To=$_POST["To"];
        $SC->Day=$_POST["Day"];
        $SC->Day=$_POST["MaxCapacity"];
        $SC->Insert();
    }

    public static function DeleteTS(){

      $SC1=new TimeSlots();
      $SC1->ID=$_POST["ID"];
      $SC1->Delete();
    }

    public static function ViewSC($Doctor_ID){
      $SC=new Timeslots();
      $SC->Doctor_ID=$Doctor_ID;
      $result = $SC->Select();
      return $result;
    }

    public static function EditSC(){


    }

}
if (isset($_POST['AddSC'])){
    TimeslotsController::AddTS();
}
else if (isset($_POST['DeleteTS'])){
    TimeslotsController::DeleteTS();
}

?>
