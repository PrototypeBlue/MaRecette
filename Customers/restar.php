<?php
$item_id = 4;
include("db_conection.php");
$dato = "nada";
$sql="select * from ing_receta where item_receta = $item_id";
$eso = mysqli_query($dbcon,$sql);
echo $sql;
echo ("</br>");
while($mostrar=mysqli_fetch_array($eso)){
    
 $dato = $mostrar['cantidad_ing_receta'];
 $ing = $mostrar['item_ing'];
 $query2="UPDATE orderdetails SET order_quantity = order_quantity-$dato WHERE `item_id`=$ing and `user_id` = 6";
 mysqli_query($dbcon,$query2);

echo $dato,("</br>");



}



?>