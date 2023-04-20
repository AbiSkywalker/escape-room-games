<?php

 //ECHAR SI NO HAY SESION
 session_start();
 if (!isset($_SESSION['session_id']) || $_SESSION['session_id'] == ''){
         header('Location: ../../../index.php');//redirigir
 } else{

        $idweb = $_SESSION['session_id'];
        $idmsg = 0;
        $objmsj = null;
        if (isset($_GET['idmail']) && $_GET['idmail'] > 0){
                $idmsg = $_GET['idmail'];
        }
        //Actualizar sesion
        
        // Create connection
        $servername = "pdb49.batcave.net";
        $username = "3388117_escape";
        $password = "matthew714";
        $db = "3388117_escape";
        $conn = new mysqli($servername, $username, $password, $db);
        
        // Check connection
        if ($conn->connect_error) {
            die("Error de conexion: " . $conn->connect_error);
        }
        
        $query = $conn->prepare("SELECT remitente, remitenteaddress, asunto, mensaje, fecha, leido, (SELECT e.idweb FROM equiposcron e WHERE e.id = m.id_equipo) FROM mails_recibidos m WHERE m.id = ?");
        $query->bind_param("s", $idmsg);
        $query->execute();         
        $query->bind_result($remitente, $remitenteaddress, $asunto, $msj, $fecha, $leido, $idwebmsj);
        
        setlocale(LC_ALL, 'es_ES');
        
        while ($query->fetch()){
               
               if($idwebmsj > 0 && $idwebmsj != $idweb){
                    header('Location: ../../inbox.php');
               }
               $objmsj = array('remitente' => $from, 'remitenteaddress' => $remitenteaddress,
                       'asunto' => $asunto, 'mensaje' =>$msj, 'fecha' => $fecha, 
                       'leido' => $leido, 'idequipoweb' => $idwebmsj);
        }
        
        $query->close();
        
        //MARCAR COMO LEIDO
        
         $query = $conn->prepare("UPDATE mails_recibidos SET leido = true WHERE id = ?");
         $query->bind_param("s", $idmsg);
         $query->execute();
            
         $res = $query->affected_rows;
         $query->close();
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

<title>CRON - <?=$asunto;?></title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>


<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

<link href="css/all.css" rel="stylesheet"/>
<link rel="stylesheet" href="../../css/styles.css"/>

<script src="../../js/short_cut.js"></script>
<script>


$( document ).ready(function() {


        $( "#responderbt" ).click(function() {
                $( "#answermail" ).slideToggle();
        });

		    
});

</script>

</head>

<body id="page-top">

  <!-- Navigation -->

  <header class="bg-primary">
    <div class="text-right">
      <nav>
    <ul>
        <li>
                <a href="../../index.php"><button class="btn btn-primary" id="login" data-toggle="modal" data-target="#modalLogin">Salir</button></a>

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
                      <?=include ("../../pistas.html");?>
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
                         <li class=""> <a href="../../login.php">Mi perfil</a></li>
                         <li class=""><a href="../../inbox.php">Bandeja de entrada</a></li>
                         <li class=""><a href="../../fileindex.php">Documentos</a></li>
                         <li class=""><a href="../../maps.php">WorldwideCRON</a></li>
                </ul>
        </div>
        <div class="col-md-8">
        
                <div class="containermail row">
                
                        <h3 class="asuntomail col-lg-12"><?=$asunto;?></h3>
                        
                        <p class="text-right fechamail col-lg-12"><?= $objmsj['fecha']?></p>
                        <h5 class="remitemail col-lg-12"> <b><?=$remitente;?></b>, &lt;<?=$remitenteaddress;?>&gt; </h5>
                        <p class="recibemail col-lg-12">Para mí</p>
                        
                        <div class="contenidomail col-lg-12">
                        <?=$msj;?>
                        </div>
                        <div class="footermail text-right col-lg-12">
                                
                                <button type="button" class="btn btn-light" id="responderbt">Responder</button>
                                <button type="button" class="btn btn-light" disabled>Reenviar</button>
                                
                        </div>
                        
                       <div class="answermail col-lg-12" id="answermail" style="display:none;">
                                
                                  <form action="../../sendMail.php" method="POST">
                                  <div class="form-group">
                                    <label for="exampleFormControlInput1">Para</label>
                                    <input type="email" name="address" class="form-control" id="exampleFormControlInput1" required value="<?=$remitenteaddress;?>">
                                  </div>
                                  <div class="form-group">
                                    <label for="exampleFormControlInput1">Asunto</label>
                                    <input type="text" name="asunto" class="form-control" id="exampleFormControlInput1" required value="Re: <?=$asunto;?>">
                                  </div>
                                  <div class="form-group">
                                    <label for="exampleFormControlTextarea1">Mensaje</label>
                                    <textarea name="mensaje" class="form-control" id="exampleFormControlTextarea1" required rows="3"></textarea>
                                  </div>
                                   <input type="submit" class="btn btn-primary" value="Enviar"/>
                                </form>
                                </div>
                                
                        </div>
                </div>
               
        </div>
       
      </div>

  </section>


</body>

</html>
<?php } ?>