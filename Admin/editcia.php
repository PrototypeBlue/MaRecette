<?php
session_start();
$razsoc=$_SESSION['razsoc'] ;
if(!$_SESSION['admin_username'])
{

    header("Location: ../index.php");
}

?>
<?php

	error_reporting( ~E_NOTICE );
	
	require_once 'config.php';
	
	
		$id = 1;
		$stmt_edit = $DB_con->prepare('SELECT * FROM cia WHERE id =:id');
		$stmt_edit->execute(array(':id'=>$id));
		$edit_row = $stmt_edit->fetch(PDO::FETCH_ASSOC);
		extract($edit_row);
        $razsoc1=$razsoc;
        $rut1 = $rut;
        $direccion1 = $direccion;
            
        $ciudad1 = $ciudad;
        $pais1 = $pais;
        $telefono1= $telefono;
        $correo1 = $correo;
        $iva1= $iva;
        
        $idpaypal1=$idpaypal;
        $keypaypal1=$keypaypal;

        $idkhipus1=$idkhipus;
        $keykhipus1=$keykhipus;
	
	
	
	if(isset($_POST['btn_save_updates']))
	{
		$razsoc= $_POST['razsoc'];
		$rut = $_POST['rut'];
        $direccion = $_POST['direccion'];
            
        $ciudad = $_POST['ciudad'];
        $pais = $_POST['pais'];
        $telefono= $_POST['telefono'];
        $correo = $_POST['correo'];
        $iva= $_POST['iva'];
        $idpaypal=$_POST['idpaypal'];
        $keypaypal=$_POST['keypaypal'];
        $idkhipus=$_POST['idkhipus'];
        $keykhipus=$_POST['keykhipus'];


	/*	$imgFile = $_FILES['item_image']['name'];
		$tmp_dir = $_FILES['item_image']['tmp_name'];
		$imgSize = $_FILES['item_image']['size'];*/
        
        $image1 = $_FILES['item_image']['tmp_name'];
        $image = addslashes(file_get_contents($image1));
       
    
       echo ('----');
       echo $image1;
                                         

       $insert = $DB_con->query("UPDATE `cia` SET 
       razsoc='$razsoc', rut='$rut', direccion='$direccion',ciudad='$ciudad',pais='$pais', telefono='$telefono', 
                                             correo='$correo', 
                                             iva=$iva,
                                             `image`='$image',
                                             idpaypal=$idpaypal,
                                             keypaypal='$keypaypal',
                                             idkhipus=$idkhipus,
                                             keykhipus='$keykhipus'");
      
       
		?>
                <script>
                    	
                       
				alert('Actualizacon Exitosa ...');
            //  	window.location.href='index.php';
				</script>
        <?php        
           			
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
                <a class="navbar-brand" href="index.php"><?php echo $razsoc?> - Administrator Panel</a>
            </div>
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                <?php include("menulateral.php") ?>
					
                    
                </ul>
                <ul class="nav navbar-nav navbar-right navbar-user">
                    <li class="dropdown messages-dropdown">
                        <a href="#"><i class="fa fa-calendar"></i>  <?php
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
            
			
			
			
			
			
			
			
			
		<div class="clearfix"></div>

<form method="post" enctype="multipart/form-data" class="form-horizontal">
	
    
    
			 <div class="alert alert-info">
                        
                          <center> <h3><strong>Gestion Datos Compañia</strong> </h3></center>
						  
						  </div>
						  
						 <table class="table table-bordered table-responsive">
	 
    <tr>
    	<td><label class="control-label">Razon Social.</label></td>
        <td><input class="form-control" type="text" name="razsoc" value="<?php  echo $razsoc1; ?>" required /></td>
    </tr>
	
	 <tr>
    	<td><label class="control-label">Rut.</label></td>
        <td><input id="inputprice" class="form-control" type="text" name="rut" value="<?php echo $rut1; ?>" required /></td>
    </tr>
	
    <tr>
    	<td><label class="control-label">Direccion.</label></td>
        <td><input id="inputprice" class="form-control" type="text" name="direccion" value="<?php echo $direccion1; ?>" required /></td>
    </tr>

    <tr>
    	<td><label class="control-label">Pais.</label></td>
        <td><input id="inputprice" class="form-control" type="text" name="pais" value="<?php echo $pais1; ?>" required /></td>
    </tr>

    <tr>
    	<td><label class="control-label">Ciudad.</label></td>
        <td><input id="inputprice" class="form-control" type="text" name="ciudad" value="<?php echo $ciudad1; ?>" required /></td>
    </tr>

    <tr>
    	<td><label class="control-label">Telefono.</label></td>
        <td><input id="inputprice" class="form-control" type="text" name="telefono" value="<?php echo $telefono1; ?>" required /></td>
    </tr>
   
    <tr>
    	<td><label class="control-label">Correo.</label></td>
        <td><input id="inputprice" class="form-control" type="text" name="correo" value="<?php echo $correo1; ?>" required /></td>
    </tr>

    <tr>
    	<td><label class="control-label">IVA.</label></td>
        <td><input id="inputprice" class="form-control" type="text" name="iva" value="<?php echo $iva1; ?>" required /></td>
    </tr>
     <tr>
    	<td><label class="control-label">Id Khipu.</label></td>
        <td><input id="inputprice" class="form-control" type="text" name="idkhipus" value="<?php echo $idkhipus1; ?>" required /></td>
    </tr>
     <tr>
    	<td><label class="control-label">Key Khipu.</label></td>
        <td><input id="inputprice" class="form-control" type="text" name="keykhipus" value="<?php echo $keykhipus1; ?>" required /></td>
    </tr>
     <tr>
    	<td><label class="control-label">Id Paypal</label></td>
        <td><input id="inputprice" class="form-control" type="text" name="idpaypal" value="<?php echo $idpaypal1; ?>" required /></td>
    </tr>
     <tr>
    	<td><label class="control-label">Key Paypal</label></td>
        <td><input id="inputprice" class="form-control" type="text" name="keypaypal" value="<?php echo $keypaypal1; ?>" required /></td>
    </tr>
    <tr>
    	
        
     <td>  
                   
            <p>Selecione Imagen Logo:</p>
							<div class="form-group">
						
							 
                                <input class="form-control"  type="file" name="item_image" accept="image/*" required/>
                           
							</div>
                
          
    
    
    </td>
    <td><img src="view.php?id=1"   width="100" height="100" alt="Imagen desde Blob" /></td>
    </tr>
    
 
 

    
    
    <tr>
        <td colspan="2"><button type="submit" name="btn_save_updates" class="btn btn-primary">
        <span class="glyphicon glyphicon-save"></span> Actualizar
        </button>
        
        <a class="btn btn-danger" href="items.php"> <span class="glyphicon glyphicon-backward"></span> Cancelar </a>
        
        </td>
    </tr>
    
    </table>
    
</form>
						  
						
				<br />
	 
                <?php include("footer.php") ?>
						  
						  
			
			
            
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
                <h2 style="color:white" class="modal-title" id="myModalLabel">Subir ingrediente</h2>
              </div>
              <div class="modal-body">
         
				
			
				
				 <form enctype="multipart/form-data" method="post" action="additems.php">
                   <fieldset>
					
						
                            <p>Nombre de ingrediente</p>
                            <div class="form-group">
							
                                <input class="form-control" placeholder="Name of Item" name="item_name" type="text" required>
                           
							 
							</div>
							
							
							
							
							
							
							
							
							<p>Unidad de medida</p>
                            <div class="form-group">
							
                                <input id="priceinput" class="form-control" placeholder="Price" name="item_price" type="text" required>
                           
							 
							</div>
							
							
							<p>Escoger imagen</p>
							<div class="form-group">
						
							 
                                <input class="form-control"  type="file" name="item_image" accept="image/*" required/>
                           
							</div>
				   
				   
					 </fieldset>
                  
            
              </div>
              <div class="modal-footer">
               
                <button class="btn btn-success btn-md" name="item_save">Save</button>
				
				 <button type="button" class="btn btn-danger btn-md" data-dismiss="modal">Cancel</button>
				
				
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
</script>
</body>
</html>
