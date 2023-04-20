<?php

 //ECHAR SI NO HAY SESION
 session_start();
 if (!isset($_SESSION['session_id']) || $_SESSION['session_id'] == ''){
         header('Location: ../index.php');//redirigir
 } else{
 
   include("includes/connect.php");
   $idweb = $_SESSION['session_id'];
   $conn = new mysqli($servername, $username, $password, $db);

   // Check connection
   if ($conn->connect_error) {
           die("Error de conexion: " . $conn->connect_error);
   }
   
   $query = $conn->prepare("update equiposlunanegra set pistasolicitada = true where idweb = ?");
   $query->bind_param("s", $idweb);
   $query->execute();
   $res = $query->affected_rows;
   $query->close();
                 
        
   return $res;
 
}
?>