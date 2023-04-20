<?php



// Create connection

   include("includes/connect.php");
   $conn = new mysqli($servername, $username, $password, $db);


// Check connection
if ($conn->connect_error) {
    die("Error de conexion: " . $conn->connect_error);
}

$error = 0;
$sesion_iniciada = false;


if (isset($_POST["idgrupo"])){
         $idweb = $_POST["idgrupo"];
         
         //comprobar si existe el id de grupo
         $query = $conn->prepare("SELECT id, nombre, horainicio FROM equiposcron WHERE idweb = ?");
         $query->bind_param("s", $idweb);
         $query->execute();
         
         $query->store_result();

         if ($query->num_rows > 0){
                 
                 $query->bind_result($id, $nombre, $horainicio);
                 
                 
                 while ($query->fetch()){
                      //CREAR SESION Y REDIRIGIR
                      
                      
                      session_start();
                      if ($horainicio <= 0){
                              $fecha = new DateTime();
                              $horainicioset = $fecha->getTimestamp();
                              $querysetinicio = "UPDATE equiposcron set horainicio = ".$horainicioset." WHERE id = ".$id; 
                              $horainicio = $horainicioset;
                      }
                      
                      $_SESSION['session_id']  = $idweb;
                      $_SESSION['equipo']  = $nombre;
                      $_SESSION['horainicio'] = $horainicio;
                      $_SESSION['mailrecibido']  = false;
                      $_SESSION['horafin'] = false;
        
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
              header('Location: ../escape-room-cron.php?error=-2');//no se encuentra el grupo
          }
 
}    else {

  header('Location: ../escape-room-cron.php?error=-1');
}  

?>
