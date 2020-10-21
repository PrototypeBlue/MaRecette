<?php
 
 

 session_start();
error_reporting( ~E_NOTICE );
$razsoc=$_SESSION['razsoc'] ;

$ic11='/store/Admin/'.$_SESSION['ic1'];
$ic22='/store/Admin/'.$_SESSION['ic2'];
$ic33='/store/Admin/'.$_SESSION['ic3'];
$ic44='/store/Admin/'.$_SESSION['ic4'];
$ic55='/store/Admin/'.$_SESSION['ic5'];
$ic66='/store/Admin/'.$_SESSION['ic6'];

if(!$_SESSION['user_email'])
{

    header("Location: ../index.php");
}


 include("config.php");
 extract($_SESSION);
		$stmt_edit = $DB_con->prepare('SELECT * FROM users WHERE user_email =:user_email');
		$stmt_edit->execute(array(':user_email'=>$user_email));
		$edit_row = $stmt_edit->fetch(PDO::FETCH_ASSOC);
		extract($edit_row);

      include("config.php");
      $stmt_edit = $DB_con->prepare("select sum(order_total) as total from orderdetails where user_id=:user_id and order_status='Ordered'");
    $stmt_edit->execute(array(':user_id'=>$user_id));
    $edit_row = $stmt_edit->fetch(PDO::FETCH_ASSOC);
    extract($edit_row);


 //$query="SELECT *  FROM orderdetails where user_id = $user_id"; 
include ('db_conection.php');

 $query="SELECT * FROM items"; 
 $resultado=mysqli_query($dbcon,$query);
$unidad = "Unidad(es)";
$gramo = "gramos";
$mililitro = "Mililitros";


$order_quantity = 10;
 while ( $valores = $resultado->fetch_assoc()){
   

    $id_ing = $valores['item_id'];
    $order_name = $valores['item_name'];
    $unidad_ing = $valores['unidad_ing'];

   

echo '</br>';



    $query2="SELECT *  FROM orderdetails where user_id = $user_id and item_id = $id_ing";


   $resultado2=mysqli_query($dbcon,$query2);

   $row_cnt = $resultado2->num_rows;

   

   if ($row_cnt == 0){

      if (strcmp($unidad_ing,$unidad)!== 0){
$order_quantity = 3;

      }else if ($unidad_ing == 'gramos') {
         $order_quantity = 500;
      } else if ($unidad_ing == 'Mililitros'){
         $order_quantity = 500;
      }

      $save_order_details="insert into orderdetails (user_id,order_name,order_price,order_quantity,order_total,order_status,unidad_medida, item_id) 
      VALUE ($user_id,'$order_name',0,'$order_quantity',0,'Pending','$unidad_ing',$id_ing)";
      
     



      mysqli_query($dbcon,$save_order_details);
      
   }else{

      $query3="UPDATE orderdetails SET  order_quantity=order_quantity+$order_quantity WHERE item_id = $id_ing and user_id = $user_id";

$resultado3=mysqli_query($dbcon,$query3);
   }

 }

 header('location: cart_items.php');



//    while ($valores2 = $resultado2->fetch_assoc()){

      

//       $id_ing_inv = $valores2['item_id'];
//       $order_quantity = 100;

//       echo ("</br>");

// echo $order_quantity;
// echo ("-------");
// echo $id_ing;
// echo ("-------");

// echo ($id_ing_inv);
// echo ("-------");
// echo $user_id;
// echo ("</br>");




//     if(is_null($id_ing) and $cont1 == 0){
//       echo("NO ESTA REGISTRADO </br>");
     


//       $save_order_details="insert into orderdetails (user_id,order_name,order_price,order_quantity,order_total,order_status,unidad_medida, item_id) 
//       VALUE ($user_id,$order_name,0,$order_quantity,0,'Pending',$unidad_ing,$id_ing)";
      
//       echo $save_order_details;


//       mysqli_query($dbcon,$save_order_details);

//       $cont1=1;

// echo $resultado3;

//     }else if ($cont2 == 0){

// echo("ESTA REGISTRADO");
// echo "</br>";
// $query3="UPDATE orderdetails SET  order_quantity=order_quantity+$order_quantity WHERE item_id = $id_ing and user_id = $user_id";
// echo $query3;
// $resultado3=mysqli_query($dbcon,$query3);
      
// $cont2 = 1;
//     }
//    }
// }

// //     //$query2="SELECT *  FROM items"; 
// //     $resultado2=mysqli_query($dbcon,$query2);

// //     while ($query2 = $resultado2->fetch_assoc()){
// //         $fila2 = $resultado->fetch_assoc();

 

// //  if( $id_ing >= 0 ){

// //      mysqli_query($dbcon,$query);

// //       $save_order_details="insert into orderdetails (user_id,order_name,order_price,order_quantity,order_total,order_status,item_id) VALUE ('$user_id','$order_name','$order_price','$order_quantity','$order_total','$order_status',$item_id)";
// //         mysqli_query($dbcon,$save_order_details);

   
  
// //  }

// //  }


// ?>