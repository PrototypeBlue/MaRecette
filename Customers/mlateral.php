

                <ul class="nav navbar-nav side-nav">
                    <li class="active"><a href="index.php"> &nbsp; <span class='glyphicon glyphicon-home'></span> Inicio</a></li>
                    <li><a href="PruebasFiltroReceta.php?id=1"> &nbsp; <span class='glyphicon glyphicon-shopping-cart'></span> Recetas disponibles</a></li>
					<li><a href="PruebaNuevaLista.php?"> &nbsp; <span class='glyphicon glyphicon-shopping-cart'></span> Ingredientes</a></li>
					<li><a href="cart_items.php"> &nbsp; <span class='fa fa-cart-plus'></span> Inventario de ingredientes</a></li>
				    <li><a href="recetas.php?id=1"> &nbsp; <span class='glyphicon glyphicon-list-alt'></span> Recetas</a></li>
					<li><a href="view_purchased.php"> &nbsp; <span class='glyphicon glyphicon-eye-open'></span> Historial de recetas</a></li>
					<li><a data-toggle="modal" data-target="#setAccount"> &nbsp; <span class='fa fa-gear'></span> Configuracion Cuenta</a></li>
					<li><a href="logout.php"> &nbsp; <span class='glyphicon glyphicon-off'></span> Cerrar sesión</a></li>


                </ul>
                <ul class="nav navbar-nav navbar-right navbar-user">
                    <li class="dropdown messages-dropdown">
                        <a href="#"><i class="fa fa-calendar"></i>  <?php
                        date_default_timezone_set("America/New_York");
                            $Today=date('y:m:d');
                            $new=date('l, F d, Y',strtotime($Today));
                          
                            echo $new; ?></a>

                    </li>
				
        
