<?php
require_once("connect.php");

$Temp = $_GET['Temp'];
$Door = $_GET['Door'];
$Current = $_GET['Current'];

$sql1 = "SELECT  MAX(`id`)AS newid FROM `error`";
$sql_query =mysqli_query($con,$sql1);

$objResult = mysqli_fetch_array($sql_query);
$id = $objResult["newid"]."<br/>";


$sql = "UPDATE error set event=CURRENT_TIMESTAMP,Temp='".$Temp."',Door='".$Door."' ,Current='".$Current."' where id = '".$id."' ";
$result = mysqli_query($con, $sql);
if($result){
    echo "complete";
} else {
    echo "Error";
}


?>
