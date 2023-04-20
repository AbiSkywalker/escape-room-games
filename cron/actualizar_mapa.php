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
   
   
$query = $conn->prepare("SELECT horainicio, lab1desactivado, lab2desactivado, lab3desactivado, lab4desactivado, lab5desactivado, lab6desactivado FROM equiposcron WHERE idweb = ?");
$query->bind_param("s", $idweb);
$query->execute();         
$query->bind_result($hini, $l1, $l2, $l3, $l4, $l5, $l6);
         

$completado = false;

while ($query->fetch()){
        //Compruebo si han recibido mail
        $_SESSION['lab1desactivado'] = $l1;
        $_SESSION['lab2desactivado'] = $l2;
        $_SESSION['lab3desactivado'] = $l3;
        $_SESSION['lab4desactivado'] = $l4;
        $_SESSION['lab5desactivado'] = $l5;
        $_SESSION['lab6desactivado'] = $l6;
        
        $jsondata['americanorte'] = $l1;
        $jsondata['americasur'] =  $l2;
        $jsondata['europa'] =  $l3;
        $jsondata['africa'] =  $l4;
        $jsondata['asia'] =  $l5;
        $jsondata['oceania'] =  $l6;
        if ($l1 && $l2 && $l3 && $l4 && $l5 && $l6){
                $completado = true;
                
        }
}

$query->close();

if($completado !== false){
        $fecha = new DateTime();
        $horafin = $fecha->getTimestamp();
        $query2 = $conn->prepare("UPDATE equiposcron SET horafin = '".$horafin."' WHERE idweb = ?");
        $query2->bind_param("s", $idweb);
        $query2->execute();
        $query2->close();

}
   
    $jsondata['success'] = true;
    $jsondata['completado'] = $completado;

    
    //Aunque el content-type no sea un problema en la mayoría de casos, es recomendable especificarlo
    //header('Content-type: application/json; charset=utf-8');
    echo json_encode($jsondata);
    exit();
    

   
?>