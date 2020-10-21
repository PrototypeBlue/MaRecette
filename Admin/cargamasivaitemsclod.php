<?php
	session_start();
	require 'recopass/funcs/conexion.php';
	include 'recopass/funcs/funcs.php';
	
	if(!isset($_SESSION["id_usuario"])){ //Si no ha iniciado sesión redirecciona a index.php
		header("Location: index.php");
	}
	
	$idUsuario = $_SESSION['id_usuario'];
	
	$sql = "SELECT id, nombre, apellido FROM usuarios WHERE id = '$idUsuario'";
	$result = $mysqli->query($sql);
	
	$row = $result->fetch_assoc();
	if($_SESSION['tipo_usuario']==2) {
header("Location: index.php");
}
?>
<!doctype html>
<?php
include "database.php";

//$datos = $con->query("select * from metas_cat_periodo_Cons");
$datos = $con->query("select Mensaje from mensajes");
$valresul = mysqli_fetch_array($datos);
?>
<html>

<head><meta http-equiv="Content-Type" content="text/html; charset=gb18030">
    <!--JQUERY-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    
    <!-- FRAMEWORK BOOTSTRAP para el estilo de la pagina-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    
    <!-- Required meta tags -->
    
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="it">
    <meta name="keywords"
        content="Rapoo,creative, agency, startup, Mobicon,onepage, clean, modern,business, company,it">
    <meta name="author" content="kciusbad">

    <!-- Plugins CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/fonts/themify/themify-icons.css">

    <link rel="stylesheet" href="assets/css/slick.css">
    <link rel="stylesheet" href="assets/css/slick-theme.css">
    <link rel="stylesheet" href="assets/css/all.css">

    <!-- Theme CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
    <link rel="stylesheet" href="assets/css/formulario.css">
    <link rel="stylesheet" href="assets/css/formularioventa.css">
    <title>VD&M Venta Diaria y Metas</title>
</head>


<body>
 <!-- HEADER
    ================================================= -->
    <?php include("php/header.php") ?>
    
    <!-- NAVBAR
    ================================================= -->
    <div class="main-navigation" id="mainmenu-area">
        <div class="container">
        <?php include("php/menu.php") ?>
        </div> <!-- / .container -->
    </div>

    <!-- HERO
    ================================================== -->
    <section class="section" id="services-2">
        <div class="container">
            <?php include("php/seccioncargametas.php") ?>
        </div> <!-- / .container -->
    </section>    
 <!-- FOOTER
    ================================================== -->
    <footer class="section " id="footer">
        <?php include("php/footer.php") ?>
    </footer>
    
    <!-- JAVASCRIPT
    ================================================== -->
    <!-- Global JS -->

    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/popper.min.js"></script>

    <!-- Plugins JS -->
    <script src="assets/js/bootstrap.min.js"></script>

    <!-- Slick JS -->
    <script src="assets/js/jquery.easing.1.3.js"></script>
    <script src="assets/js/slick.min.js"></script>
    <!-- Theme JS -->
    <script src="assets/js/theme.js"></script>
  

</body>

</html>
<script type="text/javascript">
$(document).ready(function () {
    //Disable cut copy paste
    $('body').bind('cut copy paste', function (e) {
        e.preventDefault();
    });
   
    //Disable mouse right click
    $("body").on("contextmenu",function(e){
        return false;
    });
});
</script>