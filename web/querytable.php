
<?php 
require("query/conn.php");
    $sql = "select * from error WHERE 1 ORDER BY id DESC";
    $sql_query =mysqli_query($conn,$sql);
    ?>

<html>
<head>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://fonts.googleapis.com/css?family=Sarabun&display=swap" rel="stylesheet">
</head>
<body>
  <div class="container">
    <h1>&nbsp;ERROR</h1>
    <center>
    <table border="0">
      <thead>
      <tr>
      <th > <div align="center"><a href="JavaScript:doCallAjax('CustomerID')">Temp</a></div></th>
      <th > <div align="center"><a href="JavaScript:doCallAjax('Name')">Door</a> </div></th>
      <th > <div align="center"><a href="JavaScript:doCallAjax('Name')">Current</a> </div></th>
      <th > <div align="center"><a href="JavaScript:doCallAjax('Name')">Date</a> </div></th>
      </tr>
      </thead>
      <?php
      while($objResult = mysqli_fetch_array($sql_query))
      { ?>
      <tbody>
      <tr>
      <td><div align="center"><?php echo $objResult["Temp"];?></div></td>
      <td><div align="center"><?php echo $objResult["Door"];?></div></td>
      <td><div align="center"><?php echo $objResult["Current"];?></div></td>
      <td><div align="center"><?php echo $objResult["event"];?></div></td>
      </tr>
      </tbody>
      <?php } ?>
    </table>
    </center>
  </div>
</body>

<style>
body {
    font-family: sarabun;
}
table {
  border-collapse: collapse;
  width: 100%;
}
th{
  color:blue;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}
</style>

</html>


<?php $conn->close(); ?>

