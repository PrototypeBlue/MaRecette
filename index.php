<?php
error_reporting( ~E_NOTICE );
session_start();
$dbcon=new mysqli("localhost","root","","servido2_store"); //servidor, usuario de base de datos, contraseña del usuario, nombre de base de datos

$sql="SELECT `id`, `razsoc`, `rut`, `direccion`, `ciudad`, `pais`, `telefono`, `correo`, `iva`, `ic1`, `ic2`, `ic3`, `ic4`, `ic5`, `ic6` FROM `cia`";
 $resultado = $dbcon->query($sql);


    if ($resultado->num_rows>0) {
    $fila = $resultado->fetch_assoc();
     
    
        session_start();
        $_SESSION['razsoc'] =  $fila['razsoc'];
        $_SESSION['rut'] = $fila['rut'];
        $_SESSION['direccion'] =  $fila['direccion'];
        $_SESSION['ciudad'] =  $fila['ciudad'];
        $_SESSION['pais'] =   $fila['pais'];
        $_SESSION['telefono'] =  $fila['telefono'];
        $_SESSION['correo'] =  $fila['correo'];
        $_SESSION['iva'] =  $fila['iva'];
        
        $_SESSION['ic1']=$fila['ic1'];
        $_SESSION['ic2']=$fila['ic2'];
        $_SESSION['ic3']=$fila['ic3'];
        $_SESSION['ic4']=$fila['ic4'];
        $_SESSION['ic5']=$fila['ic5'];
        $_SESSION['ic6']=$fila['ic6'];
        
        $ic1=$fila['ic1'];
        
        
        $razsoc=  $fila['razsoc'];
        $direccion =  $fila['direccion'];
        $ciudad =  $fila['ciudad'];
        $pais =   $fila['pais'];
        $telefono =  $fila['telefono'];
        $correo =  $fila['correo'];
        
      
        
}
$dbcon->close();






?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  
<?php include('Header.php') ?>


</head>
<body >
   
 <div class="navbar navbar-inverse navbar-fixed-top " id="menu">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
               <!-- <img src="view.php?id=2" alt="Imagen desde Blob" />-->
                <a class="navbar-brand" href="#"><img class="logo-custom" src="view.php?id=2" alt=""  /></a>
            </div>
            <div class="navbar-collapse collapse move-me">
                <ul class="nav navbar-nav navbar-right">
          
					 
					  
					  <li><a href="#ayuda">¿Cómo se usa?</a></li>
					  
                     
                </ul>
            </div>
           
        </div>
    </div>
     
       <div class="home-sec" id="home" >
           <div class="overlay">
 <div class="container">
           <div class="row text-center " >
           
               <div class="col-lg-12  col-md-12 col-sm-12">
               
                <div class="flexslider set-flexi" id="main-section" >
                    <ul class="slides move-me">
                        <!-- Slider 01 -->
                        <li>
                              <h3>Productos de alta calidad</h3>
                           <h1>QUE ESTAS ESPERANDO? COMPRA AHORA!</h1>
                            <a  href="#features-sec" class="btn btn-warning btn-lg" data-toggle="modal" data-target="#ln">
                            INGRESAR
                            </a>
                             <a  href="#features-sec" class="btn btn-success btn-lg" data-toggle="modal" data-target="#su">
                               REGISTRATE
                            </a>
							
				            			<a  href="#features-sec" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#an">
                                ADMIN
                            </a>
                        </li>
                        <!-- End Slider 01 -->
                        
                        <!-- Slider 02 -->
                        <li>
                            <h3>Productos de alta calidad</h3>
                           <h1>TENEMOS LO QUE NECESITAS</h1>
                             <a  href="#features-sec" class="btn btn-warning btn-lg" data-toggle="modal" data-target="#ln">
                               INGRESAR
                            </a>
                             <a  href="#features-sec" class="btn btn-success btn-lg" data-toggle="modal" data-target="#su">
                                REGISTRATE
                            </a>
							
							<a  href="#features-sec" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#an">
                                ADMIN
                            </a>
                        </li>
                        <!-- End Slider 02 -->
                        
                        <!-- Slider 03 -->
                        <li>
                            <h3>Productos de alta calidad</h3>
                           <h1>TENEMOS TODAS LAS MARCAS</h1>
                             <a  href="#features-sec" class="btn btn-warning btn-lg" data-toggle="modal" data-target="#ln">
                                INGRESAR
                            </a>
                             <a  href="#features-sec" class="btn btn-success btn-lg" data-toggle="modal" data-target="#su">
                                REGISTRATE
                            </a>
		              					<a  href="#features-sec" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#an">
                                ADMIN
                            </a>
                        </li>
                        <!-- End Slider 03 -->
                    </ul>
                </div>
                   
     
              
              
            </div>
                
               </div>
                </div>
           </div>
           
       </div>
       <!--HOME SECTION END-->   
    <div  class="tag-line" >
         <div class="container">
           <div class="row  text-center" >
           
               <div class="col-lg-12  col-md-12 col-sm-12">
               
        <h2 data-scroll-reveal="enter from the bottom after 0.1s" ><i class="fa fa-circle-o-notch"></i>BIENVENIDOS AL "<?php echo $razsoc ?>" <i class="fa fa-circle-o-notch"></i> </h2>
                   </div>
               </div>
             </div>
        
    </div>
   
      <div id="course-sec" class="container set-pad">
             <div class="row text-center">
                 <div class="col-lg-8 col-lg-offset-2 col-md-8 col-sm-8 col-md-offset-2 col-sm-offset-2">
                     <h1 data-scroll-reveal="enter from the bottom after 0.1s" class="header-line">Contáctenos</h1>
                     <p data-scroll-reveal="enter from the bottom after 0.3s">
                     Si tiene alguna pregunta, no dude en contactarnos, nuestro centro de servicio al cliente está trabajando para usted las 24 horas, los 7 días de la semana.
