<?php

/**
* Conexion a la base de datos y funciones
* Autor: evilnapsis
**/
//$dbcon=new mysqli("localhost","root","","store"); 
function con(){
	return new mysqli("localhost","root","","servido2_store");
}

function insert_img($title, $folder, $image){
	$con = con();
	$con->query("insert into image (title, folder,src,created_at) value (\"$title\",\"$folder\",\"$image\",NOW())");
}

function get_imgs(){
	$images = array();
	$con = con();
	$query=$con->query("select * from image");
	while($r=$query->fetch_object()){
		$images[] = $r;
	}
	return $images;
}

function get_img($id){
	$image = null;
	$con = con();
	$query=$con->query("select * from image where id=$id");
	while($r=$query->fetch_object()){
		$image = $r;
	}
	return $image;
}

function del($id){
	$con = con();
	$con->query("delete from image where id=$id");
}

// function delall($id){
// 	$con = con();
// 	$query=$con->query("select * from image order by id");
// 	while($r=$query->fetch_object()){
// 	    $valor=$r->folder.$r->src;
	   
	   
// 		unlink($r->folder.$r->src);
// 	}
	
	
// 	$con->query("delete from image ");
// 	$img='uploads/espaciopublicitario2.jpg';
// 	$con->query("UPDATE `cia` SET `ic1`='$img',`ic2`='$img',`ic3`='$img',`ic4`='$img',`ic5`='$img',`ic6`='$img'");
// }

// function modall($id){
// 	$con = con();

// 	$query=$con->query("select * from image order by id");
// 	$cont=1;
// 	while($r=$query->fetch_object()){
	   
// 	    $sql="update cia set ic$cont='$r->folder$r->src'";
	   
	  
// 		$con->query($sql);
// 		$cont=$cont+1;
		
		
// 	}
	

// }



?>