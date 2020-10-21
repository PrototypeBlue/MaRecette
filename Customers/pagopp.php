<?php
session_start();
$razsoc=$_SESSION['razsoc'] ;
?>
<!DOCTYPE HTML>
<html>
<head>
<title><?php echo $razsoc ?></title>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
<link rel="stylesheet" href="css/amount.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
</head>
<body>
<div class="container">
<?php
$con=new mysqli("localhost","root","","servido2_store"); //servidor, usuario de base de datos, contrase単a del usuario, nombre de base de datos

if($con->connect_error){
           die("Connection failed: " . $con->connect_error);
                }
$sql="SELECT  keypaypal  FROM cia";



$resultado = $con->query($sql);

if ($resultado->num_rows>0) {
	        while ($fila1 = $resultado->fetch_assoc()) {
	            
	            $keypaypal=$fila1['keypaypal']; 
	           
	            }
}
 $close = mysqli_close($con);
$error = false;
$concept = "";
$amount = "";
include "encriptar.php";
if (!empty($_GET['concept'])) 
    $concept = $_GET['concept'];
    $resultado = str_replace(" ", "+",$concept);
    $concept =$resultado;
    $nrof=$concept;
    $dato_encriptadof = $desencriptar($nrof);
    $concept = $dato_encriptadof;
if (isset($_GET['error']))
    $error = $_GET['error'];

if (isset($_GET['amt']))
    $amount = $_GET['amt'];
    $resultado = str_replace(" ", "+",$amount);
    $amount =$resultado;
    $totalvalor=$amount;
    $dato_encriptadom = $desencriptar($totalvalor);
    $amount = $dato_encriptadom; 
if (isset($_POST['submitPayment'])) {
    
    $amount = $_POST['amount']; 
    $concept = $_POST['concept'];
    $order = date('ymdHis');
    
 
    
   
    ?>
    
    <div class="loading">Un momento, por favor</div>
    
    <form id="realizarPago" action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">
        <input name="cmd" type="hidden" value="_cart" />
        <input name="upload" type="hidden" value="1" />
        
        <input name="business" type="hidden" value="<?php echo $keypaypal; ?>" />
    
        <input name="shopping_url" type="hidden" value="https://servidordeprueba.com/store/Customers/index.php" />
        <input name="currency_code" type="hidden" value="USD" />
        <input name="return" type="hidden" value="https://servidordeprueba.com/store/Customers/confirmation.php" />
        <input name="notify_url" type="hidden" value="https://servidordeprueba.com/store/Customers/confirmationv1.php" />

        <input name="rm" type="hidden" value="2" />
        <input name="item_number_1" type="hidden" value="<?php echo $order; ?>" />
        <input name="item_name_1" type="hidden" value="<?php echo $concept; ?>" />
        <input name="amount_1" type="hidden" value="<?php echo $amount; ?>" />
        <input name="quantity_1" type="hidden" value="1" /> 
       
    </form>
    <script>
    $(document).ready(function () {
      
        
        $("#realizarPago").submit();
    });
    </script>
<?php
}
else {   
?>
<form class="form-amount" action="pagopp.php" method="post">
    <img class="logo img-responsive"  src="view.php?id=2" alt="El Socio LITE" height="65" width="300"><br/>
    <?php if ($error) { ?><div class="alert alert-danger">El valor introducido no es correcto. Debe introducir por ejemplo: 50.99</div><?php } ?>
    <div class="form-group">
        <label for="concept">Nro Pedido</label>
        <input type="text" id="concept" name="concept" readonly class="form-control"<?php if ($concept) { ?> value="<?php echo $concept; ?>"<?php }else{ ?> placeholder="Indicar un concepto"<?php } ?>>
    </div>
    <div class="form-group">
        <label for="amount">Importe</label>
        <input type="text" id="amount" name="amount" readonly class="form-control"<?php if ($amount) { ?> value="<?php echo $amount; ?>"<?php }else{ ?> placeholder="Por ejemplo: 50.00"<?php } ?>>
    </div>
    
   
    <input class="btn btn-lg btn-primary btn-block" name="submitPayment" type="submit" value="Pagar">
   <a class="btn btn-lg btn-primary btn-block" href="https://www.servidordeprueba.com/store/Customers/cart_itemsc.php?id_factura=<?php echo $concept ?>" role="button">Anular y Volver</a>
    <img class="img-responsive" src="img/paypal.png" alt="Pagos con PayPal y PHP" height="65" width="300"><br/>

</form> 
<?php
}
?>
</div>
</body>
</html>