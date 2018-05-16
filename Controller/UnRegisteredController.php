<?php
require_once ("..\Model\UnRegisteredModel.php");
require_once ("RegisteredController.php");

if (isset($_POST['Register'])){
    UnRegisteredController::Register();
}
class UnRegisteredController{
    public function AddRecord($User_ID){
        $Object = new UnRegisteredModel();
        $Object->User_ID = $User_ID;
        $Number = $Object->Insert();
        return $Number;
    }

    public function PrintData($ID){
        $Object = new UnRegisteredModel();
        $Object->User_ID = $ID;
        return $Object->SelectUser_ID();
    }

    public function Register(){
        $Code = $_POST['number'];
        $Username = $_POST['username'];
        $Password = $_POST['password'];
        $UnRegisteredObject = new UnRegisteredModel();
        $UnRegisteredObject->Number = $Code;
        $UserID = $UnRegisteredObject->Select();

        if ($UserID == NULL){
            header("Location:..\View\FaildRegister.html");
            exit;
        }
        else{
            RegisteredController::Register($UserID,$Username,$Password);
            $UnRegisteredObject->Delete();
        }

    }
}
?>