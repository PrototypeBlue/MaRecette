<?php
session_start();
$razsoc=$_SESSION['razsoc'] ;
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
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation" >
            <div class="navbar-header" style="background-color:#142f28;">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse" >
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php" ><?php echo $razsoc?> - Administrator Panel</a>
            </div>
            <div class="collapse navbar-collapse navbar-ex1-collapse" style="background-color:#142f28;">
                <ul class="nav navbar-nav side-nav" li style="background-color:#303030;">
                <?php include("menulateral.php") ?>
					
                    
                </ul>
                <ul class="nav navbar-nav navbar-right navbar-user" style="background-color:#142f28;">
                    <li class="dropdown messages-dropdown" >
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
            
			
			
			
			
			
			
			
			
		
	<head>
		<title>Subir Multiples Imagenes - Evilnapsis</title>
		  <link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css">

	</head>
	<body>



		<div class="container" >
			<div class="row">
				<div class="col-md-12">
                    <div class="alert alert-default" style="color:white;background-color:#4d1522"><h1 style="color:white;text-align:center;" >Imagenes</h1></div>
		<a href="./form.php" class="btn btn-default">Agregar Imagen</a> 
		<br><br>
		<?php if(count($images)>0):?>
				<table class="table table-bordered" style="background-color:#DD948C;">
					<thead>
						<th>Imagen</th>
						<th>Texto a mostrar</th>
						<th>
					</thead>
			<?php foreach($images as $img):?>
				<tr>
				<td><img src="<?php echo $img->folder.$img->src; ?>" style="width:240px;">				</td>
				<td><?php echo $img->title; ?></td>
				<td>
				<a class="btn btn-success" href="./download.php?id=<?php echo $img->id; ?>">Descargar</a> 
				<a class="btn btn-danger" href="./delete.php?id=<?php echo $img->id; ?>">Eliminar</a>
			</td>
				</tr>
			<?php endforeach;?>
</table>
		<?php else:?>

			<h4 class="alert alert-warning">No hay imagenes!</h4>
		<?php endif; ?>
</div>
</div>
</div>
	</body>

</html>
