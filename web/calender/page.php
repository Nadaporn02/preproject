<?php
$date = $_GET['dateInput'];
echo $date;

$serverName = "localhost";
$userName = "root";
$userPassword = "";
$dbName = "test";
$conn = mysqli_connect($serverName,$userName,$userPassword,$dbName);

$sql = "SELECT  `event`, `Temp`, `Door`, `Current` FROM `error` WHERE DATE(event)='".$date."' ";
$sql_query =mysqli_query($conn,$sql);

      echo "<table border='1' align='center' width='500'>";
//หัวข้อตาราง

while($objResult = mysqli_fetch_array($sql_query)) { 
  echo "<tr>";
  echo "<td>" .$objResult["Temp"] .  "</td> "; 
  echo "<td>" .$objResult["Door"].  "</td> ";  
  echo "<td>" .$objResult["Current"] .  "</td> ";
  echo "<td>" .$objResult["event"] .  "</td> ";
  echo "</tr>";
}
echo "</table>";
//5. close connection
mysqli_close($conn);
?>

