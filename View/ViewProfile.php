<?php
session_start();
require_once ("..\Controller\UserController.php");
require_once ("..\Model\UserModel.php");
require_once ("..\Controller\PhoneController.php");
require_once ("..\Model\PhoneModel.php");
require_once ("..\Controller\AddressController.php");
require_once ("..\Model\AddressModel.php");

?>
<html>
<head>
    <title>View Profile</title>
</head>
<body>
<?php
$UserObject = UserController::ViewProfile($_SESSION['ID']);
$PhoneObjects = PhoneController::getPhones($_SESSION['ID']);
$AddressObject = AddressController::SelectAddress($UserObject->Address_ID);
?>
FirstName : <?php echo $UserObject->FirstName; ?><br>
MiddleName : <?php echo $UserObject->MiddleName; ?><br>
LastName : <?php echo $UserObject->LastName; ?><br>
Address : <?php echo $AddressObject->Name;?><br>
Gender : <?php echo $UserObject->Gender; ?><br>
Social Security Number : <?php echo $UserObject->SocialSecuirityNumber; ?><br>
Date Of Birith : <?php echo $UserObject->DateOfBirith; ?><br>
<?php

if ($PhoneObjects == NULL){

}
else{
    $Size = count($PhoneObjects);
    for ($x = 0; $x <$Size; $x++) {
        echo "Phone " . $x . " :   " . $PhoneObjects[$x]->Phone.'<br>';

    }
}


?>

</body>
</html>