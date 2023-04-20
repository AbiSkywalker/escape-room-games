<?php

 //ECHAR SI NO HAY SESION
 session_start();
 if (!isset($_SESSION['session_id']) || $_SESSION['session_id'] == ''){
         header('Location: ../index.php');//redirigir
 } else{

$idweb = $_SESSION['session_id'];
//Actualizar sesion

// Create connection

   include("includes/connect.php");
   $conn = new mysqli($servername, $username, $password, $db);


// Check connection
if ($conn->connect_error) {
    die("Error de conexion: " . $conn->connect_error);
}

$query = $conn->prepare("SELECT mailenviado FROM equiposcron WHERE idweb = ?");
$query->bind_param("s", $idweb);
$query->execute();         
$query->bind_result($mailenviado);
         
while ($query->fetch()){
        //Compruebo si han recibido mail
        $_SESSION['mailrecibido']  = $mailenviado;
}

$query->close();
$mailsent =  $_SESSION['mailrecibido'];
         
?>

<html lang="es-ES" >
<head>

<title>CRON - Bandeja de entrada</title>

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-167445149-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-167445149-1');
</script>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>


<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

<link href="css/all.css" rel="stylesheet"/>
<link rel="stylesheet" href="css/styles.css"/>

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">


<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
  $( function() {
    $( "#accordion" ).accordion();
  } );
 </script>
<script src="js/short_cut.js"></script>

</head>

<body id="page-top">

  <!-- Navigation -->
<header class="bg-primary">
    <div class="text-right">
      <nav>
    <ul>
        <li>
                <a href="index.php"><button class="btn btn-primary" id="login" data-toggle="modal" data-target="#modalLogin">Salir</button></a>

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
        <div class="col-md-4 loginsidebar">
                <ul class="loginmenu">
                         <li class=""> <a href="login.php">Mi perfil</a></li>
                         <li class="active"><a href="inbox.php">Bandeja de entrada</a></li>
                         <li class=""><a href="fileindex.php">Documentos</a></li>
                         <li class=""><a href="maps.php">WorldwideCRON</a></li>
                </ul>
        </div>
        <div class="col-md-8">
                <div class="row inbox-nav">
                     <button type="button" class="btn btn-primary"><a href="new_mail.php">Nuevo mensaje</a></button>                                
                </div>
                <div class="row inbox-header">
                       <div class="col-md-2">Remitente</div>
                       <div class="col-md-8">Asunto</div>
                       <div class="col-md-2">Fecha</div>
                </div>
                
                
                <?php
                
                //if ($mailsent == true){
                
                  //SACO MAILS RECIBIDOS
                  $query = $conn->prepare("SELECT id, remitente, asunto, fecha, leido FROM mails_recibidos WHERE id_equipo = (SELECT id from equiposcron WHERE idweb =?) OR id_equipo = 0 order by id desc");
                  $query->bind_param("s", $idweb);
                  $query->execute();         
                  $query->bind_result($idmail, $remitente, $asunto, $fecha, $leido);
                  $cont = 2;
                  while ($query->fetch()){
                       $classcss = "row inbox-item";
                       
                       if ($cont%2 == 0){
                               $classcss .= " odd";
                       } else{
                               $classcss .= " even";
                       }
                       
                       if ($leido == false){
                               $classcss .= " unread";
                       }
                       

                        echo  "<a href='files/mails/mail.php?idmail=".$idmail."'>";
                                 echo "<div class='".$classcss."'>";
                                       echo "<div class='col-md-2'>".$remitente."</div>";
                                       echo "<div class='col-md-8'>".$asunto."</div>";
                                       echo "<div class='col-md-2'>".$fecha."</div>";
                                echo "</div></a>";
                        
                        $cont++;
                  }

                  
                 
                //}
                ?>
                
                
                <!--a href="files/mails/mail1.php"><div class="row inbox-item even">
                       <div class="col-md-2">Pepe</div>
                       <div class="col-md-8">Cosas nazis</div>
                       <div class="col-md-2">Ayer</div>
                </div></a>
                
                <a href="files/mails/mail2.php"><div class="row inbox-item odd">
                       <div class="col-md-2">Antonio</div>
                       <div class="col-md-8">Correo sospechoso</div>
                       <div class="col-md-2">18/04/2020</div>
                </div></a-->
                
                
                
               
        </div>
       
      </div>

  </section>



</body>

</html>
<?php } ?>