<html>
<head>
    <meta charset="utf-8">
    <title>รายงานในแบบกราฟ </title>
</head>
<?php
$con= mysqli_connect("localhost","root","","test") or die("Error: " . mysqli_error($con)); 
mysqli_query($con, "SET NAMES 'utf8' ");
 
$query = "
SELECT AVG(Temp) AS Temps, DATE_FORMAT(event, '%d/%m/%Y :%H.%i') AS datesave
FROM adata 
WHERE DATE(event) = CURDATE()
GROUP BY DATE_FORMAT(event, '%H%')
";
$result = mysqli_query($con, $query);
$resultchart = mysqli_query($con, $query);  


 //for chart
$datesave = array();
$totol = array();

while($rs = mysqli_fetch_array($resultchart)){ 
  $datesave[] = "\"".$rs['datesave']."\""; 
  $totol[] = "\"".$rs['Temps']."\""; 
}
$datesave = implode(",", $datesave); 
$totol = implode(",", $totol); 
mysqli_close($con);?>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.bundle.js"></script>



 <!--devbanban.com-->

<canvas id="myChart" width="700px" height="200px"></canvas>
<script>
var ctx = document.getElementById("myChart").getContext('2d');
var myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: [<?php echo $datesave;?>  //event แกนx
    
        ],
        datasets: [{
            label: 'ค่าเฉลื่ยอุณหภูมิรายชั่วโมงต่อวัน',
            data: [<?php echo $totol;?>      //temp แกนy
            ],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                }
            }]
        }
    }
});
</script>  
  <!--devbanban.com-->
</html>
