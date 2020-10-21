
<?php
include("db_conection.php");
$nrof=0;


$sql="SELECT `correlativo` FROM `correlativos`";


    $resultado = $dbcon->query($sql);
   
    if ($resultado->num_rows>0) {
       $fila = $resultado->fetch_assoc();
        $nrof= $fila['correlativo'];
        $sql="UPDATE `correlativos` SET `correlativo`=`correlativo`+1";
        $resultado = $dbcon->query($sql);

    }

    
  echo   $nrof; 

$dbcon->close();
          


 ?>