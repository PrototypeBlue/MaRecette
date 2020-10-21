<?php
require 'funcs/conexion.php';
include 'funcs/funcs.php';
session_start();

$errors = array();
        if(!empty($_POST))
        	{	$email = $mysqli->real_escape_string($_POST['email']);
        	
        	$email = str_replace("1", "",$email);
        
	            if(!isEmail($email))
	                {	$errors = "Debe ingresar un correo electronico valido";
	                }
	                if(emailExiste($email)){	
	                        $user_id = getValor('user_id', 'user_email', $email);
		                	$nombre = getValor('user_firstname', 'user_email', $email);
		                	$token = generaTokenPass($user_id);
		        			$url = 'http://'.$_SERVER["SERVER_NAME"].'/store/cambia_pass.php?user_id='.$user_id.'&token='.$token;
		        			$asunto = 'Recuperar Password - Sistema de Usuarios';
		               
		                
		                	$cuerpo = "Hola $nombre : <br /><br />Se ha solicitado un reinicio de contrase&ntilde;a. <br/><br/>Para restaurar la contrase&ntilde;a, visita la siguiente direcci&oacute;n: <a href='$url'>$url</a>";
			           
               
               
			           
			               enviarEmail($email, $nombre, $asunto, $cuerpo);
			           
			           
			           
			          
			            if(enviarEmail($email, $nombre, $asunto, $cuerpo))
		                	{	echo "Hemos enviado un correo electronico a la direccion $email para restablecer tu clave.<br />";
			                    echo "<a href='../index.php' >Iniciar Sesion</a>";exit;
		                    }
		                }else{
		         			 	$errors = "La direccion de correo electronico no existe";
		         			 	
							 }
			}
		
		//	echo $errors;
			/*echo "<script language=JavaScript>alert('$errors');history.back();</script>";*/
			
			
?>
