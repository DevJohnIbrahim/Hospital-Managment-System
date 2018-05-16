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
    <input type="submit" name="searchdep" value="search">
</form>
<?php
     echo $err;
     if($cond=='true'){
  ?>
<form class="addSC" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

    <?php

    echo "<select name="."'employee_id'"." > <option value =",-1,"> Choose employee</option>";
    while($row = mysqli_fetch_array($result1)){
      $result2 = $user->ViewProfile($row[1]);
        echo "<option value=".$row[0].">".$result2->FirstName." ".$result2->MiddleName."</option>" ;
    }
    echo "</select><br>";
    ?>
    <input type="text" name="dep_id" value="<?php echo $dep_id;  ?>" hidden>
    <br>
    Day
    <br>
    <select class="" name="day">
      <option value="Sunday">Sunday</option>
        <option value="Monday">Monday</option>
          <option value="Tuesday">Tuesday</option>
            <option value="Wednesday">Wednesday</option>
              <option value="Thursday">Thursday</option>
                <option value="Friday">Friday</option>
                  <option value="Saturday">Saturday</option>
    </select>
      <br>  <br>
    Starting Time
    <br>
    <select class="" name="from">
      <option value="08:00:00">8 AM</option>
        <option value="14:00:00">2 PM</option>
          <option value="20:00:00">8 PM</option>

    </select>
      <br>  <br>
    Ending Time
    <br>
    <select class="" name="to">
      <option value="08:00:00">8 AM</option>
        <option value="14:00:00">2 PM</option>
          <option value="20:00:00">8 PM</option>

    </select>
    <br>
    <br>
    <input type="submit" name="AddSC" value="Add">
  </form>

<?php } echo $err1;?>
</body>
</html>
