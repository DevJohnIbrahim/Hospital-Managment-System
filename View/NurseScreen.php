<?php
require_once ("..\Controller\AppointmentController.php");
require_once ("..\Model\AppointmentModel.php");
require_once ("..\Controller\UserController.php");
require_once ("..\Controller\PendingPaymentController.php");
require_once ("..\Model\PendingPaymentModel.php");
$ApController = new AppointmentController();
$Objects = $ApController->GetAppointments($_SESSION['Dep_ID']);
$UserController = new UserController();

$PendinPaymentsControllerObject = new PendingPaymentController();
$PendingPayments = $PendinPaymentsControllerObject->getAllPending($_SESSION['Dep_ID']);
?>

<html>
<body>
<table width="200" border="1">
    <tr>
        <th colspan="3">Patient Queue</th>
    </tr>
    <tr>
        <th>Patient Name</th>
        <th>Doctor Name</th>
        <th>Forward</th>
    </tr>

    <?php
        if ($Objects == NULL){

        }else{
            for ($x=0;$x<count($Objects);$x++){
                echo "<tr>";
                echo "<th>".$UserController->getPatientName($Objects[$x]->Patient)." </th>";
                echo "<th>".$UserController->getDoctorName($Objects[$x]->Doctor)."</th>";
                echo "<th><a href='..\Controller\AppointmentController.php?ID=".$Objects[$x]->ID."'><button>Forward</button></a></th>";
                echo "</tr>";
            }
        }

    ?>
</table>
<br>

<table width="200" border="1">
    <tr>
        <th colspan="3">Payment Queue</th>
    </tr>
    <tr>
        <th>Patient Name</th>
        <th>Total Price</th>
        <th>Payment</th>
    </tr>
    <?php
        if ($PendingPayments == NULL){

        }else{
            for ($x=0;$x<count($PendingPayments);$x++){
                echo "<tr>";
                echo "<th>".$PendinPaymentsControllerObject->GetPatientName($PendingPayments[$x]->ID)."</th>";
                echo "<th>".$PendingPayments[$x]->TotalPrice."</th>";
                echo "<th><a target='_blank' href='PayView.php?ID=".$PendingPayments[$x]->ID."'><button>Pay</button></a></th>";
                echo "</tr>";
            }
        }

    ?>

</table>

</body>
</html>
