<?php
require_once ("..\Model\UserTypeModel.php");
if (isset($_POST['addnewUserType'])){
    UserTypeController::AddUserType();
}
elseif (isset($_POST['DeleteUserType'])){
    UserTypeController::DeleteUserType();
}
class UserTypeController{
    public function EditUserType(){
        $Results = UserTypeModel::Select();
        return $Results;
    }

    public static function AddUserType(){
            $Type = $_POST['type'];
            $Object = new UserTypeModel();
            $Object->Type = $Type;
            if ($Object->Check() != NULL){
                header("Location:..\View\FaildToAddUserType.html");
                exit;
            }
            else{
                $Object->Insert();
                header("Location:..\View\SuccessAddUserType.html");
                exit;
            }

    }
    public static function DeleteUserType(){
        $ID = $_POST['UserType'];
        $Object = new UserTypeModel();
        $Object->ID = $ID;
        $Object->Delete();
        header("Location:..\View\SuccessDeleteUserType.php");
        exit;
    }
}

?>
