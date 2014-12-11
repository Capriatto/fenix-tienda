<?php
require('fpdf17/fpdf.php');
$pdf=new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',10);
$pdf->Image('img/logo.jpg',10,8,33);


$pdf->SetFont('times','B',10);
$pdf->Cell(80);
$pdf->Cell(30,10,'GASTOS');
$pdf->Ln(20);
$pdf->Cell(25,7,"CODIGO");
$pdf->Cell(35,7,"TIPO GASTO");
$pdf->Cell(95,7,"OBSERVACION");
$pdf->Cell(20,7,"FECHA");
$pdf->Cell(40,7,"VALOR");
$pdf->Ln();
$pdf->Cell(450,7,"----------------------------------------------------------------------------------------------------------------------------------------------------------------------");
$pdf->Ln();

        require ('conexion.php');
		
        $sql = "SELECT g.codigo, tg.nombre , g.observacion, g.fecha, g.valor FROM gasto g, tipo_gasto tg 		WHERE g.tipo_gasto_codigo= tg.codigo and YEAR(`fecha`) = YEAR(CURRENT_DATE()) AND MONTH(`fecha`) 		=".$_REQUEST['m'].";";

        $sql2 = "SELECT SUM(valor) FROM gasto WHERE YEAR(`fecha`) = YEAR(CURRENT_DATE()) AND 					MONTH(`fecha`)=".$_REQUEST['m'].";";
		$result = mysql_query($sql);
		$result2= mysql_query($sql2);	
        while($rows=mysql_fetch_array($result))
        {
            $codigo = $rows[0];
			$tipo_gasto= $rows[1];
            $observacion = $rows[2];
            $fecha = $rows[3];
			$valor = $rows[4];
            
            $pdf->Cell(25,7,$codigo);
			$pdf->Cell(35,7,$tipo_gasto);
            $pdf->Cell(95,7,$observacion);
            $pdf->Cell(20,7,$fecha);
			$pdf->Cell(40,7,$valor);
           
            $pdf->Ln(); 
        }
		while($rows=mysql_fetch_array($result2))
        {
			$pdf->Ln(20); 
			$pdf->Cell(40,10,"----------------------------------------------------------------------------------------------------------------------------------------------------------------------");
			$pdf->Cell(102);
			$suma_total = $rows[0];
			$pdf->Cell(32,30,"TOTAL GASTOS: ");
			$pdf->Cell(50,30,$suma_total);
		}
$pdf->Output();
?>