<?php
require_once ("..\Controller\ScheduleController.php");
?>
<html>
<head>
    <meta charset="utf-8">
    <title></title>
</head>
<body>
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
      <input type="submit" name="searchSC" value="search">
  </form>
  <?php echo $err; ?>
  <?php

if($cond=="true"){
  echo "<h3>Schedule</h3>";
    echo "<table>
    <tr>
       <th>ID</th>
       <th>Firstname</th>
       <th>Middlename</th>
       <th>day</th>
       <th>start</th>
       <th>end</th>
     </tr>
    ";
  while($row = mysqli_fetch_array($result3)){
      $result4=EmployeeController::ViewEmployee($row[5]);
      $row1 = mysqli_fetch_array($result4);
      $result5 = UserController::ViewProfile($row1[1]);
      echo "<tr>";
      echo "<td>".$row[0]."</td> <td>".$result5->FirstName."</td> <td> ".$result5->MiddleName."</td> <td>".$row[1]."</td> <td>".$row[2]."</td> <td>".$row[4];
      echo "</tr>";
  }
  echo "</table>";
  ?>
<form class="" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
  Type the id you want to delete
  <input type="number" name="SC_id" value="">
  <input type="submit" name="DeleteSC" value="Delete">
</form>
<?php } ?>
</body>
</html>
