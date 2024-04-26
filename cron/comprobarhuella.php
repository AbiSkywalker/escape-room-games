<?php

   $upload_success = false;
   $extra = '';
   sleep(2);

   $orig_size = filesize(getcwd()."/img/indice_dcho.jpg");
   /*var_dump($_POST);
   echo "<br>--------------------------<br>";

   var_dump($_FILES);
   echo "<br>--------------------------<br>";
   var_dump($orig_size);
   echo "<br>--------------------------<br>";*/

   if (!empty($_FILES['fingerprintfile']['tmp_name'])) {
        $new_size =  $_FILES['fingerprintfile']['size'];

        if($orig_size != $new_size){
                $extra = "distinto tamaño";
                $upload_success = false;
        }else{
                
                $extra = "mismo tamaño";
                $original = sha1_file(getcwd()."/img/indice_dcho.jpg");
                $subido = sha1_file( $_FILES['fingerprintfile']['tmp_name'] );
                /*echo "<br>".$original;
                echo "<br>".$subido;*/
                if ($subido === $original){
                        $extra .= " -  mismo sha1";
                        $upload_success = true;
                }else{
                        $extra .= " - distinto sha1";
                        $upload_success = false;
                }
        }
        
        
   } else if (!empty($_POST['fingerprintfile'])){
        //Si se ha subido por url, en principio devuelvo false.
        $original = sha1_file(getcwd()."/img/indice_dcho.jpg");
        $subido = false;

        $current_url = "http://" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
        $main_url = substr_replace($current_url, '', -19); //comprobarhuella.php
        $extra = 'subido por url';
         
        //pero si se ha subido una url local, comparo los archivos
        if (strstr($_POST['fingerprintfile'], $main_url)){
                $path_subido = str_replace($main_url, "", $_POST['fingerprintfile']);
                $new_size = filesize( $path_subido);
                $subido = sha1_file($path_subido);
                $extra = 'subido por url local';
        }


         if ($subido === $original){
                 $upload_success = true;
         }   
   }

   
   if ($upload_success){
        $jsondata['success'] = true;
        $jsondata['extra'] = $extra;
        $jsondata['message'] = 'Acceso permitido. Gracias.';

    } else {

        $jsondata['success'] = false;
        $jsondata['extra'] = $extra;
        $jsondata['message'] = 'Acceso restringido.';

    }

    //Aunque el content-type no sea un problema en la mayoría de casos, es recomendable especificarlo
    header('Content-type: application/json; charset=utf-8');
    echo json_encode($jsondata);
    exit();
    
   
?>