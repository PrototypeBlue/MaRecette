 
                            <section class="content-form">
			                    <h2 class="sub-title">Generacion de Pedidos Picking</h2>
			                       
				                        <div class="form-group width-12">
				                            
				                            
					                        <h4 class="sub-form">Descargue y complete la Plantilla con Cantidad Despachada</h4>
    					                        <div class="form-group width-12">
    					                             <div class="text-left">
	                                       <button class="btn-primary btn-xs" id="btn-abrir-popup" onclick="enviarCalculo()" >Generar Plantilla</button>
	                           
	                           </div>  
	                           
	                           
	        				                        <a id="content1"  href="Plantilla_Carga_Picking.xlsx">Descargar Plantilla</a>
	        				                      <div id="cargar" class="loading"><img src="item_images/loader.gif"/><br/>Un momento, por favor...</div>
	        				                        
					                                    
					        </div>
					       
			    		                        </div>
			    		                        <div class="form-group width-12">
			    		                          
					                               
                                                <h3 class="sub-form"></h3>
                                                <div class="form-group width-12">
                                                   
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
                      
                         url: 'ExcelPlanillapicking.php',
                         
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