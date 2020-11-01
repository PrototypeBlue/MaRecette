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
	
	if(isset($_GET['edit_id']) && !empty($_GET['edit_id']))
	{
		$id = $_GET['edit_id'];
		$stmt_edit = $DB_con->prepare('SELECT * FROM recetas WHERE item_id =:item_id');
		$stmt_edit->execute(array(':item_id'=>$id));
		$edit_row = $stmt_edit->fetch(PDO::FETCH_ASSOC);
		extract($edit_row);
	}
	else
	{
		header("Location: items.php");
	}
	
	
	
	if(isset($_POST['btn_save_updates']))
	{
		$item_name = $_POST['item_name'];
		$item_price = $_POST['item_price'];
        $estatus = $_POST['estatus'];
			
		$imgFile = $_FILES['item_image']['name'];
		$tmp_dir = $_FILES['item_image']['tmp_name'];
		$imgSize = $_FILES['item_image']['size'];
					
		if($imgFile)
		{
			$upload_dir = 'item_images/'; // upload directory	
			$imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION)); // get image extension
			$valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions
		//	$itempic = rand(1000,1000000).".".$imgExt;
			
			$i=0;
            while ($i == 0){
                $itempic = rand(1000,1000000).".".$imgExt;
            	if (file_exists($itempic)) {
            		
            	} else {
            		$i=1;
            	}
            
            };
			
			
			
			
			if(in_array($imgExt, $valid_extensions))
			{			
				if($imgSize < 5000000)
				{
					unlink($upload_dir.$edit_row['item_image']);
					move_uploaded_file($tmp_dir,$upload_dir.$itempic);
				}
				else
				{
					$errMSG = "Lo sentimos,el archivo es demasido grande , debe ser menor a 5MB";
					echo "<script>alert('Lo sentimos,el archivo es demasido grande , debe ser menor a 5MB')</script>";				
					 
				}
			}
			else
			{
				$errMSG = "Lo sentimos , solamente JPG, JPEG, PNG & GIF Archivos son permitidos.";	
              echo "<script>alert('Lo sentimos , solamente JPG, JPEG, PNG & GIF Archivos son permitidos.')</script>";					
			}	
		}
		else
		{
		
			$itempic = $edit_row['item_image']; 
		}	
						
		

		if(!isset($errMSG))
		{
			$stmt = $DB_con->prepare('UPDATE items
									     SET item_name=:item_name, 
											 item_price=:item_price, 
										     item_image=:item_image,
                                             estatus=:estatus  
								       WHERE item_id=:item_id');
			$stmt->bindParam(':item_name',$item_name);
			$stmt->bindParam(':item_price',$item_price);
            $stmt->bindParam(':item_image',$itempic);
            $stmt->bindParam(':estatus',$estatus);
			$stmt->bindParam(':item_id',$id);
				
			if($stmt->execute()){
				?>
                <script>
                    	

			//	alert('Actualizacon Exitosa ...');
				window.location.href='items.php';
				</script>
                <?php
			}
			else{
				$errMSG = "Lo sentimos item no puede ser actualizado !";
				 echo "<script>alert('Lo sentimos item no puede ser actualizado !')</script>";				
			}
		
		}
		
						
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
            <div class="collapse navbar-collapse navbar-ex1-collapse" style="background-color:#142f28;">
                <ul class="nav navbar-nav side-nav" style="background-color:#303030;">
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
	
    
    <?php
	if(isset($errMSG)){
		?>
       
        <?php
	}
	?>
			 <div class="alert alert-info" style="color:white;background-color:#4d1522">
                        
                          <center> <h3><strong>Actualizar Item</strong> </h3></center>
						  
						  </div>
						  
						 <table class="table table-bordered table-responsive" style="background-color:#DD948C;">
	 
    <tr>
    	<td><label class="control-label">Nombre Item.</label></td>
        <td><input class="form-control" type="text" name="item_name" value="<?php echo $item_name; ?>" required /></td>
    </tr>
	
	 <tr>
    	<td><label class="control-label">Precio.</label></td>
        <td><input id="inputprice" class="form-control" type="text" name="item_price" value="<?php echo $item_price; ?>" required /></td>
    </tr>
	<tr>
    <td><label class="control-label">Estatus.</label></td>
    <td> <select name="estatus" id="estatus" value="<?php echo $estatus;?>">
                                        <?php
                                       
                                        if ($estatus == 1 ){
                                           echo '<option value=1 selected>Activado</option>';
                                           echo '<option value=0 >Desactivado</option>';
                                        }else{
                                            echo '<option value=1 >Activado</option>';
                                           echo '<option value=0 selected>Desactivado</option>';
                                        }
                                        ?>
                                    </select> </td>

    </tr>
	
    <tr>
    	<td><label class="control-label">Imagen.</label></td>
        <td>
        	<p><img class="img img-thumbnail" src="item_images/<?php echo $item_image; ?>" height="150" width="150" /></p>
        	<input class="input-group" type="file" name="item_image" accept="image/*" />
        </td>
    </tr>
    

    
    </table>
</form>

<form name="add_name" id="add_name">

    <table class="table table-bordered" id="dynamic_field">
    <input type="hidden" name="id" value="<?php echo $id ?>"  />
<tr>
                            <td> <select style="width:80%; max-width:600px" name="name[]" id="name">
                                            
                                            <?php    
                                            include ("db_conection.php");
                                              //  $sql = "SELECT * FROM marcas";
                                                $sql =  "SELECT *  FROM items";
                                              $result = $dbcon->query($sql);

                                              
                                                
                                                while ($valores = mysqli_fetch_array($result)) {
                                                    echo '<option value="'.$valores[item_id].'">'.$valores[item_name].'</option>';
                                                }
                                            ?>

<td> <input type="number" id="cant" name="cant[]" placeholder = "Ingresar cantidad" > </td>


                                    
                                    </select></td>
                            <td><button type="button" name="add" id="add" class="btn btn-primary">Add </button></td>
                        </tr>






</table>
<tr>
<input type="button" name="submit" id="submit" class="btn btn-success" value="Guardar" />
        
        </button>
        
        <a class="btn btn-danger" href="items.php"> <span class="glyphicon glyphicon-backward"></span> Cancelar </a>
        
        </td>
    </tr>


    </form>
    </br> </br>

						  	
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
                <h2 style="color:white" class="modal-title" id="myModalLabel">Subir Receta</h2>
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
		
	  	 
   

</body>
</html>



<script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script>

$(document).ready(function(){
        var i = 1;
        
         
        $('#add').click(function () {
            var  valor1 = document.getElementById("name").value;
        var combo = document.getElementById("name");
         var selected = combo.options[combo.selectedIndex].text;
         var  cant = document.getElementById("cant").value;
        
            i++;
            $('#dynamic_field').append('<tr id="row'+i+'">' +
                                        '<td><select style="width:80%; max-width:600px" name="name[]" id="name">' + '<option value="'+valor1+'">'+selected+'</option>' +
                                            
                                            <?php    
                                         
                                             
                                               
                                                
                                            ?>
                
                                            
                                            
                                    
                                    '</select></td>' +
                                    '<td> <input type="number" id="cant[]" name="cant[]" placeholder = "Ingresar cantidad" value='+cant+' > </td>' +
                                        '<td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td>' +
                                        '</tr>');
        });
        
        $(document).on('click', '.btn_remove', function () {
            var id = $(this).attr('id');
           $('#row'+ id).remove();
        });

        $('#submit').click(function(){

          $aja=   $('#add_name').serialize();

         // alert ($aja);


          separador = "&", // un espacio en blanco
arregloDeSubCadenas1 = $aja.split(separador);
var numeroVocales =arregloDeSubCadenas1.length;  
//alert (numeroVocales);




var txttda="";
 var i;
for (i = 0; i < arregloDeSubCadenas1.length; i=i+1) {
    separador = "=";
    arregloDeSubCadenas2 = arregloDeSubCadenas1[i].split(separador);
     
      txttda=txttda + arregloDeSubCadenas2[1] + "$" ;
} 
//alert (txttda);
;
            $.ajax({
                url:"name.php",
                method:"POST",
                data:{'txttda':txttda},
                success:function(data)
                {
                    alert(data);
                    
                }
            });
        });
    })
</script>


<!-- LISTA PARA HACER:
1)  ARREGLAR LOS NOMBRES QUE SE MUESTRAN
2)  HACER UN SPLIT PARA RESCATAR LA ID Y LA CANTIDAD

-->