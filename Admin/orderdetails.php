<?php
session_start();
$razsoc=$_SESSION['razsoc'] ;
if(!$_SESSION['admin_username'])
{

    header("Location: ../index.php");
}

?>

<?php

	require_once 'config.php';
	
	if(isset($_GET['delete_id']))
	{
		
		
		
	
		$stmt_delete = $DB_con->prepare('DELETE FROM orderdetails WHERE order_id =:order_id');
		$stmt_delete->bindParam(':order_id',$_GET['delete_id']);
		$stmt_delete->execute();
		
		header("Location: orderdetails.php");
	}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $razsoc?></title>
	 <link rel="shortcut icon" href="../assets/img/logo.png" type="image/x-icon" />
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="font-awesome/css/font-awesome.min.css" />
    <link rel="stylesheet" type="text/css" href="css/local.css" />

   
    <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
	<script src="js/datatables.min.js"></script>
  
   
   <!-- mensajes estilos Edwin 15-01-2020 -->
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
                <a class="navbar-brand" href="index.php"><?php echo $razsoc?> - Panel Administracion</a>
            </div>
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                <?php include("menulateral.php") ?>
					
                    
                </ul>
                <ul class="nav navbar-nav navbar-right navbar-user">
                    <li class="dropdown messages-dropdown">
                        <a href="#"><i class="fa fa-calendar"></i>  <?php
                             date_default_timezone_set("America/New_York");
                            $Today=date('y:m:d');
                            $new=date('l, F d, Y',strtotime($Today));
                            echo $new; ?></a>
                        
                    </li>
                     <li class="dropdown user-dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php   extract($_SESSION); echo $admin_username; ?><b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            
                            <li><a href="logout.php"><i class="fa fa-power-off"></i> Log Out</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>

        <div id="page-wrapper">
            
			
			
			
			
			
		
			
			
		 <div class="alert alert-danger">
                        
                          <center> <h3><strong>Detalle de Ordenes Pendiente</strong> </h3></center>
						  
						  </div>
						  
						  <br />
						  
						  <div class="table-responsive">
           <!-- <table class="display table table-bordered" id="example" cellspacing="0" width="100%" style="cursor:pointer; " onclick="myFunctiondel(event)">-->
            <table class="display table table-bordered" id="example" cellspacing="0" width="100%" style="cursor:pointer; " >
              <thead>
                <tr>
                  <th>Fecha Ordenes</th>
                  <th>Nombre Clientes</th>
				  <th>Item</th>
                  <th>Precios</th>
				  <th>Cantidad</th>
				  <th>Total</th>
                  
                
                
                </tr>
              </thead>
              <tbody>
			  <?php
        include("config.php");
	$stmt = $DB_con->prepare('select order_id, order_date,users.user_firstname, users.user_lastname, order_name, order_price, order_quantity, order_total from orderdetails, users where orderdetails.user_id=users.user_id and order_status="Ordered" order by order_date desc');
	$stmt->execute();
	
	if($stmt->rowCount() > 0)
	{
		while($row=$stmt->fetch(PDO::FETCH_ASSOC))
		{
			extract($row);
			
			
			?>
                <tr>
                  
                 <td><?php echo $order_date; ?></td>
				 <td><?php echo $user_firstname; ?> <?php echo $user_lastname; ?></td>
				 <td><?php echo $order_name; ?></td>
				 <td>&#36; <?php echo $order_price; ?></td>
				 <td><?php echo $order_quantity; ?></td>
                 <td>&#36; <?php echo $order_total; ?></td>
               
                <!-- <td <span class="glyphicon glyphicon-trash"> Eliminar</span> </td>-->
                
				
			<!--	 <a class="btn btn-danger" href="?delete_id=<?php echo $row['order_id']; ?>" title="click for delete" onclick="myFunctiondel()">
				  <span class='glyphicon glyphicon-trash'></span>
                  Eliminar Item de la orden</a>-->
                  

                 

                  
                  </td>
                </tr>
               
              <?php
		}
		echo "</tbody>";
		echo "</table>";
		echo "</div>";
        echo "<br />";
        

        include("footer.php");
		
	
		echo "</div>";
	}
	else
	{
		?>
		
			
        <div class="col-xs-12">
        	<div class="alert alert-warning">
            	<span class="glyphicon glyphicon-info-sign"></span> &nbsp; No Existen Ordenes ...
            </div>
        </div>
        <?php
	}
	
?>
		
	</div>
	</div>
					
            
                </div>
            </div>

           

           
        </div>
		
		
		
    </div>
    <!-- /#wrapper -->

	
	<!-- Mediul Modal -->
        <div class="modal fade" id="uploadModal" tabindex="-1" role="dialog" aria-labelledby="myMediulModalLabel">
          <div class="modal-dialog modal-md">
            <div style="color:white;background-color:#008CBA" class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h2 style="color:white" class="modal-title" id="myModalLabel">Cargar Items</h2>
              </div>
              <div class="modal-body">
         
				
			
				
				 <form enctype="multipart/form-data" method="post" action="additems.php">
                   <fieldset>
					
						
                          
                   <p>Nombre del  Item:</p>
                            <div class="form-group">

                                <input class="form-control" placeholder="Nombre de Item" name="item_name" type="text" required>


							</div>



							<p>Precio:</p>
                            <div class="form-group">

                                <input id="priceinput" class="form-control" placeholder="Precio" name="item_price" type="text" required>

							</div>

						

                                <input id="qtyinput" class="form-control" placeholder="Cantidad" name="item_qty" type="hidden" value=0>

					

							<p>Escoger imagen:</p>
							<div class="form-group">


                                <input class="form-control"  type="file" name="item_image" accept="image/*" required/>

							</div>

				   
				   
					 </fieldset>
                  
            
              </div>
              <div class="modal-footer">
               
                <button class="btn btn-success btn-md" name="item_save">Guardar</button>
				
				 <button type="button" class="btn btn-danger btn-md" data-dismiss="modal">Cancelar</button>
				
				
				   </form>
              </div>
            </div>
          </div>
        </div>
		<script type="text/javascript" charset="utf-8">
	$(document).ready(function() {
	  $('#example').dataTable({
            responsive: true,
            language: {
                url: 'js/es-ar.json' //Ubicacion del archivo con el json del idioma.
            }


          });
	});
    </script>
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
    function myFunctiondel(e) {
       
  texto=(e.target.parentNode.innerText);
  
 
  separador = "\t", // un espacio en blanco
  arregloDeSubCadenas = texto.split(separador); 






        alertify.confirm("Confirmar ", 'Eliminar Items '+arregloDeSubCadenas[2], function(){ 
                        
            
            
            alertify.success('Ok') }
                , function(){ alertify.error('Cancel')});
    }
	
    

</script>
</body>
</html>
