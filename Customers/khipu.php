<?php

$concept =$_GET['concept'];
$amount = $_GET['amt']; 
$con=new mysqli("localhost","root","","servido2_store"); //servidor, usuario de base de datos, contraseña del usuario, nombre de base de datos
if($con->connect_error){
           die("Connection failed: " . $con->connect_error);
                }
$sql="SELECT  idkhipus, keykhipus  FROM cia";



$resultado = $con->query($sql);

if ($resultado->num_rows>0) {
	        while ($fila1 = $resultado->fetch_assoc()) {
	            
	            $idkhipus=$fila1['idkhipus']; 
	            $keykhipus =$fila1['keykhipus'];
	            }
}
include "encriptar.php";
$concept = $_GET['concept'];
$resultado = str_replace(" ", "+",$concept);
$concept =$resultado;
$nrof=$concept;
$dato_encriptadof = $desencriptar($nrof);
$concept = $dato_encriptadof;
$pedido=$concept;
$resultado = str_replace(" ", "+",$amount);
    $amount =$resultado;
    $totalvalor=$amount;
    $dato_encriptadom = $desencriptar($totalvalor);
    $amount = $dato_encriptadom; 

$monto=$amount;



$setSecret=$keykhipus;
$setReceiverId=$idkhipus;



require 'autoload.php';

$c = new Khipu\Configuration();
$c->setSecret($setSecret);
$c->setReceiverId($setReceiverId);
//$c->setDebug(true);



$cl = new Khipu\ApiClient($c);

$exp = new DateTime();
$exp->setDate(2020, 11, 3);

$kh = new Khipu\Client\PaymentsApi($cl);
$urlc="https://www.servidordeprueba.com/store/Customers/cart_itemsc.php?id_factura=".$concept;

echo $urlc;

try {
    $opts = array(
        "transaction_id"=>$pedido,
    	"expires_date" => $exp,
        "body" => "Numero de Orden : " .$pedido,
        "return_url" => "https://servidordeprueba.com/store/Customers/indexk.php",
        "cancel_url" => $urlc,
        "picture_url" => "https://servidordeprueba.com/khipu/gestionc.jpg",
        "notify_url" => "https://servidordeprueba.com/store/Customers/verificark.php",   
        "notify_api_version" => "1.3"
    );
    $resp = $kh->paymentsPost("Pago Orden ", "CLP", $monto, $opts);
    print_r($resp);
    print_r("---Separacion---");
    $r2 = $kh->paymentsIdGet($resp->getPaymentId());
    print_r($r2);
    $payment_id=$resp->getpaymentid();
    $payment_url=$resp->getpaymenturl();
    $amount=$r2->getamount();
    $nropedido=$pedido;
    $notification_token=$r2->getnotificationtoken();
    $status=$r2->getstatus();
    


  
                $insertar = "INSERT INTO `tablakhipus`(
    `payment_id`,
    `amount`,
    `nropedido`,
    `payment_url`,
    `notification_token`,
    `status`
)
VALUES('$payment_id',$amount, $nropedido,'$payment_url','$notification_token','$status')";
                     $resultado = mysqli_query($con, $insertar);
      $close = mysqli_close($con);
    
    header ("Location:" .$payment_url);
    
} catch(Exception $e) {
    echo $e->getMessage();
}
    


?>