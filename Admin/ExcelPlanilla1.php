<?php

  include 'db_conection.php';
 
	require_once '../PHPExcel/Classes/PHPExcel.php';
	// Creamos un objeto PHPExcel
	$objPHPExcel = new PHPExcel();
	$objReader = PHPExcel_IOFactory::createReader('Excel2007');
	$objPHPExcel = $objReader->load('PlantillaCargainventariosPreciosEstatus.xlsx');
	// Indicamos que se pare en la hoja uno del libro
	$objPHPExcel->setActiveSheetIndex(0);
	
$query="SELECT `item_id`, `item_name`, `candisp`, `cantres`,`item_price` ,`estatus` FROM `items` order by item_id ";
	
	

	
	 $resultado = $dbcon->query($query);
	 $I=3;
		while ($fila = $resultado->fetch_assoc()) {
			
		      
		    
		    
		    
		   
		    $objPHPExcel->getActiveSheet()->SetCellValue('A'.$I, $fila['item_id']);
        	$objPHPExcel->getActiveSheet()->SetCellValue('B'.$I,  $fila['item_name']);
        	$objPHPExcel->getActiveSheet()->SetCellValue('C'.$I,  $fila['candisp']);
        	
        
        	$objPHPExcel->getActiveSheet()->SetCellValue('D'.$I, $fila['cantres']);
        	
            $objPHPExcel->getActiveSheet()->SetCellValue('G'.$I, $fila['item_price']);
            $e='A';
            if ($fila['estatus']==0){
                $e='D';
            }
             $objPHPExcel->getActiveSheet()->SetCellValue('I'.$I, $e);
        	
        	$I=$I+1;
        	
		    
		}
		
		
		    $objPHPExcel->getActiveSheet()->getProtection()->setPassword('password');
		//	$objPHPExcel->getActiveSheet()->protectCells('A1:D222000', 'password');
        	$objPHPExcel->getActiveSheet()->getProtection()->setSheet(true);
	//Modificamos los valoresde las celdas A2, B2 Y C2
	
		
	//Guardamos los cambios
	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	$objWriter->save("Plantilla_Carga_Inventarios_Prc_Estatus.xlsx");
	
	
	
	$salida=	"Descargue Planilla";
	
	$close = mysqli_close($dbcon);
	echo $salida; 
?>