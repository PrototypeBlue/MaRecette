<?php
session_start();
$razsoc=$_SESSION['razsoc'] ;
if(!$_SESSION['user_email'])
{

    header("Location: ../index.php");
}

?>

<?php
 include("config.php");
 extract($_SESSION); 
	    $stmt_edit = $DB_con->prepare('SELECT * FROM users WHERE user_email =:user_email');
		$stmt_edit->execute(array(':user_email'=>$user_email));
		$edit_row = $stmt_edit->fetch(PDO::FETCH_ASSOC);
		extract($edit_row);

		?>

		<?php
 include("config.php");
		  $stmt_edit = $DB_con->prepare("select sum(order_total) as total from inventario_recetas where user_id=:user_id and order_status='Ordered'");
		$stmt_edit->execute(array(':user_id'=>$user_id));
		$edit_row = $stmt_edit->fetch(PDO::FETCH_ASSOC);
		extract($edit_row);

		?>

		<?php



	if(isset($_GET['delete_id']))
            {
                $dbcon=new mysqli("localhost","root","","servido2_store"); //servidor, usuario de base de datos, contraseña del usuario, nombre de base de datos



                $idpedido=$_GET['delete_id'];
        

            //$sql="select * from orderdetails where  WHERE order_id=$idpedido";

            $sql=" UPDATE recetas
                INNER JOIN
                inventario_recetas ON inventario_recetas.item_id= recetas.item_id and inventario_recetas.order_id=$idpedido SET 
            recetas.candisp=recetas.candisp+inventario_recetas.order_quantity,recetas.cantres=recetas.cantres-inventario_recetas.order_quantity";
             $resultado = $dbcon->query($sql);
             $sql="DELETE FROM inventario_recetas WHERE order_id =$idpedido";
             $resultado = $dbcon->query($sql);
             $dbcon->close();
          //  echo $sql;
                //$stmt_delete = $DB_con->prepare('DELETE FROM orderdetails WHERE order_id =:order_id');
                //$stmt_delete->bindParam(':order_id',$_GET['delete_id']);
                //$stmt_delete->execute();

            //header("Location: cart_items.php");
	}

?>
<?php

	require_once 'config.php';

	if(isset($_GET['update_id']))
	{
        
        $dbcon=new mysqli("localhost","root","","servido2_store"); //servidor, usuario de base de datos, contraseña del usuario, nombre de base de datos

        $sql="SELECT `correlativo` FROM `correlativos`";
         $resultado = $dbcon->query($sql);
        $resultado = $dbcon->query($sql);

   
            if ($resultado->num_rows>0) {
            $fila = $resultado->fetch_assoc();
                $nrof= $fila['correlativo'];
                $sql="UPDATE `correlativos` SET `correlativo`=`correlativo`+1";
                $resultado = $dbcon->query($sql);
               
                $sql="update inventario_recetas set order_status='Ordered-Pend_Pago' , nropedido=$nrof WHERE order_status='Pending' and user_id =$user_id";
               // echo $sql;
                $resultado = $dbcon->query($sql);
            }
       $sql="select sum(order_total) as totalx from inventario_recetas where user_id=$user_id and nropedido=$nrof";
       $resultado = $dbcon->query($sql);
    
       $totalvalor=999999999;
  
           if ($resultado->num_rows>0) {
              $fila = $resultado->fetch_assoc();  
                 $totalvalor= $fila['totalx'];
           }

       // echo   $nrof; 
        
        $dbcon->close();

        
        

       

        //$sql='update orderdetails set order_status="Ordered" , nropedido=' + $cadena + ' WHERE order_status="Pending" and user_id =:user_id';
       
      //  $stmt_delete = $DB_con->prepare('update orderdetails set order_status="Ordered" , nropedido=: $nrof WHERE order_status="Pending" and user_id =:user_id');
     //   $stmt_delete = $DB_con->prepare($sql);
	//	$stmt_delete->bindParam(':user_id',$_GET['update_id']);
	//	$stmt_delete->execute();
		echo "<script>alert('Items Ordenado con exito!')</script>";
    include "encriptar.php";
    $dato_encriptadof = $encriptar($nrof);
    $dato_encriptadom = $encriptar($totalvalor);
		header("Location:pagoprevio.php?concept=$dato_encriptadof&amt=$dato_encriptadom");
	}

?>

<!DOCTYPE html>
<html lang="en">
<head><meta charset="euc-jp">
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $razsoc?></title>
	 <link rel="shortcut icon" href="../assets/img/logo.png" type="image/x-icon" />
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="font-awesome/css/font-awesome.min.css" />
    <link rel="stylesheet" type="text/css" href="css/local.css" />

    <script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>

      <!-- mensajes estilos 15-01-2020 -->
