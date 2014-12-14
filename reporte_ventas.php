<?php
require('fpdf17/fpdf.php');
if(isset($_REQUEST['m'])){
$pdf=new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',10);
$pdf->Image('img/logo.jpg',10,8,33);


$pdf->SetFont('times','B',10);
$pdf->Cell(80);
$pdf->Cell(30,10,'REPORTE VENTAS');
$pdf->Ln(20);
$pdf->Cell(60);
$pdf->Cell(30,7,"CODIGO");
$pdf->Cell(30,7,"VENTAS");
$pdf->Cell(30,7,"FECHA");

$pdf->Ln();
$pdf->Cell(40,10,"----------------------------------------------------------------------------------------------------------------------------------------------------------------------");
$pdf->Ln();

        require ('conexion.php');
        $sql = "SELECT codigo, ventas, fecha FROM diario WHERE YEAR(`fecha`) = YEAR(CURRENT_DATE()) AND 		MONTH(`fecha`)=".$_REQUEST['m'].';';
        
		$sql2 = "SELECT SUM(ventas) FROM diario WHERE YEAR(`fecha`) = YEAR(CURRENT_DATE()) AND 					MONTH(`fecha`)=".$_REQUEST['m'].';';
		$result = mysql_query($sql);
		$result2= mysql_query($sql2);	
        while($rows=mysql_fetch_array($result))
        {
            $codigo = $rows[0];
			$ventas= $rows[1];
            $fecha = $rows[2];
            
			$pdf->Cell(60);
            $pdf->Cell(33,7,$codigo);
			$pdf->Cell(25,7,$ventas);
			$pdf->Cell(30,7,$fecha);
			
            $pdf->Ln(); 
        }
		
		while($rows=mysql_fetch_array($result2))
        {
			$pdf->Ln(10); 
			$pdf->Cell(40,10,"----------------------------------------------------------------------------------------------------------------------------------------------------------------------");
			$pdf->Cell(21);
			$suma_total = $rows[0];
			$pdf->Cell(32,30,"TOTAL VENTAS: ");
			$pdf->Cell(10,30,$suma_total);
		}
		
$pdf->Output();
}else{
header("Location: reportes.php");
}
?>