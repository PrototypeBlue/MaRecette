
<?php
include("db_conection.php");

$user_id = $_POST['user_id'];
$order_name = $_POST['order_name'];
$order_price = $_POST['order_price'];
$order_quantity = $_POST['order_quantity'];
$item_id=$_POST['item_id'];

$order_total=$order_price * $order_quantity;
$order_status='Pending';



$query="SELECT item_id  FROM orderdetails where orderdetails.user_id= $user_id and item_id = $item_id"; 


$retor=0;
$resultado = $dbcon->query($query);

    if ($resultado->num_rows>0) {
        $fila = $resultado->fetch_assoc();
        $disponible=$fila['item_id']; 
       
        $query="UPDATE orderdetails SET  order_quantity=order_quantity+$order_quantity    WHERE `item_id`=$item_id and `user_id` = $user_id";
              mysqli_query($dbcon,$query);

$retor=1;
    }
        else{
             
          $sql =  "SELECT * FROM items WHERE item_id = $item_id";
          $result = $dbcon->query($sql);
          $valores = mysqli_fetch_array($result);

          $unidad = $valores['unidad_ing'];
               $save_order_details="insert into orderdetails (user_id,order_name,order_price,order_quantity,order_total,unidad_medida,order_status,item_id) VALUE ('$user_id','$order_name','$order_price','$order_quantity','$order_total','$unidad','$order_status',$item_id)";
                 mysqli_query($dbcon,$save_order_details);

            
            $retor=1;				
          
          }
         
     

    
	echo $retor;			
	
	
		
	
		



?>
