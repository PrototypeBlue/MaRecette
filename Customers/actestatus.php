<?php

$id=$_POST['id'];

$dbcon=new mysqli("localhost","root","","servido2_store"); //servidor, usuario de base de datos, contraseña del usuario, nombre de base de datos


$query="SELECT act  FROM `users` where user_id= $id"; 

$proc=0;
$resultado = $dbcon->query($query);

    if ($resultado->num_rows>0) {
        $fila = $resultado->fetch_assoc();
        if ($fila['act']==1){
              $query="UPDATE `users` SET `act` = '0' WHERE `users`.`user_id` = $id ";
              $result=mysqli_query($dbcon,$query);
              $proc=1;}
    }     
echo $proc;
?>