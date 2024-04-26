<!DOCTYPE html>
<?php


include("includes/connect.php");
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
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-167445149-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-167445149-1');
</script>

<title>Escape Room Desde Casa</title>
<meta name="description" content="Juegos de escape virtuales" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
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
  <nav class="">
        <div class="container text-right">
                <a class="btn navbtn" href="https://abiramirez.dev/escapegames/"><i class="fas fa-home"></i></a>
                <a class="btn navbtn" href="https://abiramirez.dev/escapegames/contacto.php"><i class="far fa-envelope"></i></a>
                <a class="btn navbtn" href="https://www.instagram.com/escapedesdecasa/" target="_blank"><i class="fab fa-instagram"></i></a>
        </div>
  </nav>

  
  <section class="section_juego">
    <div class="container">
      <div class="row">
          <div class="col-lg-12 " id="mainsec">
          
                 <h2 class="display-4 title">#YoEscapoEnCasa</h2>
                 
                 <p><strong class="primblue">Si te gustan los juegos de escape, eres de los nuestros.</strong> <br/>
                 Como escapistas aficionados que somos, nos encantó la idea de los escape room virtuales durante el confinamiento. Por eso
                 decidimos unirnos al movimiento <strong>#YoEscapoEnCasa</strong> aportando nuestro granito de arena.</p>
                 <p>En esta web queremos compartir algunos desafíos online que hemos creado para otros escapistas con mono de acertijos. 
                 Hemos intentado que la experiencia, dentro de lo que cabe, sea lo más parecida posible a una sala de escape real.
                 </p>
                 <p class="primblue">¿Aceptas el reto?</p>

           </div>
      </div>
    </div>
  </section>

  <section id="juego1" class="section_juego">
    <div class="container">
      <div class="row">
          <h3><a href="escape-room-cron.php">CRON</a></h3>
          <div class="row">
                  <div class="col-md-4">
                          <img src="img/portadacron.png" class="imgportada" alt="Escape Room CRON"/>
                  </div>
          <!--img src="img/cron.png" class="col-md-4 imgportada"/-->
          <div class="col-md-7 ">
                  <p>La humanidad está a punto de extinguirse. 
                  Una empresa multinacional tiene un plan para escapar del apocalipsis... pero algo falla. 
                  La supervivencia de la especie está en tus manos.</p>
                  <p></p>
                  
                  <p class="text-info small"><span><i class="fas fa-desktop"></i> <i class="fas fa-tablet-alt"></i><span>&nbsp;&nbsp;</span>Optimizado para ordenador y tablet</span></p>
                 
                 
                  <p class="text-info small"><span><i class="far fa-clock"></i><span>&nbsp;&nbsp;</span>Duración aproximada: 90min</span></p>
                  <p class="text-info small"><span><i class="fas fa-lock"></i> <i class="fas fa-lock"></i> <i class="fas fa-lock"></i> <span>&nbsp;&nbsp;</span>Dificultad: Alta</span></p>


                  <a href="escape-room-cron.php" class="btn btn-primary" id="crear_grupo_cron">Ir al juego</a>
          </div>
        </div>
      </div>
    </div>
    
  </section>
  
  
  <section id="juego2" class="section_juego">
    <div class="container">
      <div class="row">
        <h3><a href="escape-room-luna-negra.php">EN BUSCA DE LA LUNA NEGRA</a></h3>
        <div class="row">
          <div class="col-md-4">
                  <a href="escape-room-luna-negra.php">
                          <img src="img/lunanegra.png" class="imgportada" alt="Escape Room En busca de la Luna Negra"/>
                  </a>
          </div>
          <div class="col-md-7">
                  <p>Hace mucho tiempo, un explorador recorrió el mundo en busca de la Luna Negra, el diamante negro más grande del mundo. Tras años de duro trabajo, logró encontrarlo y lo ocultó en su caja fuerte.</p>
                  <p>Con la tecnología actual, ¿serías capaz de seguir sus pasos y encontrar el tesoro en una hora?</p>
                  <p></p>
                  
                  <p class="text-info small"><span><i class="fas fa-desktop"></i> <i class="fas fa-tablet-alt"></i> <i class="fas fa-mobile-alt"></i><span>&nbsp;&nbsp;</span>Optimizado para ordenador,  tablet y móvil</span></p>
                 
                  <p class="text-info small"><span><i class="far fa-clock"></i><span>&nbsp;&nbsp;</span>Duración aproximada: 60min</span></p>
                  <p class="text-info small"><span><i class="fas fa-lock"></i> <i class="fas fa-lock"></i> <span>&nbsp;&nbsp;</span>Dificultad: Media</span></p>
                  
                     
                  <a href="escape-room-luna-negra.php" class="btn btn-primary">Ir al juego</a>
                  
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
