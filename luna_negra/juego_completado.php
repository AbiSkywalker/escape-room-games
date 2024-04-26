<?php

 //ECHAR SI NO HAY SESION
 session_start();
 if (!isset($_SESSION['session_id']) || $_SESSION['session_id'] == ''){
         header('Location: ../index.php');//redirigir
 } else{
 
   include("includes/connect.php");
   $idweb = $_SESSION['session_id'];
   //Actualizar sesion
   $conn = new mysqli($servername, $username, $password, $db);

   // Check connection
   if ($conn->connect_error) {
           die("Error de conexion: " . $conn->connect_error);
   }
        $query = $conn->prepare("SELECT horainicio, horafin, TIMESTAMPDIFF(MINUTE,horainicio,horafin) as tiempo, nombre FROM equiposlunanegra WHERE idweb = ?");
        $query->bind_param("s", $idweb);
        $query->execute();         
        $query->bind_result($hini, $hfin, $tiempo, $nombre);
                 
        
$completado = false;

while ($query->fetch()){
        $nombreequipo = $nombre;
        
        $horas = intval($tiempo/60);
        $minutos = ($tiempo%60);
}

?>

<html lang="es-ES" >
<head>

<title>En busca de la Luna Negra - Misión completada</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>



<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

<link rel="stylesheet" href="css/main.css"/>

<!--link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet" /--> 
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
<link href="../assets/cool-share/plugin.css" media="all" rel="stylesheet" /> 
<link href="../css/main.css" media="all" rel="stylesheet" /> 
<script src="../js/ajax_valoraciones.js"></script>



</head>

<body id="page-top">

  <!-- Navigation -->
<header class="bg-primary">
    <div class="text-right">
      <nav>
    <ul>
        <li>
                <a href="../index.php"><button class="btn btn-primary" data-toggle="modal">Volver</button></a>

         </li>
    </ul>
</nav>
    </div>
  </header>

  <section id="main">
       
      <div class="text-center" if="finjuego">
       <h2 class="col-lg-12">¡ENHORABUENA EQUIPO!</h2>
       <p class="col-lg-12"><b><?=$nombreequipo?></b>, habéis conseguido descifrar todas las pistas y haceros con la fortuna en 
               <b> <?=$horas?> horas <?=$minutos?> minutos</b>.<br/>
       ¡La Luna Negra es vuestra!
       </p>
      </div>
 
      <div class="text-center" if="finjuego">
       <p class="col-lg-12">Si te ha gustado, puedes echarnos una mano donando lo que puedas para ayudarnos a pagar los servidores, el dominio, etc.
              
       </p>
      </div>
      
        <div class="text-center col-lg-12">
                <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
                <input type="hidden" name="cmd" value="_donations" />
                <input type="hidden" name="business" value="NHAH989YCPZPE" />
                <input type="hidden" name="item_name" value="Escape Room" />
                <input type="hidden" name="currency_code" value="EUR" />
                <input type="image" src="https://www.paypalobjects.com/es_ES/ES/i/btn/btn_donate_LG.gif" border="0" name="submit" title="PayPal - The safer, easier way to pay online!" alt="Botón Donar con PayPal" />
                <img alt="" border="0" src="https://www.paypal.com/es_ES/i/scr/pixel.gif" width="1" height="1" />
                </form>


        </div>
        
      <div class="text-center col-lg-12">
       <p><b>¡Y cuéntaselo a tus amigos! </b><span class="socialShare"></span> </p>
       <p>Puedes usar esta imagen para compartir tu tiempo en las redes sociales y etiquetar a los miembros de tu equipo.</p>
       <a href="img/plantilla_lunanegra.png"><img alt="" border="0" src="img/plantilla_lunanegra.png" class="img-plantilla" /></a>
      </div> 
     
      <div class="text-center" id="form_finjuego_wrapper">
              <div class="text-center col-lg-12">
                       <p>Por último, te agradeceríamos que valoraras qué te ha parecido el juego y nos contaras si has tenido algún problema, o cualquier sugerencia que tengas.</p>
              </div>
      
              <div class="col-md-4" style="margin: 0 auto;"></div>
              <div class="col-md-4" style="margin: 0 auto;">
                       <form id="form_valoracion" class="form_finjuego" action="../valorar.php" method="post">
                            <input type="hidden" name="juego" value="lunanegra"/>
                            <label for="rating">Valoración general</label>
                                    
                                    
                            <div class="star-rating">
                              <div class="star-rating__wrap">
                                <input class="star-rating__input" id="star-rating-5" type="radio" name="rating" value="5" required>
                                <label class="star-rating__ico fas fa-star fa-lg" for="star-rating-5" title="5 de 5"></label>
                                <input class="star-rating__input" id="star-rating-4" type="radio" name="rating" value="4">
                                <label class="star-rating__ico fas fa-star fa-lg" for="star-rating-4" title="4 de 5"></label>
                                <input class="star-rating__input" id="star-rating-3" type="radio" name="rating" value="3">
                                <label class="star-rating__ico fas fa-star fa-lg" for="star-rating-3" title="3 de 5"></label>
                                <input class="star-rating__input" id="star-rating-2" type="radio" name="rating" value="2">
                                <label class="star-rating__ico fas fa-star fa-lg" for="star-rating-2" title="2 de 5"></label>
                                <input class="star-rating__input" id="star-rating-1" type="radio" name="rating" value="1">
                                <label class="star-rating__ico fas fa-star fa-lg" for="star-rating-1" title="1 de 5"></label>
                              </div>
                            </div>
                            
                            
                            <label for="rating">Dificultad</label>
                                    
                                    
                            <div class="star-rating">
                              <div class="star-rating__wrap">
                                <input class="lock-rating__input" id="lock-rating-5" type="radio" name="dificultad" value="5" required>
                                <label class="lock-rating__ico fa fa-lock fa-lg" for="lock-rating-5" title="5 de 5"></label>
                                <input class="lock-rating__input" id="lock-rating-4" type="radio" name="dificultad" value="4">
                                <label class="lock-rating__ico fa fa-lock fa-lg" for="lock-rating-4" title="4 de 5"></label>
                                <input class="lock-rating__input" id="lock-rating-3" type="radio" name="dificultad" value="3">
                                <label class="lock-rating__ico fa fa-lock fa-lg" for="lock-rating-3" title="3 de 5"></label>
                                <input class="lock-rating__input" id="lock-rating-2" type="radio" name="dificultad" value="2">
                                <label class="lock-rating__ico fa fa-lock fa-lg" for="lock-rating-2" title="2 de 5"></label>
                                <input class="lock-rating__input" id="lock-rating-1" type="radio" name="dificultad" value="1">
                                <label class="lock-rating__ico fa fa-lock fa-lg" for="lock-rating-1" title="1 de 5"></label>
                              </div>
                            </div>
                            
                            <label for="comentarios">Comentarios</label>
                            <textarea name="comentarios" rows="7"></textarea>
                                    
                            
                            <button type="submit" class="btn btn-primary" id="submit_form_finjuego">Enviar</button>
                        </form>
                        <div id="res_form_finjuego"></div>
                </div>
      </div>
      
  </section>

<script src="../assets/cool-share/plugin.js"></script>

<script>
var url = 'https://abiramirez.dev/escapegames';

var options = {

        twitter: {
                text: '¡Reto conseguido! Hemos encontrado la Luna Negra en <?=$horas?> horas <?=$minutos?> minutos',
        },

        facebook : true,
};

$('.socialShare').shareButtons(url, options);
$(".socialShare.socialPlugin").css({"display": "inline-block"});
</script>
</body>

</html>
<?php 
//session_destroy();
} ?>