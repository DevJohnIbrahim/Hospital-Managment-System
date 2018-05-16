<?php
    require_once ("..\Controller\UserController.php");
   $button="";
   $name="";
   $id="";
   $err="";
if($_SERVER["REQUEST_METHOD"]=="POST"){
    if(!empty($_POST["search_by_id"])){
        $user=new UserController();
        $result=$user->ViewProfile($_POST["search_by_id"]);

        if($result!=null){
            $name="Patient name: ".$result->FirstName." ".$result->MiddleName." ".$result->LastName;
            $id="ID: ".$result->ID;
            $button="<a href = 'Treasury.php' ><button>Go to treasury</button></a>";
            $_SESSION["patient_id"] = $result->ID;
            $_SESSION["patient_name"]= $result->FirstName." ".$result->MiddleName." ".$result->LastName;
        }
        else{
            $err="patient not found";
        }
    }
}
?>
<html>
</head>
<body>
<h2>Reception Screen</h2>
<br>
<h3>Search patient</h3>
<form class="searchform" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    Search patient_id by id: <input type="number" name="search_by_id" value="" required>
    <input type="submit" name="select" value="search">
</form>
<div class="result">
    <?php
    echo "<br>".$name."<br>";
    echo "<br>".$id."<br>";
    echo "<br>".$button;
    echo $err;
    ?>
</div>
</body>
</html>