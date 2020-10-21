
<?php
include("db_conection.php");

$user_id = $_POST['user_id'];
$order_name = $_POST['order_name'];
$order_price = $_POST['order_price'];
$order_quantity = $_POST['order_quantity'];
$item_id=$_POST['item_id'];
$cantidad=$_POST['cantidad_ing_receta'];

$order_total=$order_price * $order_quantity;
$order_status='Pending';



$query="SELECT candisp  FROM items where item_id= $item_id"; 


$retor=0;
$resultado = $dbcon->query($query);

    if ($resultado->num_rows>0) {
        $fila = $resultado->fetch_assoc();
        $disponible=$fila['candisp']; 
       
        if( $disponible>= $order_quantity ){
             $sql="select * from ing_receta where item_receta = $item_id";
             $eso = mysqli_query($dbcon,$sql);
            
             while($mostrar=mysqli_fetch_array($eso)){
              $dato = $mostrar['cantidad_ing_receta'];
              $ing = $mostrar['item_ing'];
              $query2="UPDATE orderdetails SET order_quantity = order_quantity-$dato WHERE `item_id`=$ing and `user_id` = $user_id";
              mysqli_query($dbcon,$query2);
              
             }

               $save_order_details="insert into inventario_recetas (user_id,order_name,order_price,order_quantity,order_total,order_status,item_id) VALUE ('$user_id','$order_name','$order_price','$order_quantity','$order_total','$order_status',$item_id)";
                 mysqli_query($dbcon,$save_order_details);

            
            $retor=1;				
          
          }
          else {
            
            $retor= 0;	
          }
     

    }
	echo $retor;			
	
	
		
	
		



?>