<link rel="stylesheet" href="../AlertifyJS/css/alertify.min.css" />
<link rel="stylesheet" href="../AlertifyJS/css/themes/semantic.min.css" />
<script src="../AlertifyJS/alertify.min.js"></script>
</head>
<body>


    <div id="wrapper">
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php"><?php echo $razsoc?></a>
            </div>
            <div class="collapse navbar-collapse navbar-ex1-collapse">
            <?php include("mlateral.php") ?>
					<li class="dropdown user-dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class='glyphicon glyphicon-shopping-cart'></span> Total Price Ordered: &#36; <?php echo $total; ?> </b></a>

                    </li>


                     <li class="dropdown user-dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $user_email; ?><b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a data-toggle="modal" data-target="#setAccount"><i class="fa fa-gear"></i> Settings</a></li>
                            <li class="divider"></li>
                            <li><a href="logout.php"><i class="fa fa-power-off"></i> Log Out</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>

        <div id="page-wrapper">


			<div class="alert alert-default" style="color:white;background-color:#008CBA">
         <center><h3> <span class="fa fa-cart-plus"></span> Inventario de ingredientes</h3></center>
        </div>

			<br />

						  <div class="table-responsive">
            <table class="display table table-bordered" id="example" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>Receta</th>
                
				  <th>Cantidad</th>
				  
                  <th>Accion</th>

                </tr>
              </thead>
              <tbody>
			  <?php
include("config.php");

	$stmt = $DB_con->prepare("SELECT * FROM inventario_recetas where order_status='Pending' and user_id='$user_id'");
	$stmt->execute();

	if($stmt->rowCount() > 0)
	{
		while($row=$stmt->fetch(PDO::FETCH_ASSOC))
		{
			extract($row);


			?>
                <tr>

                 <td><?php echo $order_name; ?></td>
				 
				 <td><?php echo $order_quantity; ?></td>
				 
              
				 <td>


                

                
                  <a class="btn btn-block btn-danger" href="?delete_id=<?php echo $row['order_id']; ?>" title="click for delete" onclick="return confirm('Esta Seguro de remover item?')"><span class='glyphicon glyphicon-trash'></span> Remover Item</a>

                  </td>
                </tr>


              <?php
		}
		 include("config.php");
		  $stmt_edit = $DB_con->prepare("select sum(order_total) as totalx from inventario_recetas where user_id=:user_id and order_status='Pending'");
		$stmt_edit->execute(array(':user_id'=>$user_id));
		$edit_row = $stmt_edit->fetch(PDO::FETCH_ASSOC);
		extract($edit_row);
       

		echo "</tbody>";
		echo "</table>";
		echo "</div>";
		echo "<br />";
		echo '<div class="alert alert-default" style="background-color:#033c73;">
                       <p style="color:white;text-align:center;">
                       &copy 2020 Ratatouille | Todos los derechos reservados | Harry Palma
                       
						</p>

                    </div>
	</div>';

		echo "</div>";
	}
	else
	{
		?>


        <div class="col-xs-12">
        	<div class="alert alert-warning">
            	<span class="glyphicon glyphicon-info-sign"></span> &nbsp; No Existen Registros...
            </div>
        </div>
        <?php
	}

?>








                </div>
            </div>




        </div>



    </div>
    <!-- /#wrapper -->


	<!-- Mediul Modal -->
        <div class="modal fade" id="setAccount" tabindex="-1" role="dialog" aria-labelledby="myMediulModalLabel">
          <div class="modal-dialog modal-sm">
            <div style="color:white;background-color:#008CBA" class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h1 style="color:white" class="modal-title" id="myModalLabel">Configuracion Cuenta</h1>
              </div>
              <div class="modal-body">




				 <form enctype="multipart/form-data" method="post" action="settings.php">
                   <fieldset>


                            <p>Nombre:</p>
                            <div class="form-group">

                                <input class="form-control" placeholder="Firstname" name="user_firstname" type="text" value="<?php  echo $user_firstname; ?>" required>


							</div>


							<p>Apellidos:</p>
                            <div class="form-group">

                                <input class="form-control" placeholder="Lastname" name="user_lastname" type="text" value="<?php  echo $user_lastname; ?>" required>


							</div>

							<p>Direccion:</p>
                            <div class="form-group">

                                <input class="form-control" placeholder="Address" name="user_address" type="text" value="<?php  echo $user_address; ?>" required>


							</div>

							<p>Password:</p>
                            <div class="form-group">

                                <input class="form-control" placeholder="Password" name="user_password" type="password" value="<?php  echo $user_password; ?>" required>


							</div>

							<div class="form-group">

                                <input class="form-control hide" name="user_id" type="text" value="<?php  echo $user_id; ?>" required>


							</div>








					 </fieldset>


              </div>
              <div class="modal-footer">

                <button class="btn btn-block btn-success btn-md" name="user_save">Guardar</button>

				 <button type="button" class="btn btn-block btn-danger btn-md" data-dismiss="modal">Cancelar</button>


				   </form>
              </div>
            </div>
          </div>
        </div>
	  	  <script>

    $(document).ready(function() {
        $('#priceinput').keypress(function (event) {
            return isNumber(event, this)
        });
    });

    function isNumber(evt, element) {

        var charCode = (evt.which) ? evt.which : event.keyCode

        if (
            (charCode != 45 || $(element).val().indexOf('-') != -1) &&
            (charCode != 46 || $(element).val().indexOf('.') != -1) &&
            (charCode < 48 || charCode > 57))
            return false;

        return true;
    }


    function ConfirmDemo() {
    var confir=   alertify.confirm("This is a confirm dialog.",
  function(){
    alertify.success('Ok');
  },
  function(){
    alertify.error('Cancel');
  });
       
}

</script>
</body>
</html>
