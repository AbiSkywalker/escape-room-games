<?php

        include("includes/connect.php");


        // Create connection
        $conn = new mysqli($servername, $username, $password, $db);
        
        // Check connection
        if ($conn->connect_error) {
            die("Error de conexion: " . $conn->connect_error);
        }

        $error = 0;
        $sesion_iniciada = false;
        
        $querysetinicio = '';

        if (isset($_POST["idgrupo"])){
                 $idweb = $_POST["idgrupo"];
                 
                 //comprobar si existe el id de grupo
                 $query = $conn->prepare("SELECT id, nombre, horainicio FROM equiposlunanegra WHERE idweb = ?");
                 $query->bind_param("s", $idweb);
                 $query->execute();
                 
                 $query->store_result();

                 if ($query->num_rows > 0){
                         
                         $query->bind_result($id, $nombre, $horainicio);
                         
                         
                         while ($query->fetch()){
                              //CREAR SESION Y REDIRIGIR
                              
                              session_start();
                              if ($horainicio <= 0){
                                      $querysetinicio = "UPDATE equiposlunanegra set horainicio = now() WHERE id = ".$id; 
                              }
                              
                              $_SESSION['session_id']  = $idweb;
                              $_SESSION['equipo']  = $nombre;                
                         }
                 
                         $query->close();
                         
                         if($querysetinicio!=''){
                                 //Establecemos hora de inicio en bd
                                 $query2 = $conn->prepare($querysetinicio);
                                 $query2->execute();
                                 $res = $query2->affected_rows;
                                         
                                 $query2->close();
                         }
                         
                          header('Location: index.php');
                  } else{
                      header('Location: ../escape-room-luna-negra.php?error=-2');//no se encuentra el grupo
                  }
 
        }    else {

          header('Location: ../escape-room-luna-negra.php?error=-1');
        }  

?>
