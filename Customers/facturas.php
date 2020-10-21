<?php
session_start();
$razsoc=$_SESSION['razsoc'] ;
      
        $direccion =  $_SESSION['direccion'] ;
        $ciudad =  $_SESSION['ciudad'];
        $pais =   $_SESSION['pais'] ;
        $telefono =  $_SESSION['telefono'];
        $correo =  $_SESSION['correo'];
        $rut=$_SESSION['rut'] ;
        $iva=$_SESSION['iva'] ;
$id_factura = $_GET["id_factura"];
require('db_conection.php');

$sql="SELECT
    `order_date`,
    users.user_firstname,
    users.user_lastname,
    users.user_address,
    users.user_email
FROM
    `orderdetails`,
    users
WHERE
    nropedido = $id_factura AND orderdetails.user_id = users.user_id
LIMIT 1";



$nombre_cliente = $razsoc;
$apellidos_cliente = "apellidos_cliente";
$direccion_cliente = "direccion_cliente";
$poblacion_cliente ="poblacion_cliente";
$provincia_cliente = "provincia_cliente";
$codigo_postal_cliente ="codigo_postal_cliente";
$identificacion_fiscal_cliente ="identificacion_fiscal_cliente";
$correocliente="correocliente";
$fecha_factura=date("d-m-Y");
$resultado = $dbcon->query($sql);

    if ($resultado->num_rows>0) {
       $cont=0;
       while ($fila = $resultado->fetch_assoc()) {
        $nombre_cliente = $fila['user_firstname'];
        $apellidos_cliente =  $fila['user_lastname'];
        $direccion_cliente =  $fila['user_address'];
        $fecha_factura   =  $fila['order_date'];
        $correocliente=$fila['user_email'];
            }
    }
//Recibir detalles de factura



//Recibir los datos de la empresa
$nombre_tienda = $razsoc;
$direccion_tienda =$direccion ;
$poblacion_tienda =$ciudad ;
$provincia_tienda =   $pais;
$codigo_postal_tienda = "codigo_postal_tienda";
$telefono_tienda = $telefono;
$fax_tienda = "fax_tienda";
$identificacion_fiscal_tienda =  $rut;

//Recibir los datos del cliente

//Recibir los datos de los productos

$gastos_de_envio = 0;

//variable que guarda el nombre del archivo PDF
$archivo="factura-$id_factura.pdf";

//Llamada al script fpdf
require('fpdf.php');


$archivo_de_salida=$archivo;

//$pdf=new FPDF();  //crea el objeto

$pdf=new FPDF('P','mm',array(120,300));
$pdf->AddPage();  //a�adimos una p�gina. Origen coordenadas, esquina superior izquierda, posici�n por defeto a 1 cm de los bordes.


//logo de la tienda
//$pdf->Image('../empresa.jpg' , 0 ,0, 40 , 40,'JPG', 'http://php-estudios.blogspot.com');

// Encabezado de la factura
$pdf->SetFont('Arial','B',14);
$pdf->Cell(110, 10, "RUT : ". $identificacion_fiscal_tienda, 0, 2, "J");
$pdf->Cell(110, 10, "BOLETA ELECTRONICA", 0, 2, "J");
$pdf->SetFont('Arial','B',10);
$pdf->MultiCell(110,5, "Numero: $id_factura"."\n"."Fecha: $fecha_factura", 0, "J", false);
$pdf->Ln(2);
$pdf->MultiCell(100, //posici�n X
5, //posici�n Y
utf8_decode($nombre_tienda."\n".
"Direccion: ".utf8_decode($direccion_tienda)."\n".
"Cliente : ".$nombre_cliente.' '.$apellidos_cliente."\n".
"Correo : ".$correocliente."\n".
"Direccion Cliente: ".$direccion_cliente ),

 1, // bordes 0 = no | 1 = si
 "J", // texto justificado 
 false);

 

$pdf->Ln(2);


$pdf->Ln(1);