Para más detalles. Vea la información de contacto a continuación..
                         </p>
                 </div>

             </div>


             <div id="ayuda" class="container set-pad">
             <div class="row text-center">
                 <div class="col-lg-8 col-lg-offset-2 col-md-8 col-sm-8 col-md-offset-2 col-sm-offset-2">
                     <h1 data-scroll-reveal="enter from the bottom after 0.1s" class="header-line">Comenzar a utilizar RATATOUILLE</h1>
                     <p data-scroll-reveal="enter from the bottom after 0.3s">
                     
                     <strong>Estas son las principales funciones que ofrecemos para ti:</strong> <br>
                     <strong>Selecciona los productos que van a tu inventario:</strong> Mira el gran apartado de productos que ofrecemos y añade la cantidad que poseas a tu inventario, de tal forma, podremos indicarte las recetas que podrás realizar en base a estos productos. </br>
                     <strong>Selecciona la receta a cocinar:</strong> Para observar las recetas que puedes realizar debes ir al apartado “Recetas disponibles”, al seleccionar alguna, podrás ver su preparación y sus ingredientes, no olvides colocar que la realizarás, pues automáticamente se descontará del inventario, ¡Así de sencillo! </br>
                     <strong>Añadir cesta:</strong> ¿No posees mucho tiempo para ingresar tus productos? ¡No hay problema! Hemos diseñado una función que añade diversos tipos de canastas a tu inventario basados en los productos que más se tienen por lo general en casa junto con su respectiva cantidad, puede servirte para algún apuro. </br>

                         </p>
                 </div>

             </div>
             <!--/.HEADER LINE END-->

<br />
           
             <div class="container">
             <div class="row set-row-pad"  >
    <div class="col-lg-4 col-md-4 col-sm-4   col-lg-offset-1 col-md-offset-1 col-sm-offset-1 " data-scroll-reveal="enter from the bottom after 0.4s">

                    <h2 ><strong>Direccion </strong></h2>
        <hr />
                    <div >
                        <h4><?php echo utf8_encode($direccion) ?></h4>
                        <h4><?php echo $ciudad."-".$pais?></h4>
					
                        
                    </div>


                </div>
                 <div class="col-lg-4 col-md-4 col-sm-4   col-lg-offset-1 col-md-offset-1 col-sm-offset-1" data-scroll-reveal="enter from the bottom after 0.4s">

                    <h2 ><strong>Comentarios </strong></h2>
        <hr />
                    <div >
                        <h4><strong>Telefono:</strong>  <?php echo $telefono?> </h4>
                        <h4><strong>Email: </strong><?php echo $correo?></h4>
                    </div>
                    </div>


                </div>
                 </div>
                 
                 
               </div>
             </div>
      <!-- COURSES SECTION END-->
     <div class="modal fade" id="su" tabindex="-1" role="dialog" aria-labelledby="myMediulModalLabel">
          <div class="modal-dialog modal-sm">
            <div style="color:white;background-color:#008CBA" class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Formulario de Registro</h4>
              </div>
              <div class="modal-body">
            
				
				 <form role="form" method="post" action="register.php">
                   <fieldset>
					
							<div class="form-group">
                                <input class="form-control" placeholder="Nombres" name="ruser_firstname" type="text" required>
							</div>
							
							<div class="form-group">
                                <input class="form-control" placeholder="Apellidos" name="ruser_lastname" type="text" required>
							</div>
							
							<div class="form-group">
                                <input class="form-control" placeholder="Direccion" name="ruser_address" type="text" value="Direccion" required>
							</div>
							
                            <div class="form-group">
                                <input class="form-control" placeholder="Email" name="ruser_email" type="email" required>
							</div>
							
							<div class="form-group">
                                <input class="form-control" placeholder="Password" name="ruser_password" type="password" required>
							</div>
				   
					 </fieldset>
                  
            
              </div>
              <div class="modal-footer">
               
                <button class="btn btn-md btn-warning btn-block" name="register">Registrar</button>
				
				 <button type="button" class="btn btn-md btn-success btn-block" data-dismiss="modal">Cancelar</button>
				   </form>
              </div>
            </div>
          </div>
        </div>
