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

?>

<html lang="es-ES" >
<head>

<title>Confinados Escape Room</title>
<meta name="robots" content="noindex">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<script src="https://kit.fontawesome.com/8e8842163b.js" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
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
          <div class="col-lg-12 " id="mainsec">
          
                 <h1 class="display-4">El rollo de las cookies</h1>
                 
                 <p>Pues sí, es lo que hay. Aquí también usamos cookies, como casi todas las webs del mundo, y la ley nos obliga a avisarte.
                 <br/><i>¿Pero mamá, qué es eso de las cookies?</i>
                 <br>Vamos a intentar explicartelo de forma sencillita, pero te advertimos que puedes encontrarte palabrejas como "archivo" o "navegador".</p>
                 <p></p>
                 
                 <p class="h4 cookies-heading">Qué <b>no</b> es una cookie</p>
                 <p>Respira, que una cookie NO ES ningún virus, ningún robo de identidad, ni ninguna movida chunga. 
                 No te vamos a espiar, no sabemos cómo te llamas ni dónde vives, ni vamos a cotillearte por la webcam. Te lo prometemos.</p>
                 <p></p>

                 <p class="h4 cookies-heading">Entonces, ¿qué son las cookies?</p>
                 <p>Pues básicamente, una cookie es un archivo pequeñito con datos que se guarda en TU navegador.
                 Sirven para que el navegador se acuerde de ti: así sabe a qué juego has accedido, si estás jugando con un grupo, y el progreso que llevas en la partida.
                 </p>
                 <p></p>

                 <p class="h4 cookies-heading">¿Y qué cookies usáis en este sitio web?</p>
                 <p>La verdad es que no muchas.</p>
                 <p>Usamos algunas <b>cookies propias</b> para conocer el progreso de tu partida, así sabemos por dónde vas y cuál será tu siguiente prueba.</p>
                 <p>En cuanto a las <b>cookies de terceros,</b> usamos una herramienta de Google (Google Analytics), que nos cuenta cosas como a qué páginas acceden los usuarios, o
                 dónde hacen clic. Esto nos ayuda a detectar errores en nuestra web, y no te preocupes, que nunca obtenemos acceso a tus datos personales.</p>
                 <p></p>

                 <p class="cookies-heading">Puedes borrar las cookies en cualquier momento (aunque si lo haces, puede que algunas funciones de la web se vean afectadas)
                 Esto se hace de forma distinta según el navegador que uses: Chrome, Firefox, Safari, Explorer (por favor, no uses Explorer), etc.
                 Si no sabes cómo hacerlo, pregúntale a google, que lo sabe casi todo.
                 </p>
                 
                 <p>Esperamos haberte aclarado algunas dudas, ¡gracias por visitarnos!</p>
                 
                 

           </div>
      </div>
    </div>
  </section>
  

  <!-- Footer -->
  <footer class="py-5 bg-dark">
    <div class="container">

    </div>
    <!-- /.container -->
  </footer>

</body>

</html>
