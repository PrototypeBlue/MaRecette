<?php

  include 'db_conection.php';
 
	require_once '../PHPExcel/Classes/PHPExcel.php';
	// Creamos un objeto PHPExcel
	$objPHPExcel = new PHPExcel();
	$objReader = PHPExcel_IOFactory::createReader('Excel2007');
	$objPHPExcel = $objReader->load('PlantillaCargaPicking.xlsx');
	// Indicamos que se pare en la hoja uno del libro
	$objPHPExcel->setActiveSheetIndex(0);


	$query="SELECT nropedido FROM `orderdetails` WHERE order_status='Ordered' ORDER BY `nropedido` desc limit 1";
	$resultado = $dbcon->query($query);
	 $nroped=99999999;
		while ($fila = $resultado->fetch_assoc()) {
			$nroped=$fila['nropedido'];
		}
	
$query="SELECT `order_id`, `order_name`,  `order_quantity`,  `nropedido` FROM `orderdetails` WHERE order_status='Ordered' and nropedido<=$nroped order by nropedido,order_id ";
	
	

	
	 $resultado = $dbcon->query($query);
	 $I=3;
		while ($fila = $resultado->fetch_assoc()) {
			
		      
		    
		    
		    
		   
		    $objPHPExcel->getActiveSheet()->SetCellValue('A'.$I, $fila['nropedido']);
        	$objPHPExcel->getActiveSheet()->SetCellValue('B'.$I,  $fila['order_id']);
        	$objPHPExcel->getActiveSheet()->SetCellValue('C'.$I,  $fila['order_name']);
        	
        
        	$objPHPExcel->getActiveSheet()->SetCellValue('D'.$I, $fila['order_quantity']);
        	
            $objPHPExcel->getActiveSheet()->SetCellValue('E'.$I, $fila['order_quantity']);
        	
        	$I=$I+1;
        	
		    
		}
		
		
		    $objPHPExcel->getActiveSheet()->getProtection()->setPassword('password');
		//	$objPHPExcel->getActiveSheet()->protectCells('A1:D222000', 'password');
        	$objPHPExcel->getActiveSheet()->getProtection()->setSheet(true);
	//Modificamos los valoresde las celdas A2, B2 Y C2
	
		
	//Guardamos los cambios
	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	$objWriter->save("Plantilla_Carga_Picking.xlsx");
	
	$query="Update orderdetails set  order_status='Picking'  WHERE order_status='Ordered' and nropedido<=$nroped ";
    $dbcon->query($query);
	
	$salida=	"Descargue Planilla";
	


	$close = mysqli_close($dbcon);
	echo $salida; 
?>