<!-- Script -->


     <div class="modal fade" id="ln" tabindex="-1" role="dialog" aria-labelledby="myMediulModalLabel">
          <div class="modal-dialog modal-sm">
            <div style="color:white;background-color:#008CBA" class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 style="color:white" class="modal-title" id="myModalLabel">Ingreso Clientes</h4>
              </div>
              <div class="modal-body">
            
				
				 <form role="form" method="post" action="userlogin.php">
                   <fieldset>
					
						
                            <div class="form-group">
                                <input class="form-control" placeholder="Email" name="user_email" type="email" required>
							</div>
							
							<div class="form-group">
                                <input class="form-control" placeholder="Password" name="user_password" type="password" required>
							</div>
				   
					 </fieldset>
                  
            
              </div>
              <div class="modal-footer">
               
                <button class="btn btn-md btn-warning btn-block" name="user_login">Ingresar</button>
				
                <button type="button" class="btn btn-md btn-success btn-block" data-dismiss="modal">Cancelar</button>
             
                
           </form>
          
               <button type="button" class="btn btn-md btn-warning btn-block" data-toggle="modal" data-target="#miModal">
	Olvido su Password </button>
              </div>
            </div>
          </div>
        </div>
		
		<div class="modal fade" id="an" tabindex="-1" role="dialog" aria-labelledby="myMediulModalLabel">
          <div class="modal-dialog modal-sm">
           <div style="color:white;background-color:#008CBA" class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 style="color:white" class="modal-title" id="myModalLabel">Administrator Credentials</h4>
              </div>
              <div class="modal-body">
            
				
				 <form role="form" method="post" action="adminlogin.php">
                   <fieldset>
					
						
                            <div class="form-group">
                                <input class="form-control" placeholder="Username" name="admin_username" type="text" required>
							</div>
							
							<div class="form-group">
                                <input class="form-control" placeholder="Password" name="admin_password" type="password" required>
							</div>
				   
					 </fieldset>
                  
            
              </div>
              <div class="modal-footer">
               
                <button class="btn btn-md btn-warning btn-block" name="admin_login">Login</button>
				
				 <button type="button" class="btn btn-md btn-success btn-block" data-dismiss="modal">Cancel</button>
				   </form>
              </div>
            </div>
          </div>
        </div>
		 <br />
			 <br />
			 <br />
<!-- Script -->
     <!-- CONTACT SECTION END-->
    <div id="footer">
    &copy 2020 Ratatouille | Todos los derechos reservados | Harry Palma  <a style="color: #fff" target="_blank"></a> </center>
    </div>
     <!-- FOOTER SECTION END-->
     

                  

<div class="modal fade" id="miModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      

        <h4>Recupere Su Password</h4>
											<form id="loginform" class="form-horizontal" role="form" action="recupera.php" method="POST" autocomplete="off">
												<div class="contenedor-inputs">
												<input id="email" type="email" class="form-control" name="email" placeholder="Ingrese email" required>
												</div>
												<button id="btn-login" type="submit" class="btn btn-success">Enviar Email</a>
												
											</form>
											
      </div>
    
    </div>
  </div>
</div>

    <script src="assets/js/popup.js"></script>
    <!--  Jquery Core Script -->
    <script src="assets/js/jquery-1.10.2.js"></script>
    <!--  Core Bootstrap Script -->
    <script src="assets/js/bootstrap.js"></script>
    <!--  Flexslider Scripts --> 
         <script src="assets/js/jquery.flexslider.js"></script>
     <!--  Scrolling Reveal Script -->
    <script src="assets/js/scrollReveal.js"></script>
    <!--  Scroll Scripts --> 
    <script src="assets/js/jquery.easing.min.js"></script>
    <!--  Custom Scripts --> 
         <script src="assets/js/custom.js"></script>
        
   

</body>
</html>
