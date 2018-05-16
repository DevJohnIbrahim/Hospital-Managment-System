<?php
session_start();
require_once("..\Model\WaitingModel.php");
require_once("..\Model\EmployeeModel.php");

$cond="false";
$err="";
$todelete="";
$Doctor_id=$_SESSION["User_ID"];

$dep=new EmployeeModel();
$dep->ID=$Doctor_id;
$result=$dep->SelectDepartment();
$rows=mysqli_fetch_array($result);
$dep_id=$rows[0];


$wait = new Waiting();
$wait->dep_id=$dep_id;
$result2=$wait->Select();
$num_rows = mysqli_num_rows($result2);

if($num_rows!=0){
    $cond="true";
}
else{
    $err="no waiting list";
}


if (isset($_POST['AddWaiting'])){
    WaitingController::AddWaiting();
}
elseif (isset($_POST['todelete'])){
    WaitingController::DeleteWaiting();
}
elseif (isset($_POST['Editwaiting'])){
    WaitingController::EditWaiting();
}


class WaitingController{

    public static function AddWaiting(){


    }

    public static function DeleteWaiting(){
        $wait = new Waiting();
        $wait->ID= $_SESSION["todelete1"];
        $wait->Delete();
        header("Location: doctor_screen.php");
    }

    public static function ViewWaiting (){

    }

    public static function EditWaiting(){


    }

}
?>
