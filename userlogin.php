<?php
session_start();

?>
<?php

//include("db_conection.php");
$servername = "localhost";
    $username = "root";
  	$password = "";
  	$dbname = "servido2_store";

	$conn = new mysqli($servername, $username, $password, $dbname);
      if($conn->connect_error){
        die("Conexion fallida: ".$conn->connect_error);
      }


if(isset($_POST['user_login']))
{
    $user_email=$_POST['user_email'];
    $user_password=$_POST['user_password'];
	

    $check_user="select `user_id`, `user_email`, `user_password`, `user_firstname`, `user_lastname`, `user_address` FROM `users`  WHERE user_email='$user_email' AND user_password='$user_password'";

   // echo $check_user;

    //$resultado = $conn->query($check_user);
    $result=mysqli_query($conn,$check_user);
   






 /*   echo $check_user;
    $run=mysqli_query($dbcon,$check_user);
    $row_cnt = $run->num_rows;
    echo $row_cnt;*/
  //  if(mysqli_num_rows($run))
    if ($result->num_rows>0)
    {
	 echo "<script>alert('You're successfully login!')</script>";
       
     echo "<script>window.open('Customers/index.php','_self')</script>";
       
$_SESSION['user_email']=$user_email;

$_SESSION['user_id']=$result['user_id'];

    }
    else
    {
       
        echo "<script>alert('Email o Pasword incorrectos!')</script>";
        
		  echo "<script>window.open('index.php','_self')</script>";
		
		 exit();
		
    }
}
?>