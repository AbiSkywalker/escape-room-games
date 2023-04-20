<?php
   session_start();
   if (!isset($_SESSION['session_id']) || $_SESSION['session_id'] == ''){
         header('Location: ../index.php');//redirigir
   }
   
   $idweb = $_SESSION['session_id'];
   //Actualizar sesion

   // Create connection
   include("includes/connect.php");
   $conn = new mysqli($servername, $username, $password, $db);

   // Check connection
   if ($conn->connect_error) {
           die("Error de conexion: " . $conn->connect_error);
   }

   
   if (isset($_POST['juego']) && isset($_POST['rating']) && isset($_POST['dificultad']) && isset($_POST['comentarios'])) {
     
     $juego = $_POST['juego'];
     $rating = $_POST['rating'];
     $dificultad = $_POST['dificultad'];
     $comentarios = $_POST['comentarios'];
     
     $query = $conn->prepare("INSERT INTO valoraciones(juego, id_equipo, puntuacion, dificultad, comentarios) VALUES (?,?,?,?,?)");
     $query->bind_param("sssss", $juego,$idweb,$rating,$dificultad,$comentarios);
     $query->execute();         
     $query->close(); 
     
     $jsondata['success'] = true;
     $jsondata['message'] = '¡Gracias por tu colaboración!';
        
   } else{
   
        $jsondata['success'] = false;
        $jsondata['message'] = 'Ups!! Parece que ha habido un error al guardar los datos :(';

    }
    
    
echo json_encode($jsondata);
exit();
   
?>