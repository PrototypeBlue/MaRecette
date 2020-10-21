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
                    window.location = './cargamasivaitems.php';
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
           
            $Regestatus=0;
            $Regprecios=0;
            for ($row = 3; $row <= $highestRow; $row++){ 
               //   echo $row .'-';
                $x_id = $sheet->getCell("A".$row)->getValue();
                $x_items_name = $sheet->getCell("B".$row)->getValue();
                $x_meta1 = $sheet->getCell("F".$row)->getValue();
                
                $x_meta2 = $sheet->getCell("E".$row)->getValue();
                
                 $np = $sheet->getCell("H".$row)->getValue();
                 
                
                 $ne = $sheet->getCell("J".$row)->getValue();
                 
                //--------------------------------------------------------------------------------------------------------------------------------------
                
                 $sqla="UPDATE `items` SET ";
                 $sw=0;
                 if ($ne!=''){
                       $Regestatus=$Regestatus+1;
                       $sw=1;
                       $ne = strtoupper($ne);
                       $e=1;
                       if ($ne=='D'){
                           $e=0;
                       }
                       
                       
                       $sqla=$sqla."`estatus`=".$e;
                 }
                 
                 
                 if ($np!=''){
                     $Regprecios=$Regprecios+1;
                      $np = str_replace(",",".",$np);
                      if ($sw==1) {
                        $sqla=$sqla.",  `item_price`=".$np;
                          
                      }  
                      else
                      {
                               $sqla=$sqla."`item_price`=".$np;
                                
                          
                      }
                       $sw=1;
                 }
	
                 
                 
                 
                 
                 
                if($sw==1){
                    $sqla=$sqla.' Where item_id='.$x_id;
                    
                     $dbcon->query($sqla);
                }
                
             
                
                //--------------------------------------------------------------------------------------------------------------------------------------
                
                
                if (empty($x_meta1)) //significa si está vacio
                { 
                    $x_meta1=0;
                    }
                
                
                if ($x_meta1 > 0){
                    
                  $rp=$rp+1;
                  $rpl=$rpl+$x_meta1;
                  
        
                
                //  echo  $sql1 .'<BR>';
                  
                  $sql = "INSERT INTO `inventorydetails`(`id_items`, `order_name`, `order_quantity`, `nropedido`) VALUES  ";
                  $sql .= " (\"$x_id\",\"$x_items_name\",\"$x_meta1\",\"$x_meta2\")";
                 
                  
                  $dbcon->query($sql);

                  $sql = "UPDATE items
                  INNER JOIN
                        inventorydetails ON inventorydetails.id_items= items.item_id and inventorydetails.order_status='pendiente' 
                         SET    items.candisp=items.candisp+inventorydetails.order_quantity";
                     $dbcon->query($sql);


                  $sql = "update inventorydetails set order_status='procesado' where order_status='pendiente'";
               

           
                }
            }
            
             
            
            
            
            
    	unlink($archivo);
    	
    	
    	
    	$time = time();

        $date= date("d-m-Y (H:i:s)", $time);
    	$mensaje='Nro Reg Invent : '.$rp. ' Unid : ' .$rpl.' Nro Reg Cambio Est : '.$Regestatus.  ' Nro Reg Cambio Prc : ' .$Regprecios.  ' Fecha : ' .$date;
    	$sql2 ="UPDATE mensajes SET Mensaje='$mensaje'";
    
    	$dbcon->query($sql2);
    	
        }	

}
}


$dbcon->close();
echo "<script>
window.location = './cargamasivaitems.php';
</script>
";
?>