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

   //1 Laboratorio Fenix, norteamerica: electrico, el regulador de potencia entre 60 y 40% desactiva el laboratorio
   $l1 = array('v-min' => '20', 'v-max' => '60');
   
   //2 Laboratorio Grifo: redes. Poner una en el canal 5 y otra en el 6 desactiva el laboratorio
   $l2 = array('canales' => [5,6]);
   
   //3 Laboratorio Esfinge: entorno
   $l3 = array('t-max' => '20', 'h-min' => '40', 'h-max'=> '65');

   //Laboratorio 4: atmosfera: a menos de -10 o a mas de 46º, se desactiva la criogenizacion
   $l4 = array('t-min' => '-1000', 't-max' => '-40');   
   
   //Laboratorio 5: sistemas de riego. Modificar compuertas. false = cerrada, true = abierta
   $l5 = array('c1' => true, 'c2' => true, 'c3' => true, 'c4' => false);   
   
   //Laboratorio 6: Navegacion. Fijar rumbo noreste y aumentar potencia helices
   $l6 = array('rumboy' => 'N', 'grados' => '10', 'rumbox' => 'E', 'vel-min' => '70');   
   

   $destruido = false;
  // sleep(2);
   
   if ($_POST['codigo_lab'] != '') {
        $codigo = $_POST['codigo_lab'];

 
        if ($codigo == 'XF103'){ //Lab Fenix: panel electrico
                if (isset($_POST['voltaje']) && $_POST['voltaje'] <= 20){
                        $jsondata['success'] = false;
                        $jsondata['message'] = 'errparametros';
                        
                }else if (isset($_POST['voltaje'])){
                        //parametros exactos para destruir. se establecera conexion con generadores auxiliares
                        if (($_POST['voltaje'] > $l1['v-min']) && ($_POST['voltaje'] < $l1['v-max'])){
                                $destruido = true;
                                $jsondata['success'] = true;
                                $jsondata['message'] = 'parametrosko';
                                $jsondata['continentelab'] = 'americanorte';
                                //guardar en bd
                                $query = $conn->prepare("UPDATE equiposcron SET lab1desactivado = true WHERE idweb = ?");
                                $query->bind_param("s", $idweb);
                                $query->execute();
                                $query->close();
                                $_SESSION['lab1desactivado'] = true;
                                $actualizar = 'cookie de ejemplo'; // Valor de la cookie
                                setcookie('lab1desactivado', true, time() + 3600); // Crear cookie de 1h (3600s)
    
                        }else{ //parametros válidos, se establecen sin problema
                                $destruido = false;
                                $jsondata['success'] = false;
                                $jsondata['message'] = 'parametrosok';
                        }
                                
                } else { establecer_valores();}
                
                
                
        }elseif ($codigo == 'GF289'){ //2: Lab Grifo, sudamerica. configuracion de redes. Una debe estar en el 5 y otra en el 6
                if (isset($_POST['canal']) && isset($_POST['canal2'])){
                        if($_POST['canal'] == $_POST['canal2']){
                                $jsondata['success'] = false;
                                $jsondata['message'] = 'errparametros';
                        }else if (in_array($_POST['canal'], $l2['canales']) && in_array($_POST['canal2'], $l2['canales'])
                                && $_POST['canal'] != $_POST['canal2']){
                        //parametros exactos para destruir
                                $destruido = true;
                                $jsondata['success'] = true;
                                $jsondata['message'] = 'parametrosko';
                                $jsondata['continentelab'] = 'americasur';
                                //guardar en bd
                                $query = $conn->prepare("UPDATE equiposcron SET lab2desactivado = true WHERE idweb = ?");
                                $query->bind_param("s", $idweb);
                                $query->execute();
                                $query->close();
                                $_SESSION['lab2desactivado'] = true;
                                setcookie('lab2desactivado', true, time() + 3600); // Crear cookie de 1h (3600s)
                        }else{ //parametros válidos, se establecen sin problema
                                $destruido = false;
                                $jsondata['success'] = false;
                                $jsondata['message'] = 'parametrosok';
                        }
                                
                } else { establecer_valores();}
                
        }elseif ($codigo == 'GS554'){//Lab 3: modificar entorno
        
                if (isset($_POST['temp']) && isset($_POST['humedad']) && isset($_POST['oport'])){
                        if ($_POST['temp'] > $l3['t-max'] && ($_POST['humedad'] <= $l3['h-min'] || $_POST['humedad'] >= $l3['h-max'])){
                                //desactivar a los 3 cambios, NO ANTES
                                if($_POST['oport'] > 1){
                                        $destruido = false;
                                        $jsondata['success'] = false;
                                        $jsondata['message'] = 'errparametros';
                                }else{
                                        //parametros exactos para destruir
                                        $destruido = true;
                                        $jsondata['success'] = true;
                                        $jsondata['message'] = 'parametrosko';
                                        $jsondata['continentelab'] = 'europa';
                                        //guardar en bd
                                        $query = $conn->prepare("UPDATE equiposcron SET lab3desactivado = true WHERE idweb = ?");
                                        $query->bind_param("s", $idweb);
                                        $query->execute();
                                        $query->close();
                                        $_SESSION['lab3desactivado'] = true;
                                        setcookie('lab3desactivado', true, time() + 3600); // Crear cookie de 1h (3600s)
                                }
                        }else{ //parametros válidos, se establecen sin problema
                                $destruido = false;
                                $jsondata['success'] = false;
                                $jsondata['message'] = 'parametrosok';
                        }
                                
                } else { establecer_valores();}
        }elseif ($codigo == 'MD351'){//Lab 4: atmosfera
        
                if (isset($_POST['temperatura'])){
                        if ($_POST['temperatura'] > $l4['t-max'] || $_POST['temperatura'] < $l4['t-min']){
                        //parametros exactos para destruir
                                $destruido = true;
                                $jsondata['success'] = true;
                                $jsondata['message'] = 'parametrosko';
                                $jsondata['continentelab'] = 'africa';
                                //guardar en bd
                                $query = $conn->prepare("UPDATE equiposcron SET lab4desactivado = true WHERE idweb = ?");
                                $query->bind_param("s", $idweb);
                                $query->execute();
                                $query->close();
                                $_SESSION['lab4desactivado'] = true;
                                setcookie('lab4desactivado', true, time() + 3600); // Crear cookie de 1h (3600s)
                        }else{ //parametros válidos, se establecen sin problema
                                $destruido = false;
                                $jsondata['success'] = false;
                                $jsondata['message'] = 'parametrosok';
                        }
                                
                }else { establecer_valores();}
        }elseif ($codigo == 'GA910'){//Lab 5: drenaje
                
                $c1 = false;
                $c2 = false;
                $c3 = false;
                $c4 = false;
                 
                if (isset($_POST['c1'])){ $c1 = true;}
                if (isset($_POST['c2'])){ $c2 = true;}
                if (isset($_POST['c3'])){ $c3 = true;}
                if (isset($_POST['c4'])){ $c4 = true;}
                
                if ($c1 == $l5['c1'] && $c2 == $l5['c2'] && $c3 == $l5['c3'] && $c4 == $l5['c4']){
                //parametros exactos para destruir
                        $destruido = true;
                        $jsondata['success'] = true;
                        $jsondata['message'] = 'parametrosko';
                        $jsondata['continentelab'] = 'asia';
                        //guardar en bd
                        $query = $conn->prepare("UPDATE equiposcron SET lab5desactivado = true WHERE idweb = ?");
                        $query->bind_param("s", $idweb);
                        $query->execute();
                        $query->close();
                        $_SESSION['lab5desactivado'] = true;
                        setcookie('lab5desactivado', true, time() + 3600); // Crear cookie de 1h (3600s)
                }else{//parametros válidos, se establecen sin problema
                        $destruido = false;
                        $jsondata['success'] = false;
                        $jsondata['message'] = 'parametrosok';
                }
                
        }elseif ($codigo == 'LP739'){//Lab 6: navegacion

                
                if (isset($_POST['rumboy']) && isset($_POST['rumbox']) && isset($_POST['gradosrumbo']) && isset($_POST['velocidad'])){
                
                        if ($_POST['rumboy'] == $l6['rumboy'] && $_POST['rumbox'] == $l6['rumbox'] && 
                                $_POST['gradosrumbo'] == $l6['grados'] && $_POST['velocidad'] >= $l6['vel-min']){
                                //parametros exactos para destruir
                                        $destruido = true;
                                        $jsondata['success'] = true;
                                        $jsondata['message'] = 'parametrosko';
                                        $jsondata['continentelab'] = 'oceania';
                                        //guardar en bd
                                        $query = $conn->prepare("UPDATE equiposcron SET lab6desactivado = true WHERE idweb = ?");
                                        $query->bind_param("s", $idweb);
                                        $query->execute();
                                        $query->close();
                                        $_SESSION['lab6desactivado'] = true;
                                        setcookie('lab6desactivado', true, time() + 3600); // Crear cookie de 1h (3600s)
                        }else{ //parametros válidos, se establecen sin problema
                                $destruido = false;
                                $jsondata['success'] = false;
                                $jsondata['message'] = 'parametrosok';
                        }
                                
                }else { establecer_valores();}
        }else{
                $jsondata['success'] = false;
                $jsondata['message'] = 'Acceso restringido.';
        }
        
   } else{
   
        $jsondata['success'] = false;
        $jsondata['message'] = 'Acceso restringido.';

    }
    
    //Aunque el content-type no sea un problema en la mayoría de casos, es recomendable especificarlo
    //header('Content-type: application/json; charset=utf-8');
    echo json_encode($jsondata);
    exit();
    
    
    function establecer_valores(){
            foreach($_POST as $param => $valor){
                    
                    $destruido = false;
                    $jsondata['success'] = false;
                    $jsondata['message'] = 'parametrosok';
                    echo json_encode($jsondata);
                    exit();
            }
    
    }
   
?>