<?php
/**
 * Charts 4 PHP
 *
 * @author Shani <support@chartphp.com> - http://www.chartphp.com
 * @version 2.0
 * @license: see license.txt included in package
 */

include_once("../Public/External Libraries/Dashboard Charts/config.php");
include_once("../Public/External Libraries/Dashboard Charts/lib/inc/chartphp_dist.php");

$p = new chartphp();

require_once ("../Controller/DashboardController.php");
$DashBoardController = new DashboardController();
$data = $DashBoardController->getChartdata();
$p->data=$data;
$p->chart_type = "bar";

// Common Options
$p->title = "Bar Chart";
$p->xlabel = "Department";
$p->ylabel = "Total Income";
$p->showxticks = true;
$p->showyticks = true;
$p->showpointlabel = true;
$out = $p->render('c1');
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="../../lib/js/chartphp.css">
    <script src="../Public/External%20Libraries/Dashboard%20Charts/lib/js/jquery.min.js"></script>
    <script src="../Public/External%20Libraries/Dashboard%20Charts/lib/js/chartphp.js"></script>
</head>
<body>
<div>
    <?php echo $out; ?>
</div>
</body>
</html>
