
<?php
$Temp = $_GET['Temp'];
$Door = $_GET['Door'];
$Current = $_GET['Current'];
$status = $_GET['status'];

require_once("connect.php");

$sql1 = "SELECT  MAX(`id`)AS newid FROM `error`";
$sql_query =mysqli_query($con,$sql1);

$objResult = mysqli_fetch_array($sql_query);
$id = $objResult["newid"]."<br/>";
$id1 = $id+1;

$sql = "insert into error set event=CURRENT_TIMESTAMP,id ='".$id1."',Temp='".$Temp."',Door='".$Door."' ,Current='".$Current."',status='".$status."'";
$result = mysqli_query($con, $sql);
if($result){
    echo "complete";
} else {
    echo "Error";
}

?>

