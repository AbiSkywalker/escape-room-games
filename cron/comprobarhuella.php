<?php


   $upload_success = false;
   sleep(2);
   if (!empty($_FILES['fingerprintfile']['tmp_name'])) {
   
         $original = file_get_contents(getcwd()."/img/indice_dcho.jpg");
         $subido = file_get_contents( $_FILES['fingerprintfile']['tmp_name'] );
        
         if ($subido === $original){
                 $upload_success = true;
         }
        
   } else if (!empty($_POST['fingerprintfile'])){
         //Si se ha subido por url, en principio devuelvo false.
         $original = file_get_contents(getcwd()."/img/indice_dcho.jpg");
         $subido = false;
        
         $current_url = "http://" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
         $main_url = substr_replace($current_url, '', -19);
         
         //pero si se ha subido una url local, comparo los archivos
         if (strstr($_POST['fingerprintfile'], $main_url)){
                 $path_subido = str_replace($main_url, "", $_POST['fingerprintfile']);
                 $subido = file_get_contents($path_subido);

         }


         if ($subido === $original){
                 $upload_success = true;
         }   
   }

   
   if ($upload_success){
        $jsondata['success'] = true;
        $jsondata['message'] = 'Acceso permitido. Gracias.';

    } else {

        $jsondata['success'] = false;
        $jsondata['message'] = 'Acceso restringido.';

    }

    //Aunque el content-type no sea un problema en la mayoría de casos, es recomendable especificarlo
    header('Content-type: application/json; charset=utf-8');
    echo json_encode($jsondata);
    exit();
    
   
?>