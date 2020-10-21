<?php
//error_reporting(0);
//error_reporting(E_ERROR | E_WARNING | E_PARSE);
//error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
//error_reporting( ~E_NOTICE );
error_reporting(E_ERROR);
include "encriptar.php";
$frase = 350326;
$clave = "C9fBxl1EWtYTL1/M8jfstw==";

/*$encriptado = encriptar_AES($frase, $clave);
echo $encriptado;
$desencriptado = desencriptar_AES($encriptado, $clave);
echo "-;-";
echo $desencriptado;*/

for ($i = 0; $i < 20 ; $i++) {
    print "<p>$i</p>\n";
    
         $dato_encriptado = $encriptar($frase);
         print "<p> $dato_encriptado</p>\n";
        $dato_encriptadof = $desencriptar($dato_encriptado);
        echo "<p>$dato_encriptadof</p>\n";
        $frase =  $frase + 1;
    
}



?>