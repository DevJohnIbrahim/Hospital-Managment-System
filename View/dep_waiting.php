<?php
require_once ("..\Controller\DepartmentController.php");
?>
<html>
</head>
<body>
<h2>Waiting Screen</h2>
<br>
<h3>Department Waiting List</h3>
<form class="searchform" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <?php
    echo "<select name="."'dep'"." > <option value =",-1,"> Choose department</option>";
    $x=0;
    while($x<count($result)){
        echo "<option value=".$result[$x]->id.">".$result[$x]->name."</option>" ;
        $x++;
    }
    echo "</select>";
    ?>
    <br>
    <input type="submit" name="searchdepartment" value="search">
</form>

<?php
if($cond=="true"){
    echo "<table> <tr><th>Department</th>    <th>Patient ID</th>    <th>waiting date</th>    <th>waiting number</th></tr>";
    while($row1=mysqli_fetch_array($result1)){
        echo "<tr><td>".$row1[1]."</td><td>  ".$row1[2]."</td> <td> ".$row1[3]."</td> <td> ".$row1[4]."</td></tr>";
    }
    echo "</table>";
}
echo $err;

?>
<br>
<br>
<a href="reception_screen.php"><button>back to Reception Screen</button></a>
</body>
</html>
