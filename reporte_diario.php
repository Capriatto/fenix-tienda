<?php
require('fpdf17/fpdf.php');
$pdf=new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',10);
$pdf->Image('img/logo.jpg',10,8,33);


$pdf->SetFont('times','B',10);
$pdf->Cell(80);
$pdf->Cell(30,10,'REPORTE DIARIO');
$pdf->Ln(20);
$pdf->Cell(30,7,"CODIGO");
$pdf->Cell(20,7,"BASE");
$pdf->Cell(30,7,"TOTAL DIA");
$pdf->Cell(20,7,"GASTOS");
$pdf->Cell(30,7,"INVERSIONES");
$pdf->Cell(30,7,"VENTAS");
$pdf->Cell(30,7,"FECHA");
$pdf->Ln();
$pdf->Cell(450,7,"----------------------------------------------------------------------------------------------------------------------------------------------------------------------");
$pdf->Ln();

        require ('conexion.php');
        $sql = "SELECT codigo, base, total_dia, gastos, inversiones, ventas, fecha FROM diario WHERE 			YEAR(`fecha`) = YEAR(CURRENT_DATE()) AND MONTH(`fecha`)=".$_REQUEST['m'].';';
        
		$sql2 = "SELECT SUM(valor) FROM gasto";
		$result = mysql_query($sql);
		$result2= mysql_query($sql2);	
        while($rows=mysql_fetch_array($result))
        {
            $codigo = $rows[0];
			$base= $rows[1];
            $total_dia = $rows[2];
            $gastos = $rows[3];
			$inversiones = $rows[4];
            $ventas= $rows[5];
			$fecha= $rows[6];
			
            $pdf->Cell(30,7,$codigo);
			$pdf->Cell(20,7,$base);
            $pdf->Cell(30,7,$total_dia);
            $pdf->Cell(20,7,$gastos);
			$pdf->Cell(30,7,$inversiones);
			$pdf->Cell(30,7,$ventas);
			$pdf->Cell(30,7,$fecha);
			
            $pdf->Ln(); 
        }
		
$pdf->Output();
?>