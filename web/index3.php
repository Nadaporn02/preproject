<?php
    include("upsql.php");
    include('auth.php');
    $date = $_GET['dateInput'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>INSPIRECOMM</title>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="css/css.css" rel="stylesheet">
  <!-- Custom styles for this template -->
  <link href="css/simple-sidebar.css" rel="stylesheet">
  <script src='https://kit.fontawesome.com/a076d05399.js'></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <link rel="stylesheet" media="all" type="text/css" href="calender/jquery-ui.css" />
		<link rel="stylesheet" media="all" type="text/css" href="calender/jquery-ui-timepicker-addon.css" />

		<script type="text/javascript" src="calender/jquery-1.10.2.min.js"></script>
		<script type="text/javascript" src="calender/jquery-ui.min.js"></script>

		<script type="text/javascript" src="calender/jquery-ui-timepicker-addon.js"></script>
    <script type="text/javascript" src="calender/jquery-ui-sliderAccess.js"></script>
  
</head>

<body>
<div id="page-content-wrapper">
<nav class="navbar navbar-expand-lg navbar-dark bg-dark border-bottom">
<nav class="mb-1 navbar navbar-expand-lg navbar-dark info-color">
  <a class="navbar-brand"><img src="img/banner.png" alt="Trulli" width="200" height="33"></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-4"
    aria-controls="navbarSupportedContent-4" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent-4">
    <ul class="navbar-nav ml-auto">
      <li class="nav-item active">
        <a class="nav-link" href="index.php">
          <i class="fa fa-home"></i> HOME</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="index2.php">
          <i class="fa fa-list-alt"></i> TABLE ALARM</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="logout.php">
          <i class="fa fa-sign-out"></i> LOGOUT</a>
      </li>
    </ul>
  </div>
</nav>&emsp;
</nav><br><br> 
<form action="index3.php" method="get"> &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
<input type="text" name="dateInput" id="dateInput"  placeholder="วัน/เดือน/ปี" /> 
<button type="submit" class="btn btn-warning" style="color:#F0F8FF;">ดูย้อนหลัง</button>
</form>
<div class="row">
  <div class="col-sm-1">
    <a button class="button button2" href="pdf1.php?dateInput=<?php echo $date; ?>"><i class='fas fa-download'></i>PDF</button></a><br><br>
  </div>
  <div class="col-sm-1">
    <a button class="button button2" href="sam1.php?export=true&day=<?php echo $date; ?>"><i class='fas fa-download'></i>excel</button></a>
  </div>
</div>

<?php
require("query/conn.php");
$sql = "SELECT  `event`, `Temp`, `Door`, `Current` FROM `error` WHERE DATE(event)='".$date."' ";
$sql_query =mysqli_query($conn,$sql);
?>
<div class="container">
<h1>&nbsp;ERROR</h1>
<center>
<table border="0" style=" font-family: sarabun;" >
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
<script type="text/javascript">

$(function(){
  $("#dateInput").datepicker({
    dateFormat: 'yy-mm-dd',
    numberOfMonths: 1,
  });
});

</script>
<style>
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