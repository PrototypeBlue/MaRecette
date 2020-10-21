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

    header("Location: ../index.php");
}
include "db.php";
 $images = get_imgs();
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

        <div class="container">
<div class="row">
<div class="col-md-12">
<?php if(count($images)>0):?>
<!-- aqui insertaremos el slider -->
<div id="carousel1" class="carousel slide" data-ride="carousel">
  <!-- Indicatodores -->
  <ol class="carousel-indicators">
<?php $cnt=0; foreach($images as $img):?>
    <li data-target="#carousel1" data-slide-to="0" class="<?php if($cnt==0){ echo 'active'; }?>"></li>
<?php $cnt++; endforeach; ?>
  </ol>

  <!-- Contenedor de las imagenes -->
  <div class="carousel-inner" role="listbox">
<?php $cnt=0; foreach($images as $img):?>
    <div class="item <?php if($cnt==0){ echo 'active'; }?>">
      <img src="<?php echo $img->folder.$img->src; ?>" alt="Imagen 1"  style="width:100%;height:400px;">
      
      <div class="carousel-caption"><h1><?php echo $img->title; ?></h1></div>
    </div>
<?php $cnt++; endforeach; ?>
  </div>

  <!-- Controls -->
  <a class="left carousel-control" href="#carousel1" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Anterior</span>
  </a>
  <a class="right carousel-control" href="#carousel1" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Siguiente</span>
  </a>

</div>
<?php else:?>
  <h4 class="alert alert-warning">No hay imagenes</h4>
<?php endif; ?>
</div>
</div>
</div>
<script src="jquery.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
</br>
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



							<p>Unidad de medida:</p>
                            <div class="form-group">
                              
                                <input id="form-control" class="form-control" placeholder="Unidad de medida" name="item_price" type="text" required>

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
