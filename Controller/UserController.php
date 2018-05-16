<?php
require_once ("..\Model\UserModel.php");
require_once ("PhoneController.php");
require_once ("UnRegisteredController.php");
require_once ("..\Model\AddressModel.php");
require_once ("../Public/External Libraries/FPDF/fpdf.php");
require_once ("..\Controller\AddressController.php");
if (isset($_POST['AddUser'])){
    UserController::AddUser();
}
elseif (isset($_POST['DeleteUser'])){
    UserController::DeleteUser();
}
elseif (isset($_POST['EditUser'])){
    UserController::EditProfile();
}
elseif (isset($_POST['EditUserType'])){
    UserController::EditUserType();
}
elseif (isset($_POST['pdf'])){
    UserController::PDF();
}
elseif (isset($_GET['ID'])){
    UserController::CheckName();
}
class UserController{

    public function CheckName(){
        $UserID = $_GET['ID'];
        $UserModel = new User();
        $UserModel->ID = $UserID;
        $Result = $UserModel->Select();
        if ($Result == NULL){
            echo json_encode("No User Found By This ID");
        }
        else{
            echo json_encode($Result->FirstName." ".$Result->MiddleName." ".$Result->LastName);
        }
    }
    public static function AddUser(){
        $FirstName = $_POST['firstname'];
        $MiddleName = $_POST['middlename'];
        $Lastname = $_POST['lastname'];
        $AddressID = $_POST['address'];
        $UserTypeID = 2;
        $Gender = $_POST['gender'];
        $SSN = $_POST['ssn'];
        $DOB = $_POST['dob'];
        $Phone = $_POST['phone'];
        $LoginStatus = 0;
        $UserObject = new User();
        $UserObject->FirstName = $FirstName;
        $UserObject->LastName = $Lastname;
        $UserObject->MiddleName = $MiddleName;
        $UserObject->Address_ID = $AddressID;
        $UserObject->UserType_ID = $UserTypeID;
        $UserObject->Gender  = $Gender;
        $UserObject->SocialSecuirityNumber = $SSN;
        $UserObject->DateOfBirith = $DOB;
        $UserObject->LoginStatus = $LoginStatus;
        if ($UserObject->Check() != NULL){
            header("Location:..\View\FaildAddUser.php");
            exit;
        }else{
            $ID = $UserObject->Insert();
            //***************************************Phone Object
            $PhoneObject = new PhoneController();
            $PhoneObject->AddPhone($ID,$Phone);
            //*****************************************UnRegistered
            $Number = UnRegisteredController::AddRecord($ID);
            $_SESSION['ID3'] = $ID;
            header("Location:..\View\RegisterDataPrint.php");
            exit;
            }


    }

    public static function DeleteUser(){
       $ID =  $_POST['ID'];
       $UserObject = new User();
       $UserObject->ID = $ID;
       if ($UserObject->Select()!=NULL){
           $UserObject->Delete();
            header("Location:..\View\SuccessDeleteUser.html");
            exit;
       }
       else{
            header("Location:..\View\FaildDeleteUser.html");
            exit;
       }
    }

    public static function ViewProfile ($ID){
        $UserObject = new User();
        $UserObject->ID = $ID;
        $Result = $UserObject->Select();
        return $Result;
    }

    public static function EditProfile(){
        $ID = $_SESSION['ID'];
        $Object = self::ViewProfile($ID);
        $FirstName = $_POST['firstname'];
        $MiddleName = $_POST['middlename'];
        $LastName = $_POST['Lastname'];
        $SSN = $_POST['ssn'];
        $DateOfBirith = $_POST['dob'];
        $UserObject = new User();
        $UserObject->ID = $ID;
        $UserObject->FirstName = $FirstName;
        $UserObject->MiddleName = $MiddleName;
        $UserObject->LastName = $LastName;
        $UserObject->Address_ID = $Object->Address_ID;
        $UserObject->UserType_ID = $Object->UserType_ID;
        $UserObject->Gender = $Object->Gender;
        $UserObject->SocialSecuirityNumber = $SSN;
        $UserObject->DateOfBirith = $DateOfBirith;
        $UserObject->LoginStatus = $Object->LoginStatus;
        $UserObject->Modify();
        header("Location:..\View\SuccessEditProfile.php");
        exit;

    }

    public static function EditUserType(){
        $ID = $_SESSION['ID2'];
        $UserTypeID = $_POST['UTID'];
        $Object = self::ViewProfile($ID);
        if ($Object == NULL){
            header("Location:..\View\FaildEditUserTypeEnterID.html");
            exit;
        }else{
            $UserObject = new User();
            $UserObject->ID = $ID;
            $UserObject->FirstName =$Object->FirstName;
            $UserObject->MiddleName = $Object->MiddleName;
            $UserObject->LastName = $Object->LastName;
            $UserObject->Address_ID = $Object->Address_ID;
            $UserObject->UserType_ID = $UserTypeID;
            $UserObject->Gender = $Object->Gender;
            $UserObject->SocialSecuirityNumber = $Object->SocialSecuirityNumber;
            $UserObject->DateOfBirith = $Object->DateOfBirith;
            $UserObject->LoginStatus = $Object->LoginStatus;
            $UserObject->Modify();
            header("Location:..\View\SuccessEditUserTypeEnterID.html");
            exit;
        }

    }

    public function PDF(){
        $Number = UnRegisteredController::PrintData($_SESSION['ID3']);
        $UserObject = UserController::ViewProfile($_SESSION['ID3']);
        $PhoneObjects = PhoneController::getPhones($_SESSION['ID3']);
        $AddressObject = AddressController::SelectAddress($UserObject->Address_ID);
        $FPDFObject = new FPDF();
        $FPDFObject->AddPage();
        $FPDFObject->SetFont('Arial','',10);
        $FPDFObject->Cell(40,10,"Name: ".$UserObject->FirstName." ".$UserObject->MiddleName." ".$UserObject->LastName);
        $FPDFObject->Ln();
        $FPDFObject->Cell(40,10,"Address: ".$AddressObject->Name);
        $FPDFObject->Ln();
        $FPDFObject->Cell(40,10,"Gender: ".$UserObject->Gender);
        $FPDFObject->Ln();
        $FPDFObject->Cell(40,10,"Social Security Number: ".$UserObject->SocialSecuirityNumber);
        $FPDFObject->Ln();
        $FPDFObject->Cell(40,10,"Date Of Birith: ".$UserObject->DateOfBirith);
        $FPDFObject->Ln();
        $FPDFObject->Cell(40,10,"Phone Number : ".$PhoneObjects[0]->Phone);
        $FPDFObject->Ln();
        $FPDFObject->Cell(40,10,"Please Note that this Number is Very Important to Use it to register in our online services");
        $FPDFObject->Ln();
        $FPDFObject->Cell(40,10,"Number: ".$Number);
        $FPDFObject->Output();
    }

    public function getName ($ID){
        $UserModel = new User();
        return $UserModel->getName($ID);
    }
    public function getPatientName($ID){
        $UserModel = new User();
        return $UserModel->getPatientName($ID);
    }

    public function getDoctorName ($ID){
        $UserModel = new User();
        return $UserModel->getDoctorName($ID);
    }

    public function Check($ID){
        $UserModelObject = new User();
        $UserModelObject->ID = $ID;
        return $UserModelObject->Select();
    }

}
?>
