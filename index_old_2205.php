<!DOCTYPE html>
<?php


$servername = "pdb49.batcave.net";
$username = "3388117_escape";
$password = "matthew714";
$db = "3388117_escape";

// Create connection
$conn = new mysqli($servername, $username, $password, $db);

// Check connection
if ($conn->connect_error) {
    die("Error de conexion: " . $conn->connect_error);
}

 $mensaje = "";
   
   if (isset($_GET["error"]) && isset($_GET['idjuego'])){
          
           $idjuego = $_GET['idjuego'];
           if ($_GET['error'] == -1)
                    $mensaje = "Accede con una ID de grupo";
                    
           elseif ($_GET['error'] == -2)
                    $mensaje = "No se encuentra ningún equipo con esa ID de grupo";
   
   }      

?>

<html lang="es-ES" >
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-167331134-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-167331134-1');
</script>
<title>Escape Room Desde Casa</title>
<script src="https://kit.fontawesome.com/8e8842163b.js" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
<link href="css/main.css" rel="stylesheet"><script>



/* ésto comprueba la localStorage si ya tiene la variable guardada */
function compruebaAceptaCookies() {
  if(localStorage.aceptaCookies == 'true'){
    cajacookies.style.display = 'none';
  }
}

/* aquí guardamos la variable de que se ha
aceptado el uso de cookies así no mostraremos
el mensaje de nuevo */
function aceptarCookies() {
  localStorage.aceptaCookies = 'true';
  cajacookies.style.display = 'none';
}


$( document ).ready(function() {

      compruebaAceptaCookies();
 
       $( ".btn_join_game" ).click(function() {
                $('#'+$(this).val()).slideToggle();
        });

    
});



