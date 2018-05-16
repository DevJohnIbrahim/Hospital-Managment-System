<?php
require_once ("..\Model\DoctorModel.php");
require_once ("../Model/EmployeeModel.php");
require_once ("../Model/DoctorModel.php");
require_once ("../Model/UserModel.php");
require_once ("../Model/SalaryModel.php");
require_once ("../Model/Salary.php");

if (isset($_POST['AddDoctor'])){

    if($_POST['job_type']==1){
        $sal=new FullTime();
        DoctorController::Add($sal);
    }
    else{
        $sal=new PartTime();
        DoctorController::Add($sal);
    }
}
class DoctorController{
    public function ViewAllDoctors(){
        $Doctors = DoctorModel::SelectAll();
        return $Doctors;
    }

    public function GetDepDR($DepID){
        $DoctorModel =new DoctorModel();
        $Result = $DoctorModel->SelectDepDr($DepID);
        return $Result;
    }
    public function getDrName($ID){
        $DoctorModel = new DoctorModel();
        $DoctorModel->ID = $ID;
        return $DoctorModel->getDrName();

    }

    public function GetDrID($UserID){
        $DoctorModel = new DoctorModel();
        $DRID = $DoctorModel->getDrID($UserID);
        return $DRID;
    }

    public static function Add(Salary $sal){
        $UserID = $_POST['UID'];
        $WorkingHours = $sal->getWorkinghours();
        $DepID = $_POST['Dep_ID'];

        $Salary = new SalaryModel();
        $Salary->salary=$sal->calculateSalary();
        $Salary->tax=$sal->getTax();
        $Salary->incentives=$sal->getIncentives();
        $Salary->economic_sal=200;
        $SalaryID=$Salary->Insert();
        $UserModel = new User();
        $UserModel->ID = $UserID;
        $Result = $UserModel->Select();
        if ($Result == NULL){
            //Redirect
        }
        else{
            $Result->Dep_Number = $DepID;
            $Result->Modify();

            $EmployeeModel = new EmployeeModel();
            $EmployeeModel->user_id = $UserID;
            $EmployeeModel->dep_id = $DepID;
            $EmployeeModel->salary_id = $SalaryID;
            $EmployeeID = $EmployeeModel->Insert();
            $DoctorModel = new DoctorModel();
            $DoctorModel->Employee_ID = $EmployeeID;
            $DoctorModel->Working_Hours = $WorkingHours;
            $DoctorModel->Insert();
        }


    }


}

?>
