
<?php

$dbcon=new mysqli("localhost","root","","servido2_store");

$query="SELECT
`id_ing_receta`,
`item_ing`,
`item_receta`,
`cantidad_ing_receta`,
`recetas`.`item_name`,
`recetas`.`item_image`,
`orderdetails`.`order_name`,
`orderdetails`.`order_quantity`
FROM
`recetas`

LEFT JOIN   `ing_receta` on ing_receta.item_receta=recetas.item_id
LEFT JOIN `orderdetails` ON `orderdetails`.`item_id` = `ing_receta`.`item_ing`

";


$sw=false;
$id_receta="";
$nombre="";
$sw2=false;
$img="";
$result=mysqli_query($dbcon,$query);
while ($query2 = $result->fetch_assoc()){



  if ($sw2==false){ 
    
     $id_receta=$query2['item_receta'];
     $nombre=$query2['item_name'];
     $img=$query2['item_image'];
     $sw2=true;
  }

 if ($id_receta<> $query2['item_receta']) {
      if ($sw==false){
     //     echo $img;
        echo "<img src='../Admin/item_images/".$img."' class='img img-thumbnail'  style='width:350px;height:150px;' />";
        echo $nombre;
        echo $id_receta;
        
      }
      $sw=false;
      $nombre=$query2['item_name'];
      $id_receta=$query2['item_receta'];
      $img=$query2['item_image'];
    }

    if(is_null($query2['order_name']))
	{ $sw=true;
   }
}

if ($sw==false){
   // echo $img;
    echo "<img src='../Admin/item_images/".$img."' class='img img-thumbnail'  style='width:350px;height:150px;' />";
        echo $nombre;
    echo $id_receta;
}
?>



<!-- SELECT
`id_ing_receta`,
`item_ing`,
`item_receta`,
`cantidad_ing_receta`,
`orderdetails`.`order_name`,
`orderdetails`.`order_quantity`,
`recetas`.`item_id`,
`recetas`.`item_name`,
`recetas`.`item_image`,
`recetas`.`item_price`,
`recetas`.`candisp`
FROM
`recetas`,
`ing_receta`
LEFT JOIN `orderdetails` ON `orderdetails`.`item_id` = `ing_receta`.`item_ing` " -->