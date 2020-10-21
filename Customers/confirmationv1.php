<?php
if (!empty($_REQUEST)) {


$product_no = $_REQUEST['item_name1']; // ID del producto
$product_transaction = $_REQUEST['txn_id']; // ID de transacci贸n Paypal
$product_price = $_REQUEST['mc_gross']; // Monto recibido Paypal
//$product_currency = $_REQUEST['cc']; // Moneda recibida de Paypal
$product_status = $_REQUEST['payment_status']; // Estado del producto Paypal
if ($product_status=='done'){

            $dbcon=new mysqli("localhost","root","","servido2_store"); //servidor, usuario de base de datos, contrase帽a del usuario, nombre de base de datos
            $sql="update orderdetails set order_status='Ordered' ,txnid='$product_transaction' where  nropedido=$product_no";
            $resultado = $dbcon->query($sql);
            $dbcon->close();}
        
  }
  ?>