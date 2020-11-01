<?php
session_start();
$razsoc=$_SESSION['razsoc'] ;
if(!$_SESSION['user_email'])
{

    header("Location: ../index.php");
}

?>

<?php
$dbcon=new mysqli("localhost","root","","servido2_store"); //servidor, usuario de base de datos, contraseña del usuario, nombre de base de datos
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

	error_reporting( ~E_NOTICE );
	
	require_once 'config.php';
	
	if(isset($_GET['cart']) && !empty($_GET['cart']))
	{
        $id = $_GET['cart'];
        $nropagina1= $id ;
        $decimales = explode("$",$id);
        $id = $decimales[0];
        $nropagina1 =$decimales[1];
     
      /*  $nropagina2= $id/8;
        $decimales = explode(".",$nropagina2);
        $nropagina1=$decimales[0];
       
        if ($decimales[1]!="") {
            $nropagina1=$decimales[0]+1;
        
        } */
		$sql= ('SELECT t2.item_id, t2.item_name, t2.item_price, t2.item_image, t2.candisp, t2.preparacion, t3.ing_receta_unidad_medida, t3.cantidad_ing_receta, t1.item_name  as ing   FROM recetas as t2, items as t1, ing_receta as t3 WHERE t3.item_ing = t1.item_id and t3.item_receta = t2.item_id and t3.item_receta = '.$id.'');
		
		
        
        $resultado = mysqli_query($dbcon,$sql);

	}
	else
	{ 
		header("Location: shop.php");
	}
	
	
	?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $razsoc?></title>
	 <link rel="shortcut icon" href="../images/Mare.jpg" type="image/x-icon" />
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="font-awesome/css/font-awesome.min.css" />
    <link rel="stylesheet" type="text/css" href="css/local.css" />

    <script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>

   <!-- mensajes estilos Edwin 15-01-2020 -->
<link rel="stylesheet" href="../AlertifyJS/css/alertify.min.css" />
<link rel="stylesheet" href="../AlertifyJS/css/themes/semantic.min.css" />

   
   
    
</head>
<body>
    <div id="wrapper" >
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <div class="navbar-header" style="background-color:#142f28;">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php"><?php echo $razsoc?></a>
            </div>
            <div class="collapse navbar-collapse navbar-ex1-collapse" style="background-color:#142f28;">
                <ul class="nav navbar-nav side-nav"style="background-color:#303030;">
                <li class="active"><a href="index.php" style="background-color:#303030;"> &nbsp; <span class='glyphicon glyphicon-home'></span> Inicio</a></li>
                <li><a href="PruebasFiltroReceta.php?id=1" style="background-color:#303030;" > &nbsp; <span class='glyphicon glyphicon-shopping-cart'></span> Recetas disponibles</a></li>
					<li><a href="shop.php?id=1" style="background-color:#303030;"> &nbsp; <span class='glyphicon glyphicon-shopping-cart'></span> Ingredientes</a></li>
					<li><a href="cart_items.php"> &nbsp; <span class='fa fa-cart-plus'></span> Inventario de ingredientes</a></li>
					<li><a href="recetas.php"> &nbsp; <span class='glyphicon glyphicon-list-alt'></span> Recetas</a></li>
					<li><a href="view_purchased.php"> &nbsp; <span class='glyphicon glyphicon-eye-open'></span> Historial de recetas</a></li>
					<li><a data-toggle="modal" data-target="#setAccount"> &nbsp; <span class='fa fa-gear'></span> Configuracion Cuenta</a></li>
					<li><a href="logout.php"> &nbsp; <span class='glyphicon glyphicon-off'></span> Cerrar sesión</a></li>
					
                    
                </ul>
                <ul class="nav navbar-nav navbar-right navbar-user" style="background-color:#142f28;">
                    <li class="dropdown messages-dropdown">
                        <a href="#"><i class="fa fa-calendar"></i>  <?php
                            date_default_timezone_set("America/New_York");
                            $Today=date('y:m:d');
                            $new=date('l, F d, Y',strtotime($Today));
                            echo $new; ?></a>
                        
                    </li>
					<li class="dropdown user-dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"></a>
                       
                    </li>
					
					
                     <li class="dropdown user-dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $user_email; ?><b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a data-toggle="modal" data-target="#setAccount"><i class="fa fa-gear"></i> Configuracion</a></li>
                            <li class="divider"></li>
                            <li><a href="logout.php"><i class="fa fa-power-off"></i> Log Out</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>

        <div id="page-wrapper">
            
	
			
					
					
					
					
 <form role="form" >
	
    
    <?php
	if(isset($errMSG)){
		?>
       
        <?php
	}
	?>
   
    <div class="alert alert-default" style="color:white;background-color:#4d1522 ">
         <center><h3> <span class="glyphicon glyphicon-info-sign"></span> Receta </h3></center>
        </div>



		<!-- <td><input class="form-control" type="hidden" name="order_name" value="</?php echo $item_name; ?>" /></td>
		<td><input class="form-control" type="hidden" name="order_price" value="</?php echo $item_price; ?>" /></td>
        <td><input class="form-control" type="hidden" name="order_price" value="</?php echo $ing; ?>" /></td>
		<td><input class="form-control" type="hidden" name="user_id" value="</?php echo $user_id; ?>" /></td>
		<td><input class="form-control" type="hidden" name="user_id1" id="user_id1" value="</?php echo $user_id; ?>" /></td>
		<td><input class="form-control" type="hidden" name="item_id" id="item_id" value="</?php echo $id; ?>" /></td> -->
		
		
		
		
	<table class="table table-bordered table-responsive">
	 
	
    <tr>
    	
        <input class="form-control" type="hidden" name="v4" id="v4" value="<?php echo $nropagina1; ?>" disabled/>
		
    </tr>


	<?php
        $eso=0;
                while($mostrar= mysqli_fetch_array($resultado)){
                    if ($eso==0){
                        ?> 


<input class="form-control" type="hidden" name="order_name" value="<?php echo $item_name; ?>" />
		<input class="form-control" type="hidden" name="order_price" value="<?php echo $item_price; ?>" />
        <input class="form-control" type="hidden" name="order_price" value="<?php echo $ing; ?>" />
		<input class="form-control" type="hidden" name="user_id" value="<?php echo $user_id; ?>" />
		<input class="form-control" type="hidden" name="user_id1" id="user_id1" value="<?php echo $user_id; ?>" />
		<input class="form-control" type="hidden" name="item_id" id="item_id" value="<?php echo $id; ?>" />
        <input class="form-control" type="hidden" name="cantidad_ing_receta" id="cantidad_ing_receta" value="<?php echo $cantidad_ing_receta; ?>" />
    <tr>
    	<td><label class="control-label"> Item.</label></td>
        <td><input class="form-control" type="text" name="v1" id="v1" value="<?php echo $mostrar['item_name']?>" disabled/></td>
    </tr>

    <tr>
    	<td><label class="control-label">Imagen</label></td>
        <td>
        	<p><img class="img img-thumbnail"  src="../Admin/item_images/<?php echo $mostrar['item_image']?>" style="height:250px;width:350px;" /></p>
        	
        </td>
    </tr>

	 <tr>
    	<td><label class="control-label">Elaboración</label></td>
        <td><?php echo $mostrar['preparacion']?></td>
        <input class="form-control" type="hidden" name="v2" id="v2" value="<?php echo $mostrar['item_price']?>" disabled/>
    </tr>
	

    
    <tr>

  
        
    


    <?php
                         $eso=1;
                        }
        ?>
        <tr>
        <td><label class="control-label">Ingredientes</label></td>
        <td><input class="form-control"  name="order_price" value="<?php echo $mostrar['ing']?> - <?php echo $mostrar['cantidad_ing_receta']?> <?php echo $mostrar['ing_receta_unidad_medida']?> " disabled/></td>
</tr>
<?php
}
?>

