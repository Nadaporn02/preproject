
<?php
require_once("connect.php");

$Temp = $_GET['Temp'];
$Door = $_GET['Door'];
$Current = $_GET['Current'];

$sql = "UPDATE data set event=CURRENT_TIMESTAMP,Temp='".$Temp."',Door='".$Door."' ,Current='".$Current."'";
$result = mysqli_query($con, $sql);
if($result){
    echo "complete";
} else {
    echo "Error";
}

?>

