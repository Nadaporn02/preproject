<?php 
require("conn.php");
    $sql = "SELECT  `Door` FROM `data`";
    $sql_query =mysqli_query($conn,$sql);

$objResult = mysqli_fetch_array($sql_query);
if($objResult["Door"]=='opened'){ ?>
    <p style="color:red;"><?php echo $objResult["Door"]."<br/>";?></p>
<?php }
else{echo $objResult["Door"]."<br/>";}
$conn->close();
?>