<?php


$con=new mysqli("localhost","root","","servido2_store"); 
         if($con->connect_error){
             echo 'errordb'   ;
             die("Connection failed: " . $con->connect_error);
                }

            	$sql="SELECT
                `id`,
                `payment_id`,
                `amount`,
                `nropedido`,
                `payment_url`,
                `notification_token`,
                `status`
            FROM
                `tablakhipus`
            WHERE
            STATUS  = 'pending'";

	$result=mysqli_query($con,$sql);
    if (!$result) {
        trigger_error('Invalid query: ' . $con->error);
    }
     if ($result->num_rows>0) {
        
                require 'autoload.php';
                $id='qcavhpeqxint';
                $c = new Khipu\Configuration();
                $c->setSecret("96bf4fc0fbecbfa1042dbfc45d23148a763575a2");
                $c->setReceiverId(310615);
                //$c->setDebug(true);
                
                $cl = new Khipu\ApiClient($c);
                
                
                $kh = new Khipu\Client\PaymentsApi($cl);

                	while ($ver=mysqli_fetch_row($result)) {
                      $payment_id=$ver[1];
     
                        $r2 = $kh->paymentsIdGet($payment_id);
                        
                         $status=$r2->getstatus();
                         if($status=='done'){
                           $sql= "UPDATE `tablakhipus` SET `status`='done' WHERE nropedido=$ver[3]";
                           mysqli_query($con,$sql);  
                           $sql= "UPDATE `orderdetails` SET `order_status`='Ordered' where nropedido=$ver[3]"  ;
                           mysqli_query($con,$sql); 

                         }
                        // print_r('pedido : '.$ver[3].' Estatus : '.$status);
                        //  print_r('*****separacion*****');
        
           	}

         

               

}
 $close = mysqli_close($con);
   
?>