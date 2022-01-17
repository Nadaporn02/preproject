<?php 
require("conn.php");
    $sql = "SELECT  `Current` FROM `data`";
    $sql_query =mysqli_query($conn,$sql);

$objResult = mysqli_fetch_array($sql_query);
if($objResult["Current"]=='No Active'){ ?>
    <p style="color:red;"><?php echo $objResult["Current"]."<br/>";?></p>
<?php }
else{echo $objResult["Current"]."<br/>";}

$conn->close();
?>