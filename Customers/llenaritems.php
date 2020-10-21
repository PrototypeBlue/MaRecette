<?php


session_start(); // incio de uso de sesiones.




if (!isset($_SESSION['idinicio']))
{
  $_SESSION['idinicio'] =1;
}
else
{
  ++$_SESSION['idinicio'];
}
 






$procesar= $_SESSION['idinicio'];
$salida="nopaso";
if ($procesar==1){
$id=$_POST['id'];
$start=0;
$limit=8;
$start=($id-1)*$limit;
$dbcon=new mysqli("localhost","root","","servido2_store"); //servidor, usuario de base de datos, contraseña del usuario, nombre de base de datos

//$query1=mysql_connect("localhost","root","");
//mysql_select_db("store",$query1);



if(isset($_GET['id']))
{
    $id=$_GET['id'];
    echo $id;
	$start=($id-1)*$limit;
	
}

$query="select * from items LIMIT $start, $limit";
$salida="";
$result=mysqli_query($dbcon,$query);
while ($query2 = $result->fetch_assoc())
//while($query2=mysql_fetch_array($result))
{
	
	$salida.= "<div class='col-sm-3'><div class='panel panel-default' style='border-color:#008CBA;'>
            <div class='panel-heading' style='color:white;background-color : #033c73;'>
            <center> 
			<textarea style='text-align:center;background-color: white;' class='form-control' rows='1' disabled>".$query2['item_name']."</textarea>
			</center>
            </div>
           <div class='panel-body'>
           <a class='fancybox-buttons' href='../Admin/item_images/".$query2['item_image']."' data-fancybox-group='button' title='Page ".$id."- ".$query2['item_name']."'>
					
					<img src='../Admin/item_images/".$query2['item_image']."' class='img img-thumbnail'  style='width:350px;height:150px;' />
					</a>
				
					
					<center><h4> Precio: 	&#36; ".$query2['item_price']." </h4></center>
					
					<center><h4> Existencia:  ".$query2['candisp']." </h4></center>
					
					<a class='btn btn-block btn-danger' href='add_to_cart.php?cart=".$query2['item_id']."'><span class='glyphicon glyphicon-shopping-cart'></span> Agregar a la bolsa</a>
            </div>
          </div>
        </div>";
			
	
}

$salida.= "<div class='container'>";
$salida.="</div>";


$query="select * from items";
//mysqli_query($dbcon,$query)
$result=mysqli_query($dbcon,$query);
$rows=($result->num_rows);
$total=ceil($rows/$limit);
echo "<br /><ul class='pager'>";
if($id>1)
{
	$salida.= "<li><a style='color:white;background-color : #033c73;' href='?id=".($id-1)."'>Previous Page</a><li>";
}
if($id!=$total)
{
	$salida.= "<li><a style='color:white;background-color : #033c73;' href='?id=".($id+1)."' class='pager'>Next Page</a></li>";
}
$salida.="</ul>";


$salida.="<center><ul class='pagination pagination-lg'>";
		for($i=1;$i<=$total;$i++)
		{
			if($i==$id) {$salida.= "<li class='pagination active'><a style='color:white;background-color : #033c73;'>".$i."</a></li>"; }
			
	
			
			else {$salida.= "<li><a href='?id=".$i."'>".$i."</a></li>"; }
		}
        $salida.= "</ul></center>";
        }
        echo $salida; 
?>