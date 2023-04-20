<?php

 //ECHAR SI NO HAY SESION
 session_start();
 if (!isset($_SESSION['session_id']) || $_SESSION['session_id'] == ''){
         header('Location: ../index.php');//redirigir
 } else{

    $searchstr = false;
    $array_found = [];
    if (trim($_GET['searchstr']) != ''){
            $searchstr = strtolower(trim($_GET['searchstr']));
                           
    }
    
    
?>

<html lang="es-ES" >
<head>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-167445149-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-167445149-1');
</script>

<title>CRON - Mis documentos - Búsqueda</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>


<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

<link href="css/all.css" rel="stylesheet"/>
<link rel="stylesheet" href="css/styles.css"/>
<script src="js/short_cut.js"></script>

<header class="bg-primary">
    <div class="text-right">
      <nav>
    <ul>
        <li>
                <a href="../index.php"><button class="btn btn-primary" id="login" data-toggle="modal" data-target="#modalLogin">Salir</button></a>

         </li>
         <li>
                 <button class="btn btn-primary" id="myid" data-toggle="modal" data-target="#modalSessionid">Mi ID</button>
                 

                  <div class="modal fade" id="modalSessionid" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Id de grupo</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                      <?=$_SESSION['session_id'];?>
                      </div>
                    </div>
                  </div>
                </div>
         </li>
         
         <li>
                 <button class="btn btn-primary" id="myid" data-toggle="modal" data-target="#modalPistas">Pista</button>
                 <div class="modal fade" id="modalPistas" tabindex="-1" role="dialog" aria-hidden="true">
                  <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Pistas</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                      <?=include ("pistas.html");?>
                      </div>
                    </div>
                  </div>
                </div>
         </li>
    </ul>
</nav>
    </div>
  </header>

  <div class="alert alert-success" id="success-alert">
    <button type="button" class="close" data-dismiss="alert">x</button>
    <strong>Correcto! </strong>
    Acceso secreto desbloqueado.
</div>
  <section id="main">
       
      <div class="row">
        <div class="col-md-3 loginsidebar">
                <ul class="loginmenu">
                         <li class=""> <a href="login.php">Mi perfil</a></li>
                         <li class=""><a href="inbox.php">Bandeja de entrada</a></li>
                         <li class="active"><a href="fileindex.php">Documentos</a></li>
                         <li class=""><a href="maps.php">WorldwideCRON</a></li>
                </ul>
        </div>
        <div class="col-md-8">
                
                
                <nav class="navbar navbar-light bg-light justify-content-between navbar_directorio">
                  <span class="navbar-brand" style="font-size: 15px; padding-left: 10px;">Resultados de búsqueda para: "<?=$searchstr?>"</span>
                  <form class="form-inline" action="#" method="GET">
                    <input class="form-control mr-sm-2" type="search" name="searchstr" placeholder="Search" aria-label="Search">
                    <input class="btn btn-outline-success my-2 my-sm-0 btn-info btbuscar" type="submit" value="Buscar"/>
                  </form>
                  </nav>
                
                <div class="row">
                        <?
                        
                        $it = new RecursiveDirectoryIterator("files");
                        $imgext = Array ( 'jpeg', 'jpg', 'png' );
                        $encontrados = [];
                        foreach(new RecursiveIteratorIterator($it) as $file) {
                        
                                if(strstr($file, '/mails/')){
                                        continue;
                                }
                                $foundpos = false;
                                $ruta = '';
                                $nombre='';
                                $icon= '';
                                
                                //Primero comprobamos imagenes con la cadena en el nombre
                                if (in_array(strtolower(array_pop(explode('.', $file))), $imgext)){
                                        $foundpos = strstr(strtolower(array_pop(explode ('/', explode('.', $file)[0]))),$searchstr);
                                        if( $foundpos !== false){
                                                $src =  array_pop(explode ('/', explode('.', $file)[0]));
                                                if (strstr($file, 'notas_medelpiot/'))
                                                    $ruta = 'files/notas_medelpiot/imagen.php?img='.$src;    
                                                else if(strstr($file, 'docs_internos/'))
                                                    $ruta = 'files/docs_internos/file.php?src='.$src;
                                                else
                                                    $ruta = 'files/extractos_prensa/file.php?img='.$src;
                                                    
                                                $icon = 'imagen';
                                        }
                                }else if(strtolower(array_pop(explode('.', $file))) == 'txt'){//Luego documentos
                                        //Busco en el titulo
                                        $foundpos = strstr(strtolower(array_pop(explode ('/', explode('.', $file)[0]))),$searchstr);
                                        if( $foundpos == false){//Busco en el contenido
                                             $foundpos = strstr(strtolower(file_get_contents($file)),$searchstr);
                                        }
                                        if($foundpos  !== false){
                                            $icon = 'file';
                                            $src =  array_pop(explode ('/', explode('.', $file)[0]));
                                            
                                            if (strstr($file, 'extractos_prensa/'))
                                                    $ruta = 'files/extractos_prensa/file.php?src='.$src;
                                            else
                                                    $ruta = 'files/docs_internos/file.php?src='.$src;
                                        }
                                }
                                
                                if ($foundpos !== false){
                                        $nombre = array_pop(explode ('/',$file));
                                        $path = $file."";
                                        $archivo = array('nombre' => $nombre, 'ruta' => $ruta, 'icon' => $icon);
                                        array_push($encontrados, $archivo);
                                }
                        }
                        
                        //var_dump($encontrados);
                        
                       if (count($encontrados) <= 0){
                           echo "<h4 class='col-lg-12 text-center'>No se encontraron coincidencias</h4>";
                       }
                       foreach($encontrados as $archivo){
                                ?>
                                
                                <div class="col-md-4 col-sm-6 text-center">
                                       <?php echo "<a href='".$archivo['ruta']."' class='link_directorio'>";?>
                                                <div class="icon-files <?=$archivo['icon'];?>"></div>
                                                <span class="file-name"><?=$archivo['nombre'];?></span>
                                        <?php echo "</a>";?>
                                
                                </div>
                                
                                <?
                        
                        }
                        
                        ?>
                
                        
                       
                
                                       
               </div>
        </div>
       
      </div>

  </section>


</body>

</html>
<?php } ?>