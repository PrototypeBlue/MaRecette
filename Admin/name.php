<?php
include ("db_conection.php");
$txttda=$_POST['txttda'];



$txttda_arr = explode("$", $txttda);


$id_receta = $txttda_arr[0];


$borrar = "DELETE FROM ing_receta WHERE item_receta = $id_receta";
$borrar2 = mysqli_query($dbcon,$borrar);





for($i = 1; $i < count($txttda_arr)-1; $i+=2){
    $id_ing= $txttda_arr[$i];
    $eso = $i + 1;
    $cant = $txttda_arr[$eso];
   
   


    //Get image data from database
   
  
$result = mysqli_query($dbcon, "SELECT * FROM items where item_id = $id_ing");


while ($row = mysqli_fetch_array($result)) {
    $unidad= $row['unidad_ing'];
}





    $insertar="INSERT INTO `ing_receta` (`item_receta`, `item_ing`, `cantidad_ing_receta`, `ing_receta_unidad_medida`) VALUES ($id_receta,$id_ing, $cant,'$unidad')";

    $resultado = mysqli_query($dbcon,$insertar);
   
}

?>