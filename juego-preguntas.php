<!DOCTYPE html>
<?php


include("includes/connect.php");

// Create connection
$conn = new mysqli($servername, $username, $password, $db);

// Check connection
if ($conn->connect_error) {
    die("Error de conexion: " . $conn->connect_error);
}

$isgroupcreated=false;
$idgrupo = "";
$error = 0;
 $mensaje = "";
   
   if (isset($_GET["error"])){
          
           if ($_GET['error'] == -1)
                    $mensaje = "<span class='text-info'>Accede con una ID de grupo</span>";
                    
           elseif ($_GET['error'] == -2)
                    $mensaje = "<span class='text-info'>No se encuentra ningún equipo con esa ID de grupo</span>";
   
   }else{
   
        
           if (isset($_POST["nombregrupo"])){
                 $nombregrupo = $_POST["nombregrupo"];
                 
                         
                         
                 
                 //comprobar si existe el nombre de grupo
                 $query = $conn->prepare("SELECT id FROM equipospreguntas WHERE nombre = ?");
                 $query->bind_param("s", $nombregrupo);
                 $query->execute();
                 $res = $query->fetch();
                 $query->close();
                 
                 if($res){
                         $error = -1; //el nombre de grupo ya existe
                         $mensaje = "<span class='err'>Ya existe un grupo con ese nombre</span>";
                 }else{
                     
                     //GENERAR ID WEB
                     $num = random_int(0, 999);
                     $fecha = new DateTime();
                     
                     $idgrupo = $num."_".$fecha->getTimestamp();
                     
                     //Guardo en bd
                     
                     $query = $conn->prepare("INSERT INTO equipospreguntas (nombre, idweb) VALUES (?, ?)");
                     $query->bind_param("ss", $nombregrupo, $idgrupo);
                     $query->execute();
        
                     $res = $query->affected_rows;
                     $query->close();
                     
                     if($res){ 
                              //insertado correctamente. Devuelvo idweb
                              $isgroupcreated = true;
                              $mensaje = "<span class='info'> La ID de tu grupo es: <h4>".$idgrupo."</h4></span>";
                              $mensaje .= "<form action='juego_preguntas/login_juego_preguntas.php' method='POST'><input name='idgrupo' type='hidden' value='".$idgrupo."'><input type='submit' value='Iniciar' class='btn btn-primary'/></form>";
                     }else{
                             //Otro error
                              $mensaje =  "<span class='err'>Parece que ha habido un error. Inténtalo de nuevo.</span>";
                     }
                 }
                 
                     
           }      
   
   }     

?>

<html lang="es-ES" >
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-167445149-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-167445149-1');
</script>

<title>Juego de preguntas</title>
<meta name="description" content="Juego de preguntas" />
<script src="https://kit.fontawesome.com/8e8842163b.js" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
<link href="css/main.css" rel="stylesheet">

</head>

