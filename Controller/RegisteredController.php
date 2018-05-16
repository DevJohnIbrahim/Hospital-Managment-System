<?php
session_start();
require_once ("..\Model\RegisteredModel.php");
require_once ("..\Model\UserModel.php");
if (isset($_POST['login'])){
    RegisteredController::Login();
}
class RegisteredController{
    public function Register($UserID , $UserName , $Password){
        $Object = new RegisteredModel();
        $Object->User_ID = $UserID;
        $Object->UserName = $UserName;
        $Object->Pasword = $Password;
        $Object->Insert();
    }

    public function Login(){
        $UserName = $_POST['username'];
        $Password = $_POST['password'];
        $RegisteredObject = new RegisteredModel();
        $RegisteredObject->UserName = $UserName;
        $RegisteredObject->Pasword = $Password;
        $UserID = $RegisteredObject->Login();

        if ($UserID != NULL){
            $_SESSION['ID'] = $UserID;
            $UserModel = new User();
            $UserModel->ID = $UserID;
            $Result = $UserModel->Select();
            $_SESSION['Dep_ID'] = $Result->Dep_Number;
            header('Location:..\View\Menue.php');
            exit;
        }
        else{
            header("Location:..\View\FaildLogin.html");
            exit;
        }

    }
}
?>