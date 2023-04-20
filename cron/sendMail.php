<?php

 //ECHAR SI NO HAY SESION
 session_start();
 if (!isset($_SESSION['session_id']) || $_SESSION['session_id'] == ''){
         header('Location: ../index.php');//redirigir
 } else{

// Create connection

   include("includes/connect.php");
   $conn = new mysqli($servername, $username, $password, $db);


// Check connection
if ($conn->connect_error) {
    die("Error de conexion: " . $conn->connect_error);
}



setlocale(LC_ALL, 'es_ES');


   $res = "0";
   
   $valsmail3 = '';
   
   if ($_POST["mensaje"] && $_POST["address"] && $_POST['asunto']){
           //Guardar mails enviados
           
             $asunto = $_POST['asunto'];
             $mensaje = $_POST['mensaje'];
             $para = $_POST['address'];
             $idgrupo = $_SESSION['session_id'];
             
             $query = $conn->prepare("INSERT INTO mails_enviados(asunto, mensaje, para, id_equipo) VALUES (?, ?, ?, (SELECT id FROM equiposcron WHERE idweb = ?))");
             $query->bind_param("ssss", $asunto, $mensaje, $para, $idgrupo);
             $query->execute();

             $res = $query->affected_rows;
 
             $query->close();
           
   
           if($_POST["address"] == 'mbuleni@cron.inc'){
           
                   
                   
                    //CREAR MENSAJE RESPUESTA
                    $from = 'Dr. Mbali Buleni';
                    $from_address = 'mbuleni@cron.inc';
                    $asunto_res = 'RE: '.$asunto;

                    
                    $mensaje_res = "<p>Goeie more!\n Lamento decirle que toda la información relacionada con CRON y sus actividades, es estrictamente confidencial incluso dentro de nuestra propia empresa. 
                    Por lo tanto, no estoy autorizado a compartirla con nadie que no pertenezca a mi equipo local. Siento no poder ayudarle, aunque somos compañeros no puedo facilitarle ningún dato.</p>";
                    $mensaje_res .= "<b>Totsiens!</b>";
                    $mensaje_res .= "<div class='firmamail'><p><b>Dr. Mbali Buleni</b></p>Encargado de la Reserva Natural<p></p></div>";
                    $mensaje_res .= "<div class='answeredmail'><p class='origmail'>Hoy a las ".date("H:i").", Luis Griso (&lt;lgriso@cron.inc&gt;) escribió:</p><p>".$mensaje."</p></div>";
                    $query = $conn->prepare("INSERT INTO mails_recibidos(remitente, remitenteaddress, asunto, mensaje, id_equipo, leido) VALUES (?, ?, ?, ?, (SELECT id FROM equiposcron WHERE idweb = ?), false)");
                    $query->bind_param("sssss", $from, $from_address, $asunto_res, $mensaje_res, $idgrupo);
                    $query->execute();
                    
                    $res = $query->affected_rows;
                    $query->close();
                    
                    $last_id = $conn->insert_id;
                    
                    //Marco en bd mail enviado
                    $query = $conn->prepare("UPDATE equiposcron SET mailenviado = true WHERE idweb = ?");
                    $query->bind_param("s", $idgrupo);
                    $query->execute();
                    
                    $res = $query->affected_rows;
                    $query->close();
                    
                   //Comprobar contenido del mensaje??
                    $res = $last_id;
                           
                   
           }
           else{
                   $res = "-2";
                   //redirigir
           }
   
   }           
   
   header('Location: inbox.php?mailsent='.$res);

}
?>