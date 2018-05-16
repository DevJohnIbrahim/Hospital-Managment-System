<?php
    require_once ("..\Controller\UnRegisteredController.php");
    require_once ("..\Controller\PhoneController.php");
    require_once ("..\Controller\UserController.php");
    require_once ("..\Controller\AddressController.php");
    echo $_SESSION['ID3'];
    $Number = UnRegisteredController::PrintData($_SESSION['ID3']);
    $UserObject = UserController::ViewProfile($_SESSION['ID3']);
    $PhoneObjects = PhoneController::getPhones($_SESSION['ID3']);
    $AddressObject = AddressController::SelectAddress($UserObject->Address_ID);
    ?>
<html>
<head><title>Print</title></head>
<body>
First Name : <?php echo $UserObject->FirstName; ?><br>
Middle Name : <?php echo $UserObject->MiddleName; ?><br>
Last Name : <?php echo $UserObject->LastName; ?><br>
Address : <?php echo $AddressObject->Name; ?><br>
Gender : <?php echo $UserObject->Gender; ?><br>
Social Security Number : <?php echo $UserObject->SocialSecuirityNumber; ?><br>
Date Of Birith : <?php echo $UserObject->DateOfBirith; ?><br>
Phone Number : <?php echo $PhoneObjects[0]->Phone;?><br>

<h4>Please Use This Code To Register With Our Online Services</h4>

<h5>Code : <?php echo $Number;?> </h5><br>

<button onclick="window.print()">Print</button>
<a href = "Menue.php"><button>Back</button></a>
<form action="..\Controller\UserController.php" method="post">
    <input type="submit" name="pdf" value="Export To PDF">
</form>






</body>
</html>


