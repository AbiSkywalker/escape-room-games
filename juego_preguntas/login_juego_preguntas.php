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
                 $query = $conn->prepare("SELECT id, nombre FROM equipospreguntas WHERE idweb = ?");
                 $query->bind_param("s", $idweb);
                 $query->execute();
                 
                 $query->store_result();

                 if ($query->num_rows > 0){
                         
                         $query->bind_result($id, $nombre);
                         
                         
                         while ($query->fetch()){
                              //CREAR SESION Y REDIRIGIR
                              session_start();
                                                            
                              $_SESSION['session_id']  = $idweb;
                              $_SESSION['equipo']  = $nombre;                
                         }
                 
                         $query->close();
                         
                         
                         header('Location: index.php');
                  } else{
                      header('Location: ../juego-preguntas.php?error=-2');//no se encuentra el grupo
                  }
 
        }    else {

          header('Location: ../juego-preguntas.php?error=-1');
        }  

?>