<body id="page-top">

  <!-- Navigation -->

  
  <header class="bg-primary text-white">
    <div class="container" id="esc_header">
    <div class="row">
              <div class="col-md-2">
                      <img src="img/logo.png" class="img-fluid imglogomain"/>
              </div>
              <div class="col-md-8 my-auto">
                      <h1 class=" text-right">Escape Room Desde Casa</h1>
                      <p class="lead  text-right">Juega sin salir de casa</p>
              </div>
              </div>
    </div>
  </header>
  <nav class="">
        <div class="container text-right">
                <a class="btn navbtn" href="https://www.escapedesdecasa.125mb.com"><i class="fas fa-home"></i></a>
                <a class="btn navbtn" href="https://www.escapedesdecasa.125mb.com/contacto.php"><i class="far fa-envelope"></i></a>
                <a class="btn navbtn" href="https://www.instagram.com/escapedesdecasa/" target="_blank"><i class="fab fa-instagram"></i></a>
        </div>
  </nav>

  <section class="section_juego">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 mx-auto">
          <h1 class="display-4 title" >&nbsp;&nbsp;Juego de preguntas</h1>
          
          <div class="col-md-12">
                  <img src="" class="imgportada" alt="Juego preguntas"/>
          </div>
          <div class="col-md-12">
                  <p>Introduce tu avatar y tu nombre, y responde las preguntas. Luego intenta pillar a los de más y que no te pillen.</p>
                  <p></p>
                  
                  <p class="text-info"><span><i class="fas fa-lg fa-desktop"></i> <i class="fas fa-lg fa-tablet-alt"></i> <i class="fas fa-lg fa-mobile-alt"></i><span>&nbsp;&nbsp;</span>Optimizado para ordenador,  tablet y móvil</span></p>
                  
                  <p class="text-info"><span><i class="far fa-lg fa-clock"></i><span>&nbsp;&nbsp;</span>Duración aproximada: 60min</span></p>
                  <p class="text-info"><span><i class="fas fa-lg fa-lock"></i> <i class="fas fa-lg fa-lock"></i> <span>&nbsp;&nbsp;</span>Dificultad: Fácil</span></p>
                  
                            
                            
           </div>
           <div class="col-md-12">
                   <h4>Instrucciones</h4>
                         <span class="title">Para jugar en equipo</span>
                         <ul>
                                 <li><strong>Un único jugador</strong> debe introducir el nombre del equipo y pulsar "Crear grupo"</li>
                                 <li>Le devolveremos una ID que deberá pasar a todos los miembros del grupo.</li>
                                 <li>Cada jugador deberá pulsar sobre "Unirse a un grupo" e introducir la ID.</li>
                                 <li>Todos los jugadores podrán ver los avances de sus compañeros en tiempo real.</li>
                                 <li>¡Pasadlo bien!</li>
                         </ul>
                         
                         <span class="title">Para jugar solo</span>
                         <ul>
                                 <li>Introduce tu nombre y pulsa "Crear grupo"</li>
                                 <li>Te devolveremos una ID. Apúntala por si tienes que desconectarte y quieres recuperar tu partida.</li>
                                 <li>Pulsa Iniciar y ¡dale al coco!</li>
                         </ul>
                         

                  <?php if ($mensaje != ''){
                            echo '<div class="alert alert-info" role="alert">'.$mensaje.'</div>';
                  }?>
                  <?php if(!$isgroupcreated){ ?>      
                  
                        <ul class="nav nav-tabs" id="gameoptions" role="tablist">
                          <li class="nav-item">
                            <a class="nav-link active" id="creategroup-tab" data-toggle="tab" href="#creategroup" role="tab" aria-controls="creategroup" aria-selected="true">Crear grupo</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" id="joingroup-tab" data-toggle="tab" href="#joingroup" role="tab" aria-controls="joingroup" aria-selected="false">Unirse a un grupo</a>
                          </li>
                        </ul>
                        <div class="tab-content" id="gameoptionsContent">
                          <div class="tab-pane fade show active" id="creategroup" role="tabpanel" aria-labelledby="creategroup-tab">
                          
                                <form action="#" method="POST" class="inlineform">
                                         <div class="form-group">
                                            <small id="nombreHelp" class="form-text text-muted">Introduce un nombre para tu equipo, de hasta 50 caracteres.</small>
                                            <input type="text" class="form-control" id="nombregrupo" name="nombregrupo" aria-describedby="nombreHelp" placeholder="Equipo 1" required>
                                            
                                          </div>
                                          <button type="submit" class="btn btn-primary">Crear</button>
                                 </form>
                          </div>
                          <div class="tab-pane fade" id="joingroup" role="tabpanel" aria-labelledby="joingroup-tab">
        
                                 <form action="juego_preguntas/login_juego_preguntas.php" method="POST" class="inlineform">
                                            <div class="form-group">
                                                    <small id="idgrupoHelp" class="form-text text-muted">Introduce la ID de tu equipo</small>
                                                    <input name="idgrupo" class="groupid form-control" type="text" placeholder="000_XXXXXXXXXX" required>
                                             </div>
                                            <button type="submit" class="btn btn-primary">Entrar</button>
                                  </form>
                          </div>
                        </div>
                        
                <?php } ?>


                         
                         
                            
                  
          </div>
        </div>
      </div>
    </div>
    
  </section>
  
    

  <!-- Footer -->
  <footer class="py-5 bg-dark">
    <div class="container">
    <div class="col-md-5">
         <p>Valóranos y descubre más escape room en: <br/>
        <a target="_blank" href="https://runwilly.com" class="partner_logo"><img src="img/runwilly.svg" alt="Directorio de escape room RunWilly"></a></p>
     </div>
    </div>
    <!-- /.container -->
  </footer>
  
  
  
</body>

</html>
