<?php
require_once ("..\Controller\waitingController.php");
?>
<html>
<head>
    <meta charset="utf-8">
    <title></title>
</head>
<body>
<?php
if($cond=="true"){
    echo "<h2>Waiting List</h2>";
    echo "<table border=1 width=60%> <tr><th>Department</th>    <th>Patient name</th>    <th>waiting date</th>    <th>waiting number</th> <th>prescription</th> <th>diagnosis</th></tr>";
    while($row1=mysqli_fetch_array($result2)){
        $_SESSION["todelete1"]=$row1[0];
        echo "<tr><td>".$rows[1]."</td><td>  ".$row1[6]." ".$row1[7]." ".$row1[8]."</td> <td> ".$row1[3]."</td> <td> ".$row1[4]."</td> <td><a href='prescription.php?patient_id=".$row1[2]."'><button>write</button></a></td><td><a href='medicalreport.php?patient_id=".$row1[2]."'><button>write</button></a></td></tr>";
    }
    echo "</table>";
    echo "<form  action='".htmlspecialchars($_SERVER['PHP_SELF'])."' method='post'>
      <br>  <input type='submit'  name='todelete' value='next patient'> </form>";
}
echo $err;

?>

</body>
</html>