<?php
$_SESSION['ID'] =22;
require_once ("..\Controller\UserController.php");
require_once ("..\Model\UserModel.php");
require_once ("..\Controller\PhoneController.php");
require_once ("..\Model\PhoneModel.php");
require_once ("..\Controller\AddressController.php");
require_once ("..\Model\AddressModel.php");
?>
<html>
<head>
    <title>Edit Profile</title>
</head>
<body>
<?php
$UserObject = UserController::ViewProfile($_SESSION['ID']);
$PhoneObjects = PhoneController::getPhones($_SESSION['ID']);
$AddressObject = AddressController::SelectAddress($UserObject->Address_ID);
?>
<h4 style="color: green;">Changes Saved Successfully</h4>
<form method="post" action="..\Controller\UserController.php">
    FirstName : <input type = "text" name = "firstname" value = "<?php echo $UserObject->FirstName;?>"><br>
    MiddleName : <input type = "text" name = "middlename" value = "<?php echo $UserObject->MiddleName; ?>"><br>
    LastName : <input type =  "text" name = "Lastname" value = "<?php echo $UserObject->LastName; ?>"><br>
    Social Security Number : <input type = "number" name = "ssn" value = "<?php echo $UserObject->SocialSecuirityNumber;?>"><br>
    Date Of Birith : <input type = "date" name = "dob" value = "<?php echo $UserObject->DateOfBirith; ?>"><br>
    <input type = "submit" name = "EditUser" value = "Save">
    <a href="Menue.php"><input type="button" value="Back"></a>

</form>
</body>
</html>
