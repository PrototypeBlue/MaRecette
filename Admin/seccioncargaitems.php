 
                            <section class="content-form">
			                    <h2 class="sub-title">Recepciones de Inventarios/Precios/Estatus</h2>
			                       
				                        <div class="form-group width-12">
				                            
				                            
					                        <h4 class="sub-form">Descargue y complete la plantilla</h4>
    					                        <div class="form-group width-12">
    					                             <div class="text-left">
	                                       <button class="btn-primary btn-xs" id="btn-abrir-popup" onclick="enviarCalculo()" >Generar Plantilla</button>
	                           
	                           </div>  
	                           
	                           
	        				                        <a id="content1"  href="Plantilla_Carga_Inventarios_Prc_Estatus.xlsx">Descargar Plantilla</a>
	        				                      <div id="cargar" class="loading"><img src="item_images/loader.gif"/><br/>Un momento, por favor...</div>
	        				                        
					                                    
					        </div>
					       
			    		                        </div>
			    		                        <div class="form-group width-12">
			    		                          
					                               
                                                <h3 class="sub-form"></h3>
                                                <div class="form-group width-12">
                                                    <form method="POST" id="addproduct" action="import.php" enctype="multipart/form-data" role="form">
                                                        
                                                     </div>
                                                        <div class="form-group width-12">
                                                            <input type="file" name="name"  id="name" placeholder="Archivo (.xlsx)">
                                                        </div>
                                                        <div class="form-group width-12">
                                                            <button type="submit" class="btn-primary btn-xs">Cargar</button>
                                                            
                                                            <br>
                                                            <br>
                                                            <h4 class="sub-form">Resultado :
                                                            <?php 
                                                               include 'db_conection.php';
                                                               $query="SELECT `Id`, `Mensaje` FROM `mensajes`";
	                                                            $resultado = $dbcon->query($query);
                                                                while ($fila = $resultado->fetch_assoc()) {
                                                                   echo  $fila['Mensaje'];
                                                                }
                                                                $close = mysqli_close($dbcon);        
                                                            ?>


                                                            </h4>
                                                          
                                                        </div>
                                                        
                                                    </form>
                                                </div>
                                                
                                        </div>
                                        
 			                         <br>
					                                    
                            </section>
                            
   <script type="text/javascript">
   
      $("#content1").hide();
     $("#cargar").hide();
 
   
    function recargarCat(){
             $("#content1").hide();
           $("#btn-abrir-popup").show();
                 
                 
             }
   
       function enviarCalculo(){
   
      
      
      
    
   $("#cargar").show();
  
      
      $.ajax({
                        type: 'POST',
                      
                         url: 'ExcelPlanilla1.php',
                         
                          beforeSend: function () {
                        $("#resultado").html("Procesando, espere por favor...");
                },
                         
                          success: function(response){
                             
                              $("#content1").show();
                              $("#btn-abrir-popup").hide();
                              $("#cargar").hide();
                                   }
           
                      }); 
      
      
      
     
 }
    
     
    
    
</script>