<?php
require('query/conn.php');
include('auth.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Simple Sidebar - Start Bootstrap Template</title>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="css/cssnoti.css" rel="stylesheet">
  <link href="css/indexcss.css" rel="stylesheet">
  <!-- Custom styles for this template -->
  <link href="css/simple-sidebar.css" rel="stylesheet">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <script src='https://kit.fontawesome.com/a076d05399.js'></script>
  <script src='ajex.js'></script>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" ></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</head>

<body Onload="bodyOnload();">

<div id="page-content-wrapper">       
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark border-bottom">   <!--menu bar-->
    <nav class="mb-1 navbar navbar-expand-lg navbar-dark info-color">
      <a class="navbar-brand"><img src="img/banner.png" alt="Trulli" width="200" height="33"></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-4"aria-controls="navbarSupportedContent-4" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent-4">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item active">
            <a class="nav-link" href="index.php">
              <i class="fa fa-home"></i>HOME
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="index2.php">
              <i class="fa fa-list-alt"></i> TABLE ALARM
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="logout.php">
              <i class="fa fa-sign-out"></i> logout
            </a>
          </li>
        </ul>
      </div>
    </nav>
    <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
      <li class="dropdown"> 
        <a href="index2.php?id=0"><i class='fas fa-bell'style="font-size:20px;">
          <span id="noti_number"></span></i>
        </a>&emsp;&emsp;
      </li>
    </ul>&emsp;
  </nav><br><br> 
      
<div class="row">&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
  <div class="col-sm-5">
    <div class="card">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3875.94724964856!2d100.32974871431138!3d13.721643501689742!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30e295c1936a839f%3A0xd46a0c8aa4160b88!2z4LiB4Lij4Liw4LiX4Li44LmI4Lih4Lil4LmJ4LihIDMyIOC4leC4s-C4muC4pSDguIHguKPguLDguJfguLjguYjguKHguKXguYnguKEg4Lit4Liz4LmA4Lig4Lit4Liq4Liy4Lih4Lie4Lij4Liy4LiZIOC4meC4hOC4o-C4m-C4kOC4oSA3NDEzMA!5e0!3m2!1sth!2sth!4v1580371094668!5m2!1sth!2sth"  height="700" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
    </div>
  </div>&emsp;&emsp;
  <div class="col-sm-5">
    <div class="row">
      <div class="col">
        <div class="card">
          <table border="0">
            <tr>
            <th width="30%"><img src="img/temp3.jpg" width="100" height="100"></th>
            <th> <h3>TEMP</h3><span id="mySpan"></span></th>
            </tr>
          </table>
        </div> 
      </div>
    </div><br>
    <div class="row">
      <div class="col">
        <div class="card">
          <table border="0">
            <tr>
            <th width="30%"><img src="img/door1.jpg" width="100" height="100"></th>
            <th><h3>DOOR</h3><span id="mySpan2"></span></th>
            </tr>
          </table>
        </div>
      </div>
    </div><br>
    <div class="row">
      <div class="col">
        <div class="card">
          <table border="0">
            <tr>
            <th width="30%"><img src="img/cur3.jpg" width="100" height="100"></th>
            <th><h3>CURRENT</h3><span id="mySpan3"></span></th>
            </tr>
          </table>
        </div>
      </div>
    </div><br>
    <div class="row">
      <div class="col">
        <div class="card">
          <?php include("code.php");?>
        </div>
      </div>
    </div>
  </div>
</div>

  <!-- <script>
    $("#menu-toggle").click(function(e) //ซ่อนแทบแจ้งเตือนกระดิ่ง
    {
      e.preventDefault();
      $("#wrapper").toggleClass("toggled");
    });
  </script> -->
<script type="text/javascript">
 
 function loadDoc() 
 {
  setInterval(function()
  {
    var xhttp = new XMLHttpRequest(); //ส่งคำขอไปเว็บ
    xhttp.onreadystatechange = function() 
    {
      if (this.readyState == 4 && this.status == 200) //คำขอสิ้นสุดและการตอบสนองพร้อมแล้ว200ok
      {
        document.getElementById("noti_number").innerHTML = this.responseText;
      }
    };
    xhttp.open("GET", "query/querynoti.php", true);
    xhttp.send();
  },1000);
}
 loadDoc();
</script>
</body>

<style>
  .sidebar a {
  padding: 6px 8px 6px 16px;
  text-decoration: none;
  font-size: 20px;
  color:#000;
  display: block;
}
.sidebar a:hover {
  color:LightGray;
}
</style>

</html>

