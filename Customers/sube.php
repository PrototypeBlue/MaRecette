<?php 

//$dbcon=new mysqli("localhost:3306","servido2","7joi2k3PJ8","servido2_dbrecette");
//Conexión de prueba
	$db_host="localhost";
	$db_name="wtqrtflo_innova";
	$db_user="root";
	$db_pass="";
    include 'simplexlsx.class.php';
    $xlsx = new SimpleXLSX( 'countries_and_population.xlsx' );
    try {
       $conn = new PDO( "mysql:host=$db_host;dbname=$db_name", "$db_user", "$db_pass");
       $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $e)
    {
        echo $sql . "<br>" . $e->getMessage();
    }



$user_id = $_POST['user_id'];
$nombre=$_FILES['archivo']['name'];
$guardado=$_FILES['archivo']['tmp_name'];

if(!file_exists('archivos')){
	mkdir('archivos',0777,true);
	if(file_exists('archivos')){
		if(move_uploaded_file($guardado, $nombre)){
			echo "Archivo guardado con exito";
		}else{
			echo "Archivo no se pudo guardar";
		}
	}
}else{
	if(move_uploaded_file($guardado, $nombre)){
		echo "Archivo guardado con exito";
	}else{
		echo "Archivo no se pudo guardar";
	}
}

echo ( $user_id);
$xlsx = new SimpleXLSX( $nombre );

 $stmt = $conn->prepare( "INSERT INTO faltantes (codigo, proyecto, correo, email, estado,url_encuesta) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bindParam( 1, $rank);
    $stmt->bindParam( 2, $country);
    $stmt->bindParam( 3, $population);
    $stmt->bindParam( 4, $date_of_estimate);
    $stmt->bindParam( 5, $powp);
    $stmt->bindParam( 6, $url);
    
     foreach ($xlsx->rows() as $fields)
    {
        $rank = $fields[0];
        $country = $fields[1];
        $population = $fields[2];
        $date_of_estimate = $fields[3];
        $powp = $fields[4];
        $url = $fields[5];
        $stmt->execute();
    }
    
    


?>