$pdf->SetFont('Arial','',8);
//Creaci�n de la tabla de los detalles de los productos productos
$top_productos = 85;
    $pdf->SetXY(10, $top_productos);
    $pdf->Cell(40, 5, 'Items', 0, 1, 'J');
    $pdf->SetXY(49, $top_productos);
    $pdf->Cell(40, 5, 'Cantidad', 0, 1, 'J');
    $pdf->SetXY(65, $top_productos);
    $pdf->Cell(40, 5, 'Precio Unitario', 0, 1, 'J');  
    $pdf->SetXY(100, $top_productos);
    $pdf->Cell(40, 5, 'Total', 0, 1, 'J');    
 //BD el parametro sera el numero de pedido
 
 $sql="SELECT `order_name`, `order_price`, `order_quantity`, `order_total`, `order_status`, `order_date`, `nropedido` FROM `orderdetails` where nropedido =$id_factura";
 
 $resultado = $dbcon->query($sql);
 $y = 90; 
 $iva1=$iva / 100;
 $iva1=$iva1+1;
     if ($resultado->num_rows>0) {
        $cont=0;
        while ($fila = $resultado->fetch_assoc()) {
            $pdf->SetFont('Arial','',6);
            $pdf->SetXY(10, $y);
            $pdf->Cell(40, 5, $fila['order_name'], 0, 1, 'J');
            $pdf->SetFont('Arial','',8);
            $pdf->SetXY(55, $y);
            $pdf->Cell(40, 5,$fila['order_quantity'], 0, 1, 'J');
            $pdf->SetXY(65, $y);
            $pdf->Cell(20, 5,number_format( $fila['order_price']/$iva1, 2, ",", ".")." ", 0, 1, 'R');
            $pdf->SetXY(95, $y);
            $pdf->Cell(20, 5, number_format($fila['order_total']/$iva1, 2, ",", ".")." ", 0, 1, 'R');

            $pdf->SetXY(105, $y);
           // $pdf->Cell(40, 5, $y, 0, 1, 'J');
            $y = $y + 4;
            $cont=$cont+1;
            $x= $pdf->GetY();
            if ($x==258){
               
                $pdf->AddPage();
                $y=0;
                $cont=0;
            }

        }
        $x= $pdf->GetY();
      //  $pdf->Cell(40, 5, $x, 0, 1, 'J');
        if ($x>=252){
               
            $pdf->AddPage();
            $y=0;
            $cont=0;
        }
        $sql="select sum(order_quantity) as tcantidad , sum(order_total) as totalx from orderdetails where nropedido =$id_factura";
        $resultado = $dbcon->query($sql);
       
        $totalvalor=999999999;
        $totalunidad=999999999;
    if ($resultado->num_rows>0) {
       $fila = $resultado->fetch_assoc();  
         $totalunidad= $fila['tcantidad'];
          $totalvalor= $fila['totalx'];
        }
    }   
        

// echo   $nrof; 
 
 $dbcon->close();
 $pdf->SetFont('Arial','B',8);
 $y = $y + 5;

 $pdf->SetXY(51, $y);
 $pdf->Cell(40, 5,$totalunidad, 0, 1, 'J');

 
 $totalvalor=$totalvalor/$iva1;
 $pdf->SetXY(95, $y);
 $pdf->Cell(20, 5, number_format($totalvalor, 2, ",", ".")." ", 0, 1, 'R');
 
 $y = $y + 5;
 $precio_subtotal = $totalvalor;
 $add_iva = $precio_subtotal * $iva / 100;
 $pdf->SetXY(51, $y);
 $pdf->Cell(40, 5,$iva." %", 0, 1, 'J');

 $pdf->SetXY(95, $y);
 $pdf->Cell(20, 5, number_format( $add_iva, 2, ",", ".")." ", 0, 1, 'R');

 $y = $y + 5;
 
 $precio_subtotal = $totalvalor;

 $add_iva = $precio_subtotal * $iva / 100;
 $pdf->SetXY(51, $y);
 $pdf->Cell(40, 5,"Gasto Envio", 0, 1, 'J');

 $pdf->SetXY(95, $y);
 $pdf->Cell(20, 5, number_format( $gastos_de_envio, 2, ",", ".")." ", 0, 1, 'R');

 $total_mas_iva = round($precio_subtotal + $add_iva + $gastos_de_envio, 2);

 $y = $y + 5;

 $pdf->SetXY(51, $y);
 $pdf->Cell(40, 5,"Total", 0, 1, 'J');

 $pdf->SetXY(95, $y);
 $pdf->Cell(20, 5, number_format($total_mas_iva , 2, ",", ".")." ", 0, 1, 'R');
 // hasta aqui
 $y = $y + 5;
$x= $pdf->GetY();
$pdf->SetXY(1, $y);
//$pdf->Cell(40, 5, $x, 0, 1, 'J');
if ($x>=215){
               
    $pdf->AddPage();
    $y=0;
    $cont=0;
}
//$pdf->Cell(40, $x,"posicion ".$x, 0, 1, 'J');
 //$pdf->Image('pdf417.png' , 5 ,$x, 120 ,90,'PNG', '');

 $x= $pdf->GetY();







$pdf->Image('pdf417.png' , 5 ,$x, 120 ,90,'PNG', '');

$pdf->Output($archivo_de_salida);//cierra el objeto pdf

//Creacion de las cabeceras que generar�n el archivo pdf
header ("Content-Type: application/download");
header ("Content-Disposition: attachment; filename=$archivo");
header("Content-Length: " . filesize("$archivo"));
$fp = fopen($archivo, "r");
fpassthru($fp);
fclose($fp);

//Eliminaci�n del archivo en el servidor
unlink($archivo);
?>