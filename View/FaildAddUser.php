<?php
require_once ("..\Controller\UserController.php");
require_once ("..\Controller\AddressController.php");
require_once ("..\Model\AddressModel.php");
?>

<html>

<body>
<h4 style="color:red;">Sorry But this Social Security Number Already Registered in our Database </h4>
<form action = '../Controller/UserController.php' method = 'post'>

    <p> First Name : <input type = "text" name = 'firstname' required></p>

    <p> Middle Name : <input type = "text" name = 'middlename' required></p>

    <p> Last Name : <input type = "text" name = 'lastname' required></p>
    <p>Phone : <input type = "number" name = "phone" required></p>
    <p> Address :

        <select name = 'address'>
            <?php
            $AddressControllerObject = new AddressController();
            $Objects = $AddressControllerObject->AddUserAddress(0);
            if ($Objects == NULL){
                echo"<option>No Data To Show </option>";
            }
            else{
                $Size = count($Objects);

                for ($x=0;$x<$Size;$x++){
                    echo '<option value = '.$Objects[$x]->ID.'>'.$Objects[$x]->Name.'</option>';
                }

            }


            ?>



        </select>

    </p>

    <p> Gender :

        <input type = 'radio' name = 'gender' value = 'male'>Male

        <input type = 'radio' name = 'gender' value = 'female'>Female

    </p>

    <p> Social Secuirity Number <input type = 'number' name = 'ssn' required></p>

    <p> Date Of Birith : <input type = 'date' name = 'dob' required></p>

    <input type = "submit" id="addbtn" value="Add" name = "AddUser">
    <a href = "Menue.php"><input type = "button" value = "Back"></a>

</form>



</body>

</html>
