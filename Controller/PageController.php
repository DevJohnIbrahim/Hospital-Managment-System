<?php
require_once ("..\Model\PageModel.php");
if (isset($_POST['AddPage'])){
    PageController::AddPage();
}
elseif (isset($_POST['DeletePage'])){
    PageController::DeletePage();
}
class PageController{
    public static function AddPage(){
        $PageName = $_POST['name'];
        $URL = $_POST['url'];

        if (file_exists($URL)){
            $Object = new PageModel();
            $Object->Friendly_Name = $PageName;
            $Object->URL = $URL;
            $Result = $Object->Check();
            if ($Result == NULL){
                $Object->Insert();
                header("Location:..\View\SuccessAddPage.html");
                exit;
            }
            else{
                header("Location:..\View\FoundPageFaild.html");
                exit;
            }

        }
        else{
            header("Location:..\View\FaildAddPage.html");
            exit;
        }
    }

    public static function getAllPages(){
        $results = PageModel::SelectAll();
        return $results;
    }

    public static function DeletePage(){
        $PageID = $_POST['ID'];
        $Object = new PageModel();
        $Object->ID = $PageID;
        $Object->Delete();
        header("Location:..\View\SuccessDeletePage.php");
        exit;
    }

    public static function getPageData($PageID){
        $Object = new PageModel();
        $Object->ID = $PageID;
        return $Object->Select();
    }
}
?>
