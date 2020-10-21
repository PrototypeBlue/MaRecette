
<?php
include("db_conection.php");

$user_id = $_POST['user_id'];
$order_name = $_POST['order_name'];
$order_price = $_POST['order_price'];
$order_quantity = $_POST['order_quantity'];
$item_id=$_POST['item_id'];

$order_total=$order_price * $order_quantity;
$order_status='Pending';



$query="SELECT candisp  FROM items where item_id= $item_id"; 


$retor=0;
$resultado = $dbcon->query($query);

    if ($resultado->num_rows>0) {
        $fila = $resultado->fetch_assoc();
        $disponible=$fila['candisp']; 
       
        if( $disponible>= $order_quantity ){
             $query="UPDATE items SET  candisp=candisp-$order_quantity,cantres=cantres+$order_quantity    WHERE `item_id`=$item_id";
              mysqli_query($dbcon,$query);

               $save_order_details="insert into orderdetails (user_id,order_name,order_price,order_quantity,order_total,order_status,item_id) VALUE ('$user_id','$order_name','$order_price','$order_quantity','$order_total','$order_status',$item_id)";
                 mysqli_query($dbcon,$save_order_details);

            
            $retor=1;				
          
          }
          else {
            
            $retor= 0;	
          }
     

    }
	echo $retor;			
	
	
		
	
		



?>
