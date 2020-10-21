<?php
if (!empty($_REQUEST)) {


$product_no = $_REQUEST['item_name1']; // ID del producto
$product_transaction = $_REQUEST['txn_id']; // ID de transacción Paypal
$product_price = $_REQUEST['mc_gross']; // Monto recibido Paypal
//$product_currency = $_REQUEST['cc']; // Moneda recibida de Paypal
$product_status = $_REQUEST['payment_status']; // Estado del producto Paypal

//print "<pre>"; print_r($_REQUEST); print "</pre>\n";

//print "<p>Su nombre es $_REQUEST[nombre]</p>\n";

}




?>

<!DOCTYPE HTML>
<html>
<head><meta charset="gb18030">
<title>El Socio Lite</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <div class="jumbotron" style="margin-top: 30px; background-color: #E0E0E0;">
        <img class="logo img-responsive" src="view.php?id=2" alt="El Socio LITE" height="65" width="300">
        <h1>Pago confirmado</h1>
        <p>Su pago ha sido recibido correctamente. Muchas gracias por su confianza.</p>
        <p>
        <p>Pedido : <?php echo $product_no; ?> Monto : <?php echo $product_price; ?>  Estatus : <?php echo $product_status; ?> Txn Id : <?php echo $product_transaction; ?> </p>
        <?php
            $dbcon=new mysqli("localhost","root","","servido2_store"); //servidor, usuario de base de datos, contraseña del usuario, nombre de base de datos
            $sql="update orderdetails set order_status='Ordered' ,txnid='$product_transaction' where  nropedido=$product_no";
            $resultado = $dbcon->query($sql);
            $dbcon->close();
        ?>
        <p>
          <a class="btn btn-lg btn-primary" href="https://servidordeprueba.com/store/Customers/indexk.php" role="button">Visitar tienda</a>
        </p>
        <p>
          <a class="btn btn-lg btn-primary" href="https://servidordeprueba.com/store/Customers/facturas.php?id_factura=<?php echo $product_no ?>" role="button">Bajar Factura</a>
        </p>
      </div>
</div>
</body>
</html> 