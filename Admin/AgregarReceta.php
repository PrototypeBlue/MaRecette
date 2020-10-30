<?php
session_start();
$razsoc=$_SESSION['razsoc'] ;

$ic11='/store/Admin/'.$_SESSION['ic1'];
$ic22='/store/Admin/'.$_SESSION['ic2'];
$ic33='/store/Admin/'.$_SESSION['ic3'];
$ic44='/store/Admin/'.$_SESSION['ic4'];
$ic55='/store/Admin/'.$_SESSION['ic5'];
$ic66='/store/Admin/'.$_SESSION['ic6'];
if(!$_SESSION['admin_username'])
{

    header("Location: ../index.html");
}

if(isset($_POST['btn_save_updates']))
{
    require_once 'config.php';

    $item_name = $_POST['item_name'];
    $status = 1;
    $preparacion = $_POST['preparacion'];
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
                //unlink($upload_dir.$edit_row['item_image']);
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
        $stmt = $DB_con->prepare('INSERT INTO recetas (item_name, item_image,estatus,preparacion) values
                                    (:item_name,:item_image,:status,:preparacion)');
        $stmt->bindParam(':item_name',$item_name);
        $stmt->bindParam(':item_image',$itempic);
        $stmt->bindParam(':preparacion',$preparacion);
        $stmt->bindParam(':status',$status);
            
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




    

function funcion(){
history.back();

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
                <a class="navbar-brand" href="index.php"><?php echo $razsoc?> - Panel Administracion</a>
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
        <div class="alert alert-info">
                        
                        <center> <h3><strong>Registrar receta</strong> </h3></center>
                        
                        </div>



        <form method="post" enctype="multipart/form-data" class="form-horizontal">
        <?php
        include ("db_conection.php");
        
                                    $sql = "SELECT *  FROM items";
                                    
                                    $resultado=mysqli_query($dbcon,$sql);

                                    $valores = $resultado->fetch_assoc();
                                ?>
       
        <table class="table table-bordered table-responsive" id = "tablarecetas">

        <tr>
    	    <td><label class="control-label">Nombre de receta</label></td>
            <td><input class="form-control" type="text" name="item_name" placeholder="Nombre de receta" required /></td>
        </tr>

        <tr>
            <td><label class="control-label">Agregar imagen</label></td>
            <td><input class="input-group" type="file" name="item_image" accept="image/*" /></td>
        </tr>

        <tr>
            <td><label class="control-label">Preparación de receta</label></td>
            <td><textarea class="form-control" name="preparacion" rows="10" cols="175" placeholder="Escribir preparación de la receta"></textarea></td>
        </tr>
        <tr ><td COLSPAN=2 style="text-align: center;"><label class="control-label">INGREDIENTES</label></td></tr>



        
        </table>

        <tr>
        <td colspan="2"><button type="submit" name="btn_save_updates"  class="btn btn-primary">
        <span class="glyphicon glyphicon-save"></span> Guardar
        </button>
        
        <a class="btn btn-danger" href="index.php"> <span class="glyphicon glyphicon-backward"></span> Cancelar </a>
        
        </td>
    </tr> </br>
        
        <label class="control-label">Ingredientes</label>

        <span class="text-form1">
            <select style="width:80%; max-width:600px" name="ingredientes" id="ingredientes">
                                            
                                                <?php    
                                                  //  $sql = "SELECT * FROM marcas";
                                                    $sql =  "SELECT *  FROM items";
                                                  $result = $dbcon->query($sql);
                                                  
                                                    
                                                    while ($valores = mysqli_fetch_array($result)) {
                                                        echo '<option value="'.$valores[item_id].'">'.$valores[item_name].'</option>';
                                                    }
                                                ?>

                                                
                                                
                                        
                                        </select>
            
                                        <input style="width:20%; max-width:100px; text-align:center" type="button" id="add" value="+" onClick="recibiredita1()"></label>


                                        
        
</br></br>

</span>
       



        </form>

		
  

 

		



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

							

                                <input  id="qtyinput" class="form-control" placeholder="Cantidad" name="item_qty" type="hidden" value=0 >

							

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

<script type="text/javascript">
function recibiredita1()
{
  
         var  valor1 = document.getElementById("ingredientes").value;
         
         var combo = document.getElementById("ingredientes");
         var selected = combo.options[combo.selectedIndex].text;


            var tds=$("#tablarecetas tr:first td").length;
          
            // Obtenemos el total de columnas (tr) del id "tabla"
            var trs=$("#tablarecetas tr").length;
            
          
            var nuevaFila="<tr id=M"+(trs+1)+">";
            //nuevaFila+="<td> Ingredientes </td>";
            
             nuevaFila+="<td class='control-label'> <label class='control-label'>"+selected+" </label></td>";
             nuevaFila+="<td> <input type='number' id='cant' name='cant' placeholder='Asignar cantidad'> </td>";
            // A�1�71�1�770�1�71�1�779adimos una columna con el numero total de filas.
            // A�1�71�1�770�1�71�1�779adimos uno al total, ya que cuando cargamos los valores para la
            // columna, todavia no esta a�1�71�1�770�1�71�1�779adida
            
            nuevaFila+="</tr>";
            $("#tablarecetas").append(nuevaFila);
   
   
   
   
   
} 





</script>