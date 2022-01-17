<?php
$con = mysqli_connect('localhost','root','');
if(!$con)
    echo "not connect";

if(!mysqli_select_db($con,'test'))
{
    echo "Database Not Selected";
}

$sql = "select * from error WHERE 1 ORDER BY id DESC";

$records = mysqli_query($con,$sql);

require("fpdf/fpdf.php");
$pdf = new FPDF('p','mm','A4');
$pdf->AddPage();
$pdf->SetFont('Arial','B',14);

$pdf->cell(20,10,"id", 1, 0, 'C');
$pdf->cell(35,10,"Temp", 1, 0, 'C');
$pdf->cell(35,10,"Door", 1, 0, 'C');
$pdf->cell(35,10,"Current", 1, 0, 'C');
$pdf->cell(60,10,"Date", 1, 1, 'C');


while($row = mysqli_fetch_array($records))
{
    $pdf->cell(20,10,$row["id"], 1, 0, 'C');
    $pdf->cell(35,10,$row["Temp"], 1, 0, 'C');
    $pdf->cell(35,10,$row["Door"], 1, 0, 'C');
    $pdf->cell(35,10,$row["Current"], 1, 0, 'C');
    $pdf->cell(60,10,$row["event"], 1, 1, 'C');
}
$pdf->OutPut();

?>