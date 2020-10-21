<?php

include("db_conection.php");

$sql="SELECT
    nropedido,
    SUM(order_quantity) AS tqty,
    SUM(order_total) AS Torder
FROM
    `orderdetails`
WHERE
    order_status <> 'pending' AND bolelec = 0 AND nropedido <> 0
GROUP BY
    nropedido
ORDER BY
    nropedido,
    order_id";



$resultado = $dbcon->query($sql);

if ($resultado->num_rows>0) {
	        while ($fila1 = $resultado->fetch_assoc()) {
	            $pedidoa=$fila1['nropedido'];
	            $total=$fila1['Torder'];
	            $tqty=$fila1['tqty'];
		     
		      $sql="SELECT
			    *
			FROM
			    `orderdetails`
			WHERE
			    nropedido=$pedidoa
			ORDER BY   order_id ";
			
			    $resultado1 = $dbcon->query($sql);
			    $nfile='E096920840T039F0000'.$pedidoa.'.txt';
			 
			    $archivo = fopen($nfile,'w');
			    $sw=0;
			    $cont=1;
	      		 while ($fila = $resultado1->fetch_assoc()) {
	      			if ($sw==0)	  { $sw=1;
	      			   $hora = date("H", $fila['order_date']);
	      			   $hora=$fila['order_date'];
	      			   $fecha = date("Y-m-d ", $fila['order_date']);
	      			   $fecha=$fila['order_date'];
	      			   $datos='A0;001 -'.$hora.';;'.$fila['txnid'].';;;;;TITANIUM;Av Vitacura 2874 Local 103-A;;';
	      			   fwrite($archivo,$datos . PHP_EOL);
	      			   $datos='A;39;1.0;'.$pedidoa.';'.$fecha.';;;;;'.$fecha.';96920840-7;CELA COSMETICOS S.A;IMPORT Y EXPORT DE PRODUCTOS COSMETICOS;;Av Vitacura 2874 Local 103-A;Santiago;Las Condes;66666666-6;;CLIENTE BOLETA;;NO INFORMADO;SANTIAGO;SANTIAGO;;;;;;;'.$total.';;;;;';
                       fwrite($archivo,$datos . PHP_EOL);
	      			  }
	      			   $datos='B;'.$cont.';;'.$fila['order_name'].';;'.$fila['order_quantity'].';;'.$fila['order_price'].';'.$fila['order_total'];
	      		
	      				 fwrite($archivo,$datos . PHP_EOL);
			           $cont++;
			 
	                         }
	                 fclose($archivo);
	            
	           
	    }
	
	  
     $sql="UPDATE  `orderdetails` set bolelec = 1 WHERE     order_status <> 'pending' AND bolelec = 0 AND nropedido <> 0" ;
     $dbcon->query($sql);
}
$dbcon->close();
?>