<?php
session_start();
$razsoc=$_SESSION['razsoc'] ;
if(!$_SESSION['user_email'])
{

    header("Location: ../index.php");
}

?>

<?php
// *****************************************Herramienta de sesión*********************************
 include("config.php");
 extract($_SESSION); 
		 $stmt_edit = $DB_con->prepare('SELECT * FROM users WHERE user_email =:user_email');
		$stmt_edit->execute(array(':user_email'=>$user_email));
		$edit_row = $stmt_edit->fetch(PDO::FETCH_ASSOC);
		extract($edit_row);
	
		?>
	
<?php

require_once 'config.php';

if(isset($_GET['delete_id']))
{
    
    $stmt_select = $DB_con->prepare('SELECT item_image FROM items WHERE item_id =:item_id');
    $stmt_select->execute(array(':item_id'=>$_GET['delete_id']));
    $imgRow=$stmt_select->fetch(PDO::FETCH_ASSOC);
    unlink("item_images/".$imgRow['item_image']);
    

    $stmt_delete = $DB_con->prepare('DELETE FROM items WHERE item_id =:item_id');
    $stmt_delete->bindParam(':item_id',$_GET['delete_id']);
    $stmt_delete->execute();
    
    header("Location: items.php");
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
        
        
        
        
        
        
        
        
        

         <div class="alert alert-danger">
                    
                      <center> <h3><strong> Ingredientes </strong> </h3></center>
                      
                      </div>
                      
                      <br />
                      
                      <div class="table-responsive">
        <table class="display table table-bordered" id="example" cellspacing="0" width="100%">
          <thead>
            <tr>
              <th>Imagen</th>
              <th>Nombre Item</th>
              
              <th>Acción</th>
             
              
           
             
            </tr>
          </thead>
          <tbody>
          <?php
include("config.php");
$stmt = $DB_con->prepare('SELECT * FROM items where estatus=1');
$stmt->execute();

if($stmt->rowCount() > 0)
{
    while($row=$stmt->fetch(PDO::FETCH_ASSOC))
    {
        extract($row);
        
        
        ?>
        
            <tr>
              <td>
            <center> <img src="../Admin/item_images/<?php echo $item_image; ?>" class="img img-rounded"  width="60" height="60" /></center>
             </td>
             <td><?php echo $item_name; ?></td>
             
             
             
          
             
             
             <td>
            
             
            
             
            
             <a class='btn btn-block btn-danger' href='add_to_cart.php?cart=<?php echo $row['item_id']; ?>'><span class='glyphicon glyphicon-shopping-cart' ></span> Agregar a inventario</a>
            
              </td>
            </tr>
           
          <?php
    }
    echo "</tbody>";
    echo "</table>";
    echo "</div>";
    echo "<br />";
   


    echo "</div>";
   
    
}
else
{
    ?>
    
        
    <div class="col-xs-12">
        <div class="alert alert-warning">
            <span class="glyphicon glyphicon-info-sign"></span> &nbsp; No Data Found ...
        </div>
    </div>
    <?php
}


?>
			<div class="alert alert-default" style="background-color:#033c73;">
                       <p style="color:white;text-align:center;">
					   &copy 2020 Ratatouille | Todos los derechos reservados | Harry Palma
						</p>
                        
                    </div>
            
                </div>
            </div>

           

           
        </div>
		
		
		
    </div>    
</div>
</div>

<br />
<br />
                      
                      
                      
        
        
        
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


                        <p>Unidad de medida:</p>
                            <div class="form-group">
                              
                                <input id="form-control" class="form-control" placeholder="Unidad de medida" name="item_price" type="text" required>

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
  $('#example').dataTable(
  {
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
</script>
</body>
</html>