<td><label class="control-label">Quantity.</label></td>
        <td><input class="form-control" type="text" placeholder="Quantity" name="order_quantity" id = "v3" value="1" onkeypress="return isNumber(event)" onpaste="return false"  required />
		
			
		
		</td>
    </tr>

    <td colspan="2">
    
    
    
        
        
       
        
        <a class="btn btn-primary" onclick="myFunctionadd()"> <span class="glyphicon glyphicon-shopping-cart"></span> Guardar </a>

     <a class="btn btn-danger" href="shop.php?id=<?php echo $nropagina1; ?>"> <span class="glyphicon glyphicon-backward"></span> Cancelar </a>
        
        </td>
    </tr>
    
    </table>
    
</form>
					
					
					
					
					
					<br />
			
		            	<div class="alert alert-default" style="background-color:#142f28;">
                       <p style="color:white;text-align:center;">
                       &copy MaRecette | Todos los derechos reservados | 2020
						</p>
                        
                    </div>
            
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
                <h3 style="color:white" class="modal-title" id="myModalLabel">Configuracion Cuenta</h3>
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
	
	
</body>
<script src="../AlertifyJS/alertify.min.js"></script>
<script>

function myFunctionadd() {

    

    var item_id = document.getElementById('item_id').value;
    var Id_cliente = document.getElementById('user_id1').value;
    var v1 = document.getElementById('v1').value;
    var v2 = document.getElementById('v2').value;
    var v3 = document.getElementById('v3').value;      
	var cant = document.getElementById('cantidad_ing_receta').value;      
		
            $.ajax({
                    url: 'save_recipe.php' ,
                    type: 'POST' ,
                    dataType: 'html',
                    data: {'user_id':Id_cliente,'order_name':v1,'order_price':v2,'order_quantity':v3,'item_id':item_id,'cantidad_ing_receta':cant },
                })
                .done(function(respuesta){
                 
                    if (respuesta==1){
                        alertify.success('Registro Adicionado',15, regresar())
                    
                    }else{  
                       
                        alertify.error('Cantidad existencia no cubre cantidad solicitada');

                    }
                    
                })
                .fail(function(){
                    alertify.error('Cantidad existencia no cubre cantidad solicitada');
                    console.log("error");
                });


}
function regresar() {
 
    var v4 = document.getElementById('v4').value; 
    var regre='shop.php?id='+v4;
      window.open(regre,'_self')
 
 }
    
function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
}





$(document).ready(function() {
		 

		function changeColor() {
			
			var Id_cliente = document.getElementById('user_id1').value;
            alertify.success('Actualizando Existencia');
				
			
				$.ajax({
						url: 'actestatus.php' ,
						type: 'POST' ,
						dataType: 'html',
						data: {id:Id_cliente },
					})
					.done(function(respuesta){
						
						if (respuesta==1){
                          
							location.reload();
						}
						
					})
					.fail(function(){
						console.log("error");
					});
					
		        	
				

				
    }



       

        setInterval(changeColor, 13000);

    });
  

  
    
			
  



</script>
</html>
