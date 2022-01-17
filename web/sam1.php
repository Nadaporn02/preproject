<?php
$day = $_GET['day'];
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test";
 
 $conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
 
if(isset($_GET['export'])){
if($_GET['export'] == 'true'){
$sql = "SELECT  `event`, `Temp`, `Door`, `Current` FROM `error` WHERE DATE(event)='".$day."' ";    
$query = mysqli_query($conn,$sql); // Get data from Database from demo table
 
 
    $delimiter = ",";
    $filename = "significant_" . date('Ymd') . ".csv" ; // Create file name
     
    //create a file pointer
    $f = fopen('php://memory', 'w'); 
     
    //set column headers
    $fields = array('Temp', 'Door', 'Current', 'event');
    fputcsv($f, $fields, $delimiter);
     
    //output each row of the data, format line as csv and write to file pointer
    while($row = $query->fetch_assoc() ){
        
        $lineData = array($row['Temp'], $row['Door'], $row['Current'], $row['event']);
        fputcsv($f, $lineData, $delimiter);
    }
     
    //move back to beginning of file
    fseek($f, 0);
     
    //set headers to download file rather than displayed
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="' . $filename . '";');
     
    //output all remaining data on a file pointer
    fpassthru($f);
 
 }
}
?>