
<?php
require_once("connect.php");

$Temp = $_GET['Temp'];

$sql = "insert into adata set event=CURRENT_TIMESTAMP,Temp='".$Temp."'";
$result = mysqli_query($con, $sql);
if($result){
    echo "complete";
} else {
    echo "Error";
}

?>

