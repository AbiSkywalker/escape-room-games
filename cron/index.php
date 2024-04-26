<?php

 //ECHAR SI NO HAY SESION
 session_start();
 if (!isset($_SESSION['session_id']) || $_SESSION['session_id'] == ''){
         header('Location: ../index.php');//redirigir
 } else{
 
   $mensaje_login = "";
   
   if ($_POST["mail"] && $_POST["pass"] ){
           if($_POST["mail"] == 'lgriso@cron.inc' && $_POST["pass"] == '4442'){
                   $mensaje_login = "CORRECTO";
                   header('Location: login.php');
           }
           else{
                   $mensaje_login = "ERROR EN LOS DATOS";
                   //redirigir
           }
   
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

<title>CRON - Centro de Investigación y Desarrollo</title>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>


<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

<link href="css/all.css" rel="stylesheet">
<link rel="stylesheet" href="css/styles.css">
<script src="js/short_cut.js"></script>
<script>


$( document ).ready(function() {

       window.setTimeout(function(){
                        $("#modalMensaje").modal('show');
                    }, 3000);		    
});

</script>
<style>

#success-alert{
    display: none;
    width: 80%;
    margin: 0 auto;
}

</style>


</head>

<body id="page-top">

  <!-- Navigation -->

  <header class="bg-primary text-white">
    <div class="container text-right">
      <h1>C.R.O.N.</h1>
      <p class="lead">Ingeniería Molecular y Soluciones Biotecnológicas</p>
    </div>
  </header>
  <div class="alert alert-success" id="success-alert">
    <button type="button" class="close" data-dismiss="alert">x</button>
    <strong>Correcto! </strong>
    Acceso secreto desbloqueado.
</div>
<nav>
    <ul>
        <li>
                <button class="btn btn-primary" id="login" data-toggle="modal" data-target="#modalLogin">Entrar</button>
                
                <div class="modal fade text-left" id="modalLogin" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Iniciar sesión</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                              <form action="#" method="POST">
                                    <?=$mensaje_login?>
                                    <div class="form-group">
                                            <label for="loginmail">Usuario</label>
                                            <input type="email" class="form-control" id="loginmail" name="mail" placeholder="Email" required>
                                    </div>
                                    <div class="form-group">
                                            <label for="loginpass">Contraseña</label>
                                            <input type="password" class="form-control" id="loginpass" name="pass" placeholder="Clave" required>
                                    </div>
                                    <div class="form-group">
                                            <input type="submit" value="Entrar" class="btn btn-primary"/>
                                    </div>
                                    
                              </form>
                      
                      </div>
                    </div>
                  </div>
                </div>
                
         </li>
         <li>
                 <button class="btn btn-primary" id="video" data-toggle="modal" data-target="#modalMensaje">Mensaje</button>
                 <div class="modal fade" id="modalMensaje" tabindex="-1" role="dialog" aria-hidden="true">
                  <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Nuevo mensaje recibido</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body text-left text-white">
                      <?=include ("mensaje_inicial.php");?>
                      </div>
                    </div>
                  </div>
                </div>
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
                      <div class="modal-body text-white">
                      <?=include ("pistas.html");?>
                      </div>
                    </div>
                  </div>
                </div>
         </li>
         
    </ul>
</nav>

  <section id="about">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 mx-auto">
          <h2>CRON</h2>
          <p class="lead">Empresa líder de I+D, a la vanguardia en numerosos sectores de la biotecnología y la ingeniería física</p>
        </div>
      </div>
    </div>
  </section>
<section id="work-shop" class="section-padding">
    <div class="container">
      <div class="row">
        <div class="header-section text-center col-md-12">
          <p></p>
          <h2>Áreas de actividad</h2>
          <p></p>
          <hr class="bottom-line">
        </div>
        <div class="col-md-4">
          <div class="service-box text-center">
            <div class="icon-box" id="microscopio">
              
            </div>
            <div class="icon-text">
              <h4 class="ser-text">Nanobiología</h4>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="service-box text-center">
            <div class="icon-box" id="atomo">
            </div>
            <div class="icon-text">
              <h4 class="ser-text">Ingeniería física</h4>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="service-box text-center">
            <div class="icon-box" id="cerebro">
            </div>
            <div class="icon-text">
              <h4 class="ser-text">Machine Learning</h4>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  
  <section id="noticia1" class="bg-light">
    <div class="container">
      <div class="row">
          <div class="col-lg-12 mx-auto">
                <h3>Se estudia la criogenización humana</h3>
          </div>
          <div class="col-md-4">
                  <img src="img/portada1.jpg" class="img-fluid"/>
          </div>
          <div class="col-md-8 noticiaportada">
                  <p>Los últimas experimentos realizados en los laboratorios de CRON en Houston demuestran que se puede mantener la vida 
                  en estado de "hibernación" durante largos periodos de tiempo. Las cápsulas de criogenización desarrolladas
                  por CRON reducen las constantes vitales del individuo a los parámetros mínimos indispensables para la supervivencia 
                  de las células, mientras que suprimen practicamente toda su actividad cerebral. Esto permite inducir al individuo en una 
                  especie de "stand by", durante el cual el cuerpo sobrevive, pero no envejece.
                  </p>
          </div>
      </div>
    </div>
  </section>
  
  <section id="noticia2" class="bg-light">
    <div class="container">
      <div class="row">
          <div class="col-lg-12 mx-auto">
                <h3>Un nuevo tratamiento en investigación consigue erradicar las células de cáncer de páncreas</h3>
          </div>
          <div class="col-md-4">
                  <img src="img/portada2.jpg" class="img-fluid"/>
          </div>
          <div class="col-md-8 noticiaportada">
                  <p>Nuestros investigadores en Tel Aviv (Israel) están trabajando en una nueva molécula capaz de «erradicar eficientemente»
                  las células de cáncer de páncreas desencadenando su autodestrucción. Este nuevo tratamiento redujo el número de células 
                  cancerosas en un 90 por ciento en los tumores desarrollados un mes después de la administración.
                  Este resultado ha llevado a los investigadores a calificar de «prometedoras» las primeras conclusiones.</p>
          </div>
      </div>
    </div>
  </section>
  
  <section id="noticia3" class="bg-light">
    <div class="container">
      <div class="row">
          <div class="col-lg-12 mx-auto">
                <h3>CRON presenta el nuevo nanochip CR-27</h3>
          </div>
          <div class="col-md-4">
                  <img src="img/portada3.jpg" class="img-fluid"/>
          </div>
          <div class="col-md-8 noticiaportada">
                  <p>Durante la celebración de la XXIII Convención Anual de Nanotecnología, CRON presentó un nuevo nanoprocesador que imita 
                  las conexiones neuronales del cerebro humano. Esta tecnología hace posible que la velocidad de cálculo del mismo
                  supere con creces a cualquier superordenador actual, creando el marco perfecto para futuros proyectos de <i>Deep Learning</i>
                  e inteligencia artificial.  </p>
          </div>
      </div>
    </div>
  </section>


  <!-- Footer -->
  <footer class="py-5 bg-dark">
    <div class="container">
      <p class="m-0 text-center text-white">Copyright &copy; CRON 2020</p>
    </div>
    <!-- /.container -->
  </footer>

</body>

</html>
<?php } ?>
