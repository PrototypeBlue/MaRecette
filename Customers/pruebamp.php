
<?php

include "encriptar.php";
$nrof=322600;
$totalvalor=53.22;
    $dato_encriptadof = $encriptar($nrof);
    $dato_encriptadom = $encriptar($totalvalor);
    header("Location:Pagoprevio.php?concept=$dato_encriptadof&amt=$dato_encriptadom");
        
        ?>