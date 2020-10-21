<?php
error_reporting( ~E_NOTICE );
$amount = $_GET['amt']; 
$concept =$_GET['concept'];
session_start();
$razsoc=$_SESSION['razsoc'] ;
$error = false;
$order = date('ymdHis');
include "encriptar.php";
$concept1 = $concept;
$resultado = str_replace(" ", "+",$concept1);
$concept=$resultado;
$concept1 =$resultado;
$dato_encriptadof = $desencriptar($concept1);
$nrof=$dato_encriptadof;  

$amount1 = $$amount;
$resultado1 = str_replace(" ", "+",$$amount1);
$$amount=$resultado1;
 
    
   
    ?>

<!DOCTYPE HTML>
<html>
<head>
<title><?php echo $razsoc ?></title>
<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" >
<link rel="stylesheet" href="css/amount.css">

</head>
<body>
<div class="container">

    
   <!-- <div class="loading">Un momento, por favor</div>-->


    

<form class="form-amount" action="" method="post">
    <img class="logo img-responsive" src="view.php?id=2"  alt="El Socio LITE" height="65" width="300"><br/>
    <?php if ($error) { ?><div class="alert alert-danger">El valor introducido no es correcto. Debe introducir por ejemplo: 50.99</div><?php } ?>
    <div class="form-group">
        <label for="concept">    Seleccione Metodo de Pago</label>
        <input type="Hidden" id="concept" name="concept" readonly class="form-control"<?php if ($concept) { ?> value="<?php echo $concept; ?>"<?php }else{ ?> placeholder="Indicar un concepto"<?php } ?>>
    </div>
    <div class="form-group">
       
        <input type="hidden" id="amount" name="amount" readonly class="form-control"<?php if ($amount) { ?> value="<?php echo $amount; ?>"<?php }else{ ?> placeholder="Por ejemplo: 50.00"<?php } ?>>
    </div>
   
    

    <a title="Paypal" href="https://www.servidordeprueba.com/store/Customers/pagopp.php?concept=<?php echo $concept ?>&amt=<?php echo $amount  ?>"><img src="img/paypal.jpg" height="65" width="300"> </a>
    <a title="Khipu" href="https://www.servidordeprueba.com/store/Customers/khipu.php?concept=<?php echo $concept ?>&amt=<?php echo $amount  ?>"><img src="img/khipu1.jpg" height="65" width="300"> </a>
    <a class="btn btn-lg btn-primary btn-block" href="https://www.servidordeprueba.com/store/Customers/cart_itemsc.php?id_factura=<?php echo $nrof ?>" role="button">Anular y Volver</a>
   
</form> 

</div>
</body>
</html>