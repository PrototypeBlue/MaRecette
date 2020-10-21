<?php



//$dbcon=mysqli_connect("127.0.0.1","root","");

//mysqli_select_db($dbcon,"store");


$dbcon=new mysqli("localhost","root","","servido2_store"); //servidor, usuario de base de datos, contraseña del usuario, nombre de base de datos
	
	if(mysqli_connect_errno()){
		echo 'Conexion Fallida : ', mysqli_connect_error();
		exit();
	}
	mysqli_set_charset($dbcon,'utf8');



?>