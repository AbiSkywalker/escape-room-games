<?php
   
   session_start();
   if (!isset($_SESSION['session_id']) || $_SESSION['session_id'] == ''){
         header('Location: ../index.php');//redirigir
   }
   
   $idweb = $_SESSION['session_id'];
   include("includes/connect.php");

   $conn = new mysqli($servername, $username, $password, $db);

   // Check connection
   if ($conn->connect_error) {
           die("Error de conexion: " . $conn->connect_error);
   }
   
   
   
   if (isset($_POST['clave_introducida']) && $_POST['clave_introducida'] == '8088'){
   

           //PONER HORA FIN SI NO ESTÁ PUESTA!!
           $query = $conn->prepare("SELECT cajaabierta, horainicio, horafin FROM equiposlunanegra WHERE idweb = ?");
           $query->bind_param("s", $idweb);
           $query->execute();         
           $query->bind_result($caja_abierta, $horainicio, $horafin);                         
                
           while ($query->fetch()){
           
                if ($caja_abierta != true && $horafin == null){ //SI NO TIENE HORA FIN; PONGO CAJA ABIERTA Y HORA ACTUAL
                        $queryupdate = "UPDATE equiposlunanegra SET cajaabierta = true, horafin = now() WHERE idweb = ?";
                } else if ($caja_abierta != true){ //Tiene hora fin pero no esta puesto caja abierta
                        $queryupdate = "UPDATE equiposlunanegra SET cajaabierta = true WHERE idweb = ?";
                }
           }
        
           $query->close();
           
           
           if($queryupdate){
                   $query2 = $conn->prepare($queryupdate);
                   $query2->bind_param("s", $idweb);
                   $query2->execute();
                   $query2->close();
           }
        
           $_SESSION['caja_abierta'] = true;
           $jsondata['caja_abierta'] = true;
           $jsondata['redirigir'] = 'juego_completado.php';
           
           
   } else {
        
        $jsondata['caja_abierta'] = false;

   }


echo json_encode($jsondata);
exit();

   
?>