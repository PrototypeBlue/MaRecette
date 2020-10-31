<?php
session_start();
error_reporting( ~E_NOTICE );
$razsoc=$_SESSION['razsoc'] ;

$ic11='/store/Admin/'.$_SESSION['ic1'];
$ic22='/store/Admin/'.$_SESSION['ic2'];
$ic33='/store/Admin/'.$_SESSION['ic3'];
$ic44='/store/Admin/'.$_SESSION['ic4'];
$ic55='/store/Admin/'.$_SESSION['ic5'];
$ic66='/store/Admin/'.$_SESSION['ic6'];

if(!$_SESSION['user_email'])
{

    header("Location: ../index.php");
}
include "../Admin/db.php";
 $images = get_imgs();
?>
<!-- llama a los datos del usuario -->
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
		  $stmt_edit = $DB_con->prepare("select sum(order_total) as total from orderdetails where user_id=:user_id and order_status='Ordered'");
		$stmt_edit->execute(array(':user_id'=>$user_id));
		$edit_row = $stmt_edit->fetch(PDO::FETCH_ASSOC);
		extract($edit_row);

		?>
<!DOCTYPE html>
<html lang="en">
<head><meta charset="euc-jp">
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $razsoc?></title>
	 <link rel="shortcut icon" href="../images/Mare.jpg">
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
                <a class="navbar-brand" href="index.php"><?php echo $razsoc?></a>
            </div>
           <!----colocar aqui menu lateral ---->
           <div class="collapse navbar-collapse navbar-ex1-collapse" style="background-color:#142f28;">
                 <?php include("mlateral.php") ?>
                   <li class="dropdown user-dropdown" >
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">  	 </a>

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






			<div id="my-carousel" class="carousel slide hero-slide hidden-xs" data-ride="carousel">
 

            <div id="my-carousel" class="carousel slide hero-slide hidden-xs" data-ride="carousel">
    
    <!--******************************* Wrapper for slides******************************* -->
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
      <img src="<?php echo '../Admin/'.$img->folder.$img->src; ?>" alt="Imagen 1"  style="width:100%;height:400px;">
      
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
</div>
<script src="jquery.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
</br>

<!--******************************* #my-carousel*******************************-->



			</div>


		<br />
			 <div class="alert alert-success" >
             <a href="canastas.php">  <img src="img/canasta1.jpg" width=200 height=200> </a>
               
               
               <center><h1>Subir archivo  </h1></center>
	<center><form action="sube.php" method="post" enctype="multipart/form-data">
		<input type="file" name="archivo">
		<input class="form-control" type="hidden" name="user_id" value="<?php echo $user_id; ?>" />
		<br><br>
		<button>Subir Archivo</button>
	</form></center>
                      <!--  &nbsp; &nbsp; quis noLorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,strud exercitation ullamco laboris nisi ut aliquip ex ea commodoconsequat. Duis aute irure dolor in reprehenderit in voluptate velit essecillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat nonproident, sunt in culpa qui officia deserunt mollit anim id est laborum.
-->   </div>
<!--      AQUI VA LO DEMAS -->

<
<!-- footer -->
					<br />
                    <br />
			<div class="alert alert-default" style="background-color:#142f28;">
                       <p style="color:white;text-align:center;">
                       &copy  MaRecette | Todos los derechos reservados | 2020
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

                     

              <p>Nombres:</p>
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

							<p>Contrase単a:</p>
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
</script>



</body>
</html>
