<?php
$Path = $_GET['ID'];
header ("Content-type:application/pdf");
header("Content-Disposition:inline;filename='".$Path."'");
header("Content-Transfer-Encoding:binary");
header('Accept-Ranges:bytes');
@readfile($Path);
?>