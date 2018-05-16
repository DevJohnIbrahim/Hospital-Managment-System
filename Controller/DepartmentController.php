<?php
require_once ("..\Model\DepartmentModel.php");

if (isset($_POST['AddDepartment'])){
    DepartmentController::AddDepartment();
}
elseif (isset($_POST['DeleteDepartment'])){
    DepartmentController::DeleteDepartment();
}
elseif (isset($_POST['EditDepartment'])){
    DepartmentController::EditDepartment();
}


class DepartmentController{
    public static function AddDepartment (){

    }
    public static function DeleteDepartment (){

    }
    public static function EditDepartment (){

    }
    public static function getAllDep (){
        $Objects = DepartmentModel::SelectAll();
        return $Objects;
    }
}
?>
