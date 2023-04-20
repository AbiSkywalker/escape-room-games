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
        $laboratorios = [];
        
        
        $query = $conn->prepare("SELECT id, codigo, coordenadax, coordenaday, nombre FROM laboratorioscron");
        
        $query->execute();         
        $query->bind_result($id, $codigo, $x, $y, $nombre);
        
        while ($query->fetch()){
                
                $labquery = 'lab'.$id.'desactivado';
                
                $opciones = ['electricidad', 'redes', 'atmosfera', 'entorno'];
                if ($id == 5){
                        $opciones = ['electricidad', 'redes', 'atmosfera', 'drenaje'];
                }elseif ($id == 6){
                        $opciones = ['electricidad', 'redes', 'atmosfera', 'navegacion'];
                }
                
                $lab = array( 'codigo'=> $codigo, 'x'=>$x, 'y'=>$y, 'nombre'=>$nombre,
                           'opciones' => $opciones, 'labquery' => $labquery);
                           
                array_push($laboratorios, $lab);
        }
        $query->close();
        
        
           $encontrado = false;
          // sleep(2);
           
           if ($_POST['codigolab'] != '' && $_POST['coordx'] != '' && $_POST['coordy'] != '') {
                $codigo = $_POST['codigolab'] ;
                $coordx = $_POST['coordx'];
                $coordy = $_POST['coordy']; 
                
                //Buscar en laboratorios
                
                
                foreach ($laboratorios as $l){
                        if ($l['codigo'] == $codigo && $l['x'] == $coordx && $l['y'] == $coordy){
                                //comprobar si esta ya desactivado
                                
                                $query = $conn->prepare("SELECT ".$l['labquery']." FROM equiposcron WHERE idweb = ?");
                                $query->bind_param("s", $idweb);
                                $query->execute();         
                                $query->bind_result($desactivado);
                                
                                while ($query->fetch()){
                                        $lab_desactivado  = $desactivado;
                                }
                                
                                $query->close();
                                if($lab_desactivado == 0){
                                
                                        $encontrado = true;
                                        $jsondata['success'] = true;
                                        $jsondata['message'] = 'Laboratorio encontrado: '.$l['nombre'];
                                        $jsondata['labName'] = $l['nombre'];
                                        $jsondata['labquery'] = $l['labquery'];
                                        $jsondata['desactivado'] = $lab_desactivado;
                                        $jsondata['htmlcontent'] = generar_html($l['opciones']);
                                }
                        }
                }
           }
        
           
           if ($encontrado !== true){
                $jsondata['success'] = false;
                $jsondata['message'] = 'Acceso restringido.';
        
            }
            
            function generar_html($opciones){
                    $html = '';
                                
                        if(in_array ('electricidad', $opciones)){
                                $html .= '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#panel-electrico">Panel eléctrico</button>';
                        }
                        if(in_array ('redes', $opciones)){
                                $html .= '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#panel-redes">Redes</button>';
                        }
                        
                        if(in_array ('entorno', $opciones)){
                                $html .= '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#panel-entorno">Entorno</button>';
                        }
                        
                        if(in_array ('atmosfera', $opciones)){
                                $html .= '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#panel-atmosfera">Atm&oacute;sfera</button>';
                        }
                        
        
                        if(in_array ('drenaje', $opciones)){
                                $html .= '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#panel-drenaje">Drenaje</button>';
                        }
                        if(in_array ('navegacion', $opciones)){
                                $html .= '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#panel-navegacion">Navegacion</button>';
                        }
                        
                    return $html;
            }
        
            //Aunque el content-type no sea un problema en la mayoría de casos, es recomendable especificarlo
            //header('Content-type: application/json; charset=utf-8');
            echo json_encode($jsondata);
            exit();

?>