<?php
require_once ("..\Model\EmployeeModel.php");
if (isset($_POST['AddEmployee'])){
    EmployeeController::AddEmployee();
}
elseif (isset($_POST['DeleteEmployee'])){
    EmployeeController::DeleteEmployee();
}
elseif (isset($_POST['EditEmployee'])){
    EmployeeController::EditEmployee();
}


class EmployeeController{

    public static function AddEmployee(){

    }

    public static function DeleteEmployee(){

    }

    public static function ViewEmployee($id){
      $emp=new EmployeeModel();
      $emp->ID=$id;
      $result = $emp->SelectEmpInfo();
      return $result;
    }
    public static function ViewEmployee_dep($dep_id){
      $emp=new EmployeeModel();
      $emp->dep_id=$dep_id;
      $result = $emp->Select_dep();
      return $result;
    }

}
?>
