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

$isgroupcreated=false;
$idgrupo = "";
$error = 0;

   if (isset($_POST["nombregrupo"]) && isset($_POST["id_juego"])){
         $nombregrupo = $_POST["nombregrupo"];
         $idjuego = $_POST['id_juego'];
         
         $tablaequipos = '';
         
         if($idjuego == 'cron')
                 $tablaequipos = 'equiposcron';
         elseif($idjuego == 'lunanegra')
                 $tablaequipos = 'equiposlunanegra';
                 
                 
         
         //comprobar si existe el nombre de grupo
         $query = $conn->prepare("SELECT id FROM ".$tablaequipos." WHERE nombre = ?");
         $query->bind_param("s", $nombregrupo);
         $query->execute();
         $res = $query->fetch();
         $query->close();
         
         if($res){
                 $error = -1; //el nombre de grupo ya existe
         }else{
             
             //GENERAR ID WEB
             $num = random_int(0, 999);
             $fecha = new DateTime();
             
             $idgrupo = $num."_".$fecha->getTimestamp();
             
             //Guardo en bd
             
             $query = $conn->prepare("INSERT INTO ".$tablaequipos."  (nombre, idweb) VALUES (?, ?)");
             $query->bind_param("ss", $nombregrupo, $idgrupo);
             $query->execute();

             $res = $query->affected_rows;
             $query->close();
             
             if($res){ 
                      //insertado correctamente. Devuelvo idweb
                      $isgroupcreated = true;
             }else{
                      $error = -2; //ERROR; reintentar
             }
         }
         
             
   }      

?>

<html lang="es-ES" >
<head>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-167331134-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-167331134-1');
</script>
<title>Escape Room Desde Casa</title>

<meta name="robots" content="noindex">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<link href="css/main.css" rel="stylesheet">

</head>

<body id="page-top">

  <!-- Navigation -->

  
  <header class="bg-primary text-white">
    <div class="container text-right" id="esc_header">
      <h1>Escape Room Desde Casa</h1>
      <p class="lead">Juega sin salir de casa</p>
    </div>
  </header>
  

  

  <section class="bg-light">
    <div class="container">
      <div class="row">
          <div class="col-lg-12 " id="mainsec">
          
                 <h4>Instrucciones</h4>
                 
                 <ul>
                         <li>Introduce el nombre de tu equipo y pulsa "Crear grupo"</li>
                         <li>Te daremos una ID que deberás pasar a todos los miembros del grupo</li>
                         <li>Cada jugador deberá pulsar sobre "Unirse a un grupo" e introducir la ID</li>
                         <li>El tiempo empezará a correr en cuanto pulses el botón "Iniciar", o cuando otro de los jugadores se una a la partida.</li>
                         <li>¡Pasadlo bien!</li>
                         <?php
                         if ($isgroupcreated){
                                 echo "<li> La ID de tu grupo es: <h4>".$idgrupo."</h4></li>";
                                 echo "<li><form action='cron/login_cron.php' method='POST'><input name='idgrupo' type='hidden' value='".$idgrupo."'><input type='submit' value='Iniciar' class='btn btn-primary'/></li>";
                         }elseif($error == -1){
                                 echo "<li class='err'>Ya existe un grupo con ese nombre</li>";
                         }elseif($error == -2){
                                 echo "<li class='err'>Parece que ha habido un error. Inténtalo de nuevo.</li>";
                         }
                         ?>
                 </ul>
                 
                 <form id="creargrupoform" action="#" method="POST">
                         <div class="form-group">
                            <input type="hidden" name="id_juego" value="<?=$_GET['idjuego']?>"/>
                            <label for="nombregrupo">Nombre del grupo</label>
                            <input type="text" class="form-control" id="nombregrupo" name="nombregrupo" aria-describedby="nombreHelp" placeholder="Equipo 1" <?php if ($isgroupcreated){ echo "required"; } ?>>
                            <small id="nombreHelp" class="form-text text-muted">Introduce un nombre para tu equipo, de hasta 50 caracteres.</small>
                          </div>
                          <button type="submit" class="btn btn-primary">Crear grupo</button>
                 </form>
                 
                 

           </div>
      </div>
    </div>
  </section>
  

  <!-- Footer -->
  <!--footer class="py-5 bg-dark">
    <div class="container">
      <p class="m-0 text-center text-white">Copyright &copy; Your Website 2019</p>
    </div>
  </footer-->

</body>

</html>
