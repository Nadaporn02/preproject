<?php 
require("conn.php");
    $sql = "SELECT  `Temp` FROM `data`";
    $sql_query =mysqli_query($conn,$sql);

$objResult = mysqli_fetch_array($sql_query);
if(($objResult["Temp"]>40)||($objResult["Temp"]==-127)){ ?>
    <p style="color:red;"><?php echo $objResult["Temp"]; echo" &#176C<br/>";?></p>
<?php }
else{echo $objResult["Temp"];echo" &#176C<br/>";}
$conn->close();
?>