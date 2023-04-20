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
   
   
   if (isset($_POST['puzzle_completado']) && $_POST['puzzle_completado'] != 0){
           $puzzle_completado_id = $_POST['puzzle_completado'];
           
           $query2 = $conn->prepare("UPDATE equiposlunanegra SET puzzlecompletado = ? WHERE idweb = ?");
           $query2->bind_param("ss", $puzzle_completado_id, $idweb);
           $query2->execute();
           $query2->close();
           
           
           $_SESSION['puzzle_completado'] = $puzzle_completado;
           
           $jsondata['success'] = true;
           $jsondata['completado'] = $completado;
           $jsondata['redirigir'] = 'papeles.php?puzzle_completado='.$puzzle_completado_id;
           
           
   } else {
   
           $query = $conn->prepare("SELECT puzzlecompletado FROM equiposlunanegra WHERE idweb = ?");
           $query->bind_param("s", $idweb);
           $query->execute();         
           $query->bind_result($puzzle_completado);
                         
                
           $completado = false;
                
        while ($query->fetch()){
                //Compruebo si han completado el puzzle
                $_SESSION['puzzle_completado'] = $puzzle_completado;
                
                $jsondata['puzzle_completado'] = $puzzle_completado;
                if ($puzzle_completado){
                        $completado = true;
                        $jsondata['redirigir'] = 'papeles.php?puzzle_completado=1';
                }
        }
        
        $jsondata['success'] = false;
        $jsondata['completado'] = $completado;
        
        $query->close();
   }


echo json_encode($jsondata);
exit();

   
?>