<?php
error_reporting( ~E_NOTICE );
 include 'db_conection.php';
include "class.upload.php";

if(isset($_FILES["name"])){
	$up = new Upload($_FILES["name"]);
	if($up->uploaded){
		$up->Process("./uploads/");
		if($up->processed){
            /// leer el archivo excel
            require_once '../PHPExcel/Classes/PHPExcel.php';
            $archivo = "uploads/".$up->file_dst_name;
            $inputFileType = PHPExcel_IOFactory::identify($archivo);
            $objReader = PHPExcel_IOFactory::createReader($inputFileType);
            
     
                 $objPHPExcel = $objReader->load($archivo);
           
             try {
                     $sheet = $objPHPExcel->getSheet(0);
            
             } catch (Exception $e) {
                   	$time = time();

                    $date= date("d-m-Y (H:i:s)", $time);
                    $mensaje='Formato Errado H1:'.$date;
                	$sql2 ="UPDATE mensajes SET Mensaje='$mensaje'";
                	$dbcon->query($sql2);
                	unlink($archivo);
                	$dbcon->close();
                    echo "<script>
                    window.location = './cargamasivaconfirmacion.php';
                    </script>
                    ";
            } finally {
	             
                 //	 echo   	$sql2  .'<BR>';
    
            }
            
            
            
            
            $highestRow = $sheet->getHighestRow();
            $highestColumn = $sheet->getHighestColumn();
            $marcaanterior = 0;
            $rp=0;
            $rpl=0;
            $estatus='pendienteC';
            
            for ($row = 3; $row <= $highestRow; $row++){ 
               //   echo $row .'-';
                $x_Nropedido = $sheet->getCell("A".$row)->getValue();
                $x_id = $sheet->getCell("B".$row)->getValue();
                $x_items_name = $sheet->getCell("C".$row)->getValue();
                $x_meta1 = $sheet->getCell("E".$row)->getValue();
                $x_meta2 = $sheet->getCell("D".$row)->getValue();

                if (empty($x_meta1)) //significa si está vacio
                { 
                    $x_meta1=0;
                    }
                
                
                if ($x_items_name != ''){
                    
                  $rp=$rp+1;
                  $rpl=$rpl+$x_meta1;
                  
        
                
                //  echo  $sql1 .'<BR>';
                  
                  $sql = "INSERT INTO `inventorydetails`(`id_items`, `order_name`, `order_quantity`, `nropedido`,order_status) VALUES  ";
                  $sql .= " (\"$x_id\",\"$x_items_name\",\"$x_meta1\",\"$x_Nropedido\",\"$estatus\")";
                 
                  
                  $dbcon->query($sql);

                  $sql = "UPDATE
                  items
                     INNER JOIN inventorydetails ON inventorydetails.order_name = items.item_Name AND inventorydetails.order_status = 'pendienteC'
                      SET
                           items.cantres = items.cantres - inventorydetails.order_quantity";
                     $dbcon->query($sql);

                    // actualiza cantidad despachada y cierra orden
                     $sql = "UPDATE
                            orderdetails
                        INNER JOIN inventorydetails ON inventorydetails.id_items = orderdetails.order_id AND inventorydetails.order_status = 'pendienteC'
                        SET
                            orderdetails.orden_qtyc = inventorydetails.order_quantity,
                            orderdetails.order_status = 'Ordered_Finished'";
                     $dbcon->query($sql);





               $sql = "update inventorydetails set order_status='procesadoC' where order_status='pendienteC'";
               $dbcon->query($sql);

           
                }
            }
            
             
            
            
            
            
    	unlink($archivo);
    	
    	
    	
    	$time = time();

        $date= date("d-m-Y (H:i:s)", $time);
    	$mensaje='Nro Registos  : '.$rp. ' Unidades : ' .$rpl. ' Fecha : ' .$date;
    	$sql2 ="UPDATE mensajes SET Mensaje='$mensaje'";
    
    	$dbcon->query($sql2);
    	
        }	

}
}
$dbcon->close();
echo "<script>
window.location = './cargamasivaconfirmacion.php';
</script>
";
?>