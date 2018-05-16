<?php
require_once ("../Model/MedicationModel.php");
$med=new MedicationModel();
$med0bj=$med->select();
$dataPoints = array();
  for($x=0;$x<Count($med0bj);$x++){
   $y=$med0bj[$x]->Name;
   $z=(int)$med0bj[$x]->Counter;
   $dataPoints[] = array("x"=> ($x+10), "y"=> $z, "indexLabel"=> $y);
}

?>
<!DOCTYPE HTML>
<html>
<head>
<script>
window.onload = function () {

var chart = new CanvasJS.Chart("chartContainer", {
 animationEnabled: true,
 exportEnabled: true,
 theme: "light1", // "light1", "light2", "dark1", "dark2"
 title:{
   text: "Simple Column Chart with Index Labels"
 },
 data: [{
   type: "column", //change type to bar, line, area, pie, etc
   //indexLabel: "{y}", //Shows y value on all Data Points
   indexLabelFontColor: "#5A5757",
   indexLabelPlacement: "outside",
   dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
 }]
});
chart.render();

}
</script>
</head>
<body>
<div id="chartContainer" style="height: 370px; width: 100%;"></div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</body>
</html>