</script>


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
  

  

  <section id="juego1" class="bg-light section_juego">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 mx-auto">
          <h3>&nbsp;&nbsp;CRON</h3>
          <div class="col-md-5">
          <iframe width="420" height="236" src="https://www.youtube.com/embed/QtC-6bGFQf8"
          frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
          </div>
          <!--img src="img/cron.png" class="col-md-4 imgportada"/-->
          <div class="col-md-7 ">
                  <p>La humanidad está a punto de extinguirse. 
                  Una empresa multinacional tiene un plan para escapar del apocalipsis... pero algo falla. 
                  La supervivencia de la especie está en tus manos.</p>
                  <p></p>
                  
                  <p class="text-info"><span><i class="fas fa-lg fa-desktop"></i> <i class="fas fa-lg fa-tablet-alt"></i><span>&nbsp;&nbsp;</span>Optimizado para ordenador y tablet</span></p>
                  <?php 
                          $res = $conn->query("SELECT nombre, DATE_FORMAT(FROM_UNIXTIME(horafin - horainicio), '%H:%i') as tiempo_calc FROM equiposcron where horafin > 0 and pistasolicitada is not true order by tiempo_calc limit 1");
                          $row = $res->fetch_array();
                          $res->free();
                  ?>
                  <p class="text-info"><span><i class="far fa-lg fa-clock"></i><span>&nbsp;&nbsp;</span>Duración aproximada: 90min</span> - <span class="small">Record actual: <?=$row['tiempo_calc'].' ('.$row['nombre'].')';?></span></p>
                  <p class="text-info"><span><i class="fas fa-lg fa-lock"></i> <i class="fas fa-lg fa-lock"></i> <i class="fas fa-lg fa-lock"></i> <span>&nbsp;&nbsp;</span>Dificultad: Alta</span></p>
                  <p class="text-info"><span><i class="fas fa-lg fa-at"></i><span>&nbsp;&nbsp;</span>Si tienes algún problema, escríbenos a escaperoomnatabi@gmail.com</span></p>
                     <?php if ($idjuego == 'cron' && $mensaje != ''){
                            echo '<div class="alert alert-info" role="alert">'.$mensaje.'</div>';
                            }?>
                  <a href="crear_grupo.php?idjuego=cron"><button class="btn btn-primary" id="crear_grupo_cron">Iniciar juego</button></a>
                  <button class="btn btn-primary btn_join_game" id="unirse_grupo_cron" value="unirsecronform">Unirse a un grupo</button>
                  <div  class="joingameform" id="unirsecronform" style="display: none;">
                     <form action="cron/login_cron.php" method="POST">
                            <div><input name="idgrupo" class="groupid" type="text" placeholder="ID de grupo" required></div>
                            <div><input type="submit" value="Entrar" class="btn btn-primary"/></div>
                    </form>
                </div>
          </div>
        </div>
      </div>
    </div>
    
  </section>
  
  
  <section id="juego2" class="bg-light section_juego">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 mx-auto">
          <h3>&nbsp;&nbsp;EN BUSCA DE LA LUNA NEGRA</h3>
          <div class="col-md-5">
          <img src="img/lunanegra.png" class="imgportada" alt="Escape Room En busca de la Luna Negra"/>
          
          </div>
          <div class="col-md-7 ">
                  <p>Hace mucho tiempo, un explorador recorrió el mundo en busca de la Luna Negra, el diamante negro más grande del mundo. Tras años de duro trabajo, logró encontrarlo y lo ocultó en su caja fuerte.</p>
                  <p>Con la tecnología actual, ¿serías capaz de seguir sus pasos y encontrar el tesoro en una hora?</p>
                  <p></p>
                  
                  <p class="text-info"><span><i class="fas fa-lg fa-desktop"></i> <i class="fas fa-lg fa-tablet-alt"></i> <i class="fas fa-lg fa-mobile-alt"></i><span>&nbsp;&nbsp;</span>Optimizado para ordenador,  tablet y móvil</span></p>
                  <?php 
                          $res = $conn->query("SELECT nombre, TIME_FORMAT(timediff(horafin, horainicio), '%H:%i') as tiempo_calc FROM `equiposlunanegra` where horafin > 0 and pistasolicitada is not true order by tiempo_calc limit 1");
                          $row = $res->fetch_array();
                          $res->free();
                  ?>
                  <p class="text-info"><span><i class="far fa-lg fa-clock"></i><span>&nbsp;&nbsp;</span>Duración aproximada: 60min</span> - <span class="small">Record actual: <?=$row['tiempo_calc'].' ('.$row['nombre'].')';?></span></p>
                  <p class="text-info"><span><i class="fas fa-lg fa-lock"></i> <i class="fas fa-lg fa-lock"></i> <span>&nbsp;&nbsp;</span>Dificultad: Media</span></p>
                  <p class="text-info"><span><i class="fas fa-lg fa-at"></i><span>&nbsp;&nbsp;</span>Si tienes algún problema, escríbenos a escaperoomnatabi@gmail.com</span></p>
                     <?php if ($idjuego == 'lunanegra' && $mensaje != ''){
                            echo '<div class="alert alert-info" role="alert">'.$mensaje.'</div>';
                      }?>
                  <a href="crear_grupo.php?idjuego=lunanegra"><button class="btn btn-primary" id="crear_grupo_lunanegra">Iniciar juego</button></a>
                  <button class="btn btn-primary btn_join_game" id="unirse_grupo_luna" value="unirselunaform">Unirse a un grupo</button>
                  <div class="joingameform" id="unirselunaform" style="display: none;">
                     <form action="luna_negra/login_luna_negra.php" method="POST">
                            <div><input name="idgrupo" class="groupid" type="text" placeholder="ID de grupo" required></div>
                            <div><input type="submit" value="Entrar" class="btn btn-primary"/></div>
                    </form>
                </div>
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
  
    <div id="cajacookies" style="">
        <h4 class="text-info col-md-12">El rollo de las cookies</h4>
        
        <p class="col-md-8 small-text text-small">Utilizamos cookies para asegurar que te damos la mejor experiencia en nuestro sitio web. 
        Si continúas navegando, entenderemos que estás de acuerdo ;)
        </p>
        <p class="col-md-4 small-text text-right">
                <button onclick="aceptarCookies()" class="btn btn-primary">¡Vale!</button>
                <span>&nbsp;&nbsp;</span>
                <a href="politica.php"><button class="pull-right btn btn-primary">Cuéntame más</button></a></p>
        </div>

</body>

</html>
