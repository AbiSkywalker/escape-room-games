<?php

 //ECHAR SI NO HAY SESION
 session_start();
 if (!isset($_SESSION['session_id']) || $_SESSION['session_id'] == ''){
         header('Location: ../index.php');//redirigir
 } else{         


?>

<html lang="es-ES" >
<head>

<title>CRON - Desktop</title>

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
<script src="js/short_cut.js"></script>

<script>


</script>


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
<main role="main">
  <section id="main">

      <div class="row">
        <div class="col-md-4 loginsidebar">
                <ul class="loginmenu">
                         <li class="active"> <a href="login.php">Mi perfil</a></li>
                         <li class=""><a href="inbox.php">Bandeja de entrada</a></li>
                         <li class=""><a href="fileindex.php">Documentos</a></li>
                         <li class=""><a href="maps.php">WorldwideCRON</a></li>
                </ul>
        </div>
        <div class="col-md-8">
        
                <div class="row">
                        <div class="col-sm-3"><img class="img-thumbnail" src="img/fotoperfil.jpg" alt="photo"/></div>
                         <div class="col-sm-9">
                                <h2 class="nombreperfil">Luis Griso</h2>
                                <h4>Puesto</h4>
                                <p>Responsable de prensa</p>
                                <p>Oficinas centrales Madrid</p>
                                <p>Paseo de la Chopera S/N</p>
                                <p> 28108 Alcobendas, Madrid</p>
                                <h4>Datos de contacto</h4>
                                <p> <b>Telefono </b> 6998 7226 5541 </p>
                                <p> <b>Dirección </b> C/ 57 Nº 205 5J</p>
                                
                                </div>
                </div>
        </div>
       
      </div>

  </section>
</main>


</body>

</html>
<?php 
}
?>