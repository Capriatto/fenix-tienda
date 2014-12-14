<?php
require('fpdf17/fpdf.php');
if(isset($_REQUEST['m'])){
$pdf=new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',10);
$pdf->Image('img/logo.jpg',10,8,33);


$pdf->SetFont('times','B',10);
$pdf->Cell(80);
$pdf->Cell(30,10,'CREDITOS');
$pdf->Ln(20);
$pdf->Cell(25,7,"CODIGO");
$pdf->Cell(140,7,"NOMBRE CLIENTE");
$pdf->Cell(40,7,"DEUDA");
$pdf->Ln();
$pdf->Cell(450,7,"----------------------------------------------------------------------------------------------------------------------------------------------------------------------");
$pdf->Ln();
		
        require ('conexion.php');
		$sql = "SELECT codigo,nombre,total_deuda FROM cliente WHERE total_deuda <> 0";
        $sql2 = "SELECT SUM(total_deuda) FROM cliente";
		$result = mysql_query($sql);
		$result2= mysql_query($sql2);	
        while($rows=mysql_fetch_array($result))
        {
            $codigo = $rows[0];
            $nombre = $rows[1];
            $total_deuda = $rows[2];
            
            $pdf->Cell(25,7,$codigo);
            $pdf->Cell(140,7,$nombre);
            $pdf->Cell(40,7,$total_deuda);
           
            $pdf->Ln(); 
        }
		while($rows=mysql_fetch_array($result2))
        {
			$pdf->Ln(20); 
			$pdf->Cell(40,10,"----------------------------------------------------------------------------------------------------------------------------------------------------------------------");
			$pdf->Cell(89);
			$suma_total = $rows[0];
			$pdf->Cell(35,30,"TOTAL DEUDA: ");
			$pdf->Cell(50,30,$suma_total);
		}
$pdf->Output();
}else{
header("Location: reportes.php");
}
?>