<?php
require 'verificark.php';
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
	 <link rel="shortcut icon" href="../assets/img/logosz.png" type="image/x-icon" />
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
           <div class="collapse navbar-collapse navbar-ex1-collapse">
                 <?php include("mlateral.php") ?>
                   <li class="dropdown user-dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class='glyphicon glyphicon-shopping-cart'></span> Total Ordenado: 	&#36; <?php echo $total; ?> </b></a>

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
    <!-- Indicators -->
    <ol class="carousel-indicators">
        <li data-target="#my-carousel" data-slide-to="0" class="active"></li>
        <li data-target="#my-carousel" data-slide-to="1"></li>
        <li data-target="#my-carousel" data-slide-to="2"></li>
		<li data-target="#my-carousel" data-slide-to="3"></li>
        <li data-target="#my-carousel" data-slide-to="4"></li>
		<li data-target="#my-carousel" data-slide-to="5"></li>
    </ol>

    <!-- Wrapper for slides -->
    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">
        <div class="item active">

            <img src= <?php echo $ic11?> alt="Hero Slide" style="width:100%;height:300px;">
        
            

            <div class="carousel-caption">
                <h1 style="font-family:Century Gothic"><b></b></h1>

                <h2></h2>
            </div>
        </div>
        <div class="item">
            <img src=<?php echo $ic22 ?> alt="..." style="width:100%;height:300px;">

            <div class="carousel-caption">

            </div>
        </div>
       

		<div class="item">
            <img src=<?php echo $ic33 ?> alt="..." style="width:100%;height:300px;">

            <div class="carousel-caption">


                <p></p>
            </div>
        </div>

		<div class="item">
            <img src=<?php echo $ic44 ?> alt="..." style="width:100%;height:300px;">

            <div class="carousel-caption">


                <p></p>
            </div>
        </div>

		<div class="item">
            <img src=<?php echo $ic55 ?> alt="..." style="width:100%;height:300px;">

            <div class="carousel-caption">


                <p></p>
            </div>
        </div>
        
         <div class="item">
            <img src=<?php echo $ic66 ?> alt="..." style="width:100%;height:300px;">

            <div class="carousel-caption">


                <p></p>
            </div>
        </div>
        
        
        
    </div>
    <!-- Controls -->
    <a class="left carousel-control" href="#my-carousel" role="button" data-slide="prev">

      <span class="icon-prev"></span>

    </a>
    <a class="right carousel-control" href="#my-carousel" role="button" data-slide="next">

       <span class="icon-next"></span>
    </a>

<!-- #my-carousel-->

			</div>


		<br />
			 <div class="alert alert-success">

                      <!--  &nbsp; &nbsp; quis noLorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,strud exercitation ullamco laboris nisi ut aliquip ex ea commodoconsequat. Duis aute irure dolor in reprehenderit in voluptate velit essecillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat nonproident, sunt in culpa qui officia deserunt mollit anim id est laborum.
-->   </div>
					<br />

			<div class="alert alert-default" style="background-color:#033c73;">
                       <p style="color:white;text-align:center;">
                       &copy 2020 Ratatouille | Todos los derechos reservados | Harry Palma
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

							<p>Contraseña:</p>
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
