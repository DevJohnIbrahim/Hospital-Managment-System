<?php
require_once ("..\Model\User_PagesModel.php");
if (isset($_POST['Assign'])){
    User_PagesController::AssignUser_Pages();
}
elseif (isset($_POST['Delete'])){
    User_PagesController::DeleteUserPages();
}
class User_PagesController{

    public static function AssignUser_Pages(){
        $PageID = $_POST['PageID'];
        $UserTypeID = $_POST['UserTypeID'];
        $Object = new User_PagesModel();
        $Object->User_Type_ID = $UserTypeID;
        $Object->Page_ID = $PageID;
        if ($Object->Check()!=NULL){
            header("Location:..\View\FaildAssignPagesToUser.php");
            exit;
        }
        else{
            $Object->Insert();
            header("Location:..\View\SuccessAssignPageToUserType.php");
            exit;

        }
    }

    public static function DeleteUserPages(){
        $UserID = $_POST['UserTypeID'];
        $PageID = $_POST['PageID'];
        $UserPagesObject = new User_PagesModel();
        $UserPagesObject->Page_ID = $PageID;
        $UserPagesObject->User_Type_ID = $UserID;
        $Result = $UserPagesObject->Check();
        if ($Result != NULL){
            $UserPagesObject->Delete();
            header("Location:..\View\SuccessDeleteUserPage.php");
            exit;
        }
        else{
            header("Location:..\View\FaildDeleteUserPage.php");
            exit;
        }
    }

    public static function getPages($UserType){
        $UserPagesObject = new User_PagesModel();
        $UserPagesObject->User_Type_ID = $UserType;
        $result = $UserPagesObject->Select();
        return $result;
    }

}
?>
