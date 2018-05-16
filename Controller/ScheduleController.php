<?php
require_once ("..\Model\ScheduleModel.php");
require_once ("..\Controller\DepartmentController.php");
require_once ("..\Controller\UserController.php");
require_once ("..\Controller\EmployeeController.php");
$cond="";
$err="";
$err1="";
$dep_id;
$dep=new DepartmentController();
$user = new UserController();
$SC = new scheduleController();

if(isset($_POST['searchdep'])) {
    if ($_POST["dep"] != -1) {
        $result1 = EmployeeController::ViewEmployee_dep($_POST["dep"]);
         $dep_id=$_POST["dep"];
        $num_rows = mysqli_num_rows($result1);
        if ($num_rows != 0) {
            $cond = "true";
        } else {
            $err = "no employee";
        }
    } else {
        $err = "Choose Department";
    }
}
if(isset($_POST['searchSC'])) {
    if ($_POST["dep"] != -1) {
        $result3 = scheduleController::ViewSC($_POST["dep"]);
        $num_rows = mysqli_num_rows($result3);
        if ($num_rows != 0) {
            $cond = "true";
        } else {
            $err = "no SC";
        }
    } else {
        $err = "Choose Department";
    }
}
class scheduleController{

    public static function AddSC(){
        $SC=new schedule();
        $SC->employee_id=$_POST["employee_id"];
        $SC->dep_id=$_POST["dep_id"];
        $SC->day=$_POST["day"];
        $SC->time_from=$_POST["from"];
        $SC->time_to=$_POST["to"];
        $SC->Insert();
    }

    public static function DeleteSC(){

      $SC1=new schedule();
      $SC1->ID=$_POST["SC_id"];
      $SC1->Delete();
    }

    public static function ViewSC($dep_id){
      $SC=new schedule();
      $SC->dep_id=$dep_id;
      $result = $SC->Select();
      return $result;
    }

    public static function EditSC(){


    }

}
if (isset($_POST['AddSC'])){
  if($_POST["employee_id"]==="-1"){
      $err1="Choose employee";
  }
  else{

    scheduleController::AddSC();
  }
}
else if (isset($_POST['DeleteSC'])){
    scheduleController::DeleteSC();
}

?>
