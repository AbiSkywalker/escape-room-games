<?php

 //ECHAR SI NO HAY SESION
 session_start();
 if (!isset($_SESSION['session_id']) || $_SESSION['session_id'] == ''){
         header('Location: ../index.php');//redirigir
 } else{
   //Actualizar sesion
$idweb = $_SESSION['session_id'];
// Create connection

   include("includes/connect.php");
   $conn = new mysqli($servername, $username, $password, $db);


// Check connection
if ($conn->connect_error) {
    die("Error de conexion: " . $conn->connect_error);
}

$query = $conn->prepare("SELECT lab1desactivado, lab2desactivado, lab3desactivado, lab4desactivado, lab5desactivado, lab6desactivado FROM equiposcron WHERE idweb = ?");
$query->bind_param("s", $idweb);
$query->execute();         
$query->bind_result($l1, $l2, $l3, $l4, $l5, $l6);
         
while ($query->fetch()){
        //Compruebo si han recibido mail
        $_SESSION['lab1desactivado'] = $l1;
        $_SESSION['lab2desactivado'] = $l2;
        $_SESSION['lab3desactivado'] = $l3;
        $_SESSION['lab4desactivado'] = $l4;
        $_SESSION['lab5desactivado'] = $l5;
        $_SESSION['lab6desactivado'] = $l6;
}

setcookie('XF103',  $_SESSION['lab1desactivado'], time() + 3600);
setcookie('GF289',  $_SESSION['lab2desactivado'], time() + 3600);
setcookie('GS554',  $_SESSION['lab3desactivado'], time() + 3600);
setcookie('MD351',  $_SESSION['lab4desactivado'], time() + 3600);
setcookie('GA910',  $_SESSION['lab5desactivado'], time() + 3600);
setcookie('LP739',  $_SESSION['lab6desactivado'], time() + 3600);


$query->close();

?>

<html lang="es-ES" >
<head>

<title>CRON - Gestion Remota Laboratorios</title>

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

<script src="js/laboratorios.js"></script>

<script>
function getCookie(name) {
    let value = '; ' + document.cookie;
    let parts = value.split('; ' + name + '=');

    if (parts.length == 2) {
        return parts.pop().split(';').shift();
    }
}

function updatevalues(dest, val) {
console.log(val);
  $('#'+dest).text(val); 
}

</script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<link href="css/all.css" rel="stylesheet"/>
<link rel="stylesheet" href="css/styles.css"/>

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

  <section id="main">
       
      <div class="row">
        <div class="col-md-7">
                <div id="mapabase">
                        <div id="americanorte" <?php if ($_SESSION['lab1desactivado']){ echo 'class="desactivado"';} ?>></div>
                        <div id="americasur" <?php if ($_SESSION['lab2desactivado']){ echo 'class="desactivado"';} ?>></div>
                        <div id="europa" <?php if ($_SESSION['lab3desactivado']){ echo 'class="desactivado"';} ?>></div>
                        <div id="asia" <?php if ($_SESSION['lab5desactivado']){ echo 'class="desactivado"';} ?>></div>
                        <div id="africa" <?php if ($_SESSION['lab4desactivado']){ echo 'class="desactivado"';} ?>></div>
                        <div id="oceania" <?php if ($_SESSION['lab6desactivado']){ echo 'class="desactivado"';} ?>></div>
                </div>
        </div>
        <div class="col-md-4">
                <div id="acceso_lab">
                        <h4>Gestión Remota de Laboratorios </h4>
                        <form action="acceder.php" method="post" id="form-acceso">
                                 <div class="form-group">
                                    <label for="coordy">Latitud</label>
                                    <input type="text" name="coordy" required id="coordy" placeholder="Latitud">
                                 </div>
                                <div class="form-group">
                                    <label for="coordx">Longitud</label>
                                    <input type="text" name="coordx" required id="coordx" placeholder="Longitud">
                                 </div>
                                 <div class="form-group">
                                    <label for="codigolab">Código</label>
                                    <input type="text" name="codigolab" required id="codigolab" placeholder="Código del laboratorio">
                                 </div>
                                 <button type="submit" class="btn btn-primary" id="btnacceder">Acceder</button>
                        </form>
                </div>
        </div>
       </div>
  </section>
  
  <div class="modal" id="config-lab" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="modal-title"></h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="modal-body">
        

      </div>
      <div class="modal-footer">
        <!--button type="button" class="btn btn-primary">Save changes</button-->
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


<!--Panel electrico-->
<div class="modal" id="panel-electrico" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="modal-title">Panel Eléctrico</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
      <div class="row">
            <div class="pantalla-estado" id="pantalla-elec">
                <div class="feedbackmsg"></div>
                <table class="2cols">
                    <tr>
                        <td><span id="voltaje-actual">97 %</span><br><span class="tdlabel">Potencia</span></td>
                        <td><span class="tdlabel">Usando generador principal</span><br><span class="tdlabel">Cargando generadores secundarios</span></td>
                    </tr>
                </table>
            </div>

      </div>
      
      <div class="modal-body" id="modal-body">
        
        <form method="post" action="controlremoto.php" id="form-elec">
          <input type="hidden" class="hiddencodlab" name="codigo_lab">
          <div class="row">
            <div class="col col-md-8">
                <label for="voltaje">Regulador de potencia</label>
                <input type="range" class="custom-range" min="0" max="100" step="1" id="voltaje" name="voltaje" value="97"
                onchange="updatevalues('voltajeval', this.value +' %');"/>
                <span  class="showval" id="voltajeval">97 %</span>
            </div>
            
          </div>
          
          <div class="row footerpanel">
            <div class="col col-md-6">
                <!-- PONER RESET?-->
            </div>
            <div class="col col-md-6">
                <input type="submit" class="btn btn-primary" value="Establecer">
            </div>
          </div>
          
        </form>

      </div>
    </div>
  </div>
</div>


<!--Redes-->
<div class="modal" id="panel-redes" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="modal-title">Configuración de Redes</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
      <div class="row">
            <div class="pantalla-estado" id="pantalla-redes">
                <div class="feedbackmsg"></div>
                <table class="2cols">
                    <tr>
                        <td><span id="frecuencia1-actual">5 GHz</span><br><span class="tdlabel">Banda Antena 1</span></td>
                        <td><span id="canal1-actual">11</span><br><span class="tdlabel">Canal Antena 1</span></td>
                    </tr>
                    <tr>
                        <td><span id="frecuencia2-actual">5 GHz</span><br><span class="tdlabel">Banda Antena 2</span></td>
                        <td><span id="canal2-actual">7</span><br><span class="tdlabel">Canal Antena 2</span></td>
                    </tr>
                </table>
            </div>

      </div>
      
      <div class="modal-body" id="modal-body">
        
        <form method="post" action="controlremoto.php" id="form-redes">
          <input type="hidden" class="hiddencodlab" name="codigo_lab">
          <div class="row">
            <div class="col col-md-6">
                <label for="banda">Banda de red (Antena 1)</label>
                <select class="form-control" id="banda" name="banda">
                      <option value="2.4">2.4 GHz</option>
                      <option value="5">5 GHz</option>
                </select>
            </div>
            <div class="col col-md-6">
                <label for="canal">Canal de red (Antena 1)</label>
                <select class="form-control" id="canal" name="canal">
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                      <option value="5">5</option>
                      <option value="6">6</option>
                      <option value="7">7</option>
                      <option value="8">8</option>
                      <option value="9">9</option>
                      <option value="10">10</option>
                      <option value="11">11</option>
                </select>
            </div>
          </div>
          <div class="row">
            <div class="col col-md-6">
                <label for="banda2">Banda de red (Antena 2)</label>
                <select class="form-control" id="banda2" name="banda2">
                      <option value="2.4">2.4 GHz</option>
                      <option value="5">5 GHz</option>
                </select>
            </div>
            <div class="col col-md-6">
                <label for="canal2">Canal de red (Antena 2)</label>
                <select class="form-control" id="canal2" name="canal2">
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                      <option value="5">5</option>
                      <option value="6">6</option>
                      <option value="7" selected>7</option>
                      <option value="8">8</option>
                      <option value="9">9</option>
                      <option value="10">10</option>
                      <option value="11">11</option>
                </select>
            </div>
          </div>
          
          <div class="row footerpanel">
            <div class="col col-md-6">
                <!-- PONER RESET?-->
            </div>
            <div class="col col-md-6">
                <input type="submit" class="btn btn-primary" value="Establecer">
            </div>
          </div>
          
        </form>

      </div>
    </div>
  </div>
</div>


<!--Panel entorno-->
<div class="modal" id="panel-entorno" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="modal-title">Entorno</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
      <div class="row">
            <div class="pantalla-estado" id="pantalla-entorno">
                <div class="feedbackmsg"></div>
                <table class="2cols">
                    <tr>
                        <td><span id="temp-actual">19.5ºC</span><br><span class="tdlabel">temperatura</span></td>
                        <td><span id="humedad-actual">50 %</span><br><span class="tdlabel">humedad</span></td>
                    </tr>
                </table>
            </div>

      </div>
      
      <div class="modal-body" id="modal-body">
        
        <form method="post" action="controlremoto.php" id="form-entorno">
          <input type="hidden" class="hiddencodlab" name="codigo_lab">
          <input type="hidden" name="oport" id="oport" value="3">
          <div class="row">
            <div class="col col-md-6">
                <label for="temp">Temperatura</label>
                <input type="range" class="custom-range" min="0" max="40" step="0.5" id="temp" name="temp" value="19.5"
                onchange="updatevalues('o2val', this.value+'ºC');"/>
                <span class="showval" id="o2val">19.5ºC</span>
            </div>
            <div class="col col-md-6">
                <label for="humedad">Humedad</label>
                <input type="range" class="custom-range" min="0" max="100" step="1" id="humedad" name="humedad" value="50"
                onchange="updatevalues('humedadval', this.value+'%');"/>
                <span  class="showval" id="humedadval">50 %</span>
            </div>
          </div>
          
          <div class="row footerpanel">
            <div class="col col-md-6">
                <!-- PONER RESET?-->
            </div>
            <div class="col col-md-6">
                <input type="submit" class="btn btn-primary" value="Establecer">
            </div>
          </div>
          
        </form>

      </div>
    </div>
  </div>
</div>


<!--Panel atmosfera-->
<div class="modal" id="panel-atmosfera" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="modal-title">Cámaras Criogenización</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
      <div class="row">
            <div class="pantalla-estado" id="pantalla-atmosfera">
                <div class="feedbackmsg"></div>
                <table class="2cols">
                    <tr>
                        <td><span id="temperatura-actual">-32º</span><br><span class="tdlabel">temperatura</span></td>
                        <td></td>
                    </tr>
                </table>
            </div>

      </div>
      
      <div class="modal-body" id="modal-body">
        
        <form method="post" action="controlremoto.php" id="form-atmosfera">
          <input type="hidden" class="hiddencodlab" name="codigo_lab">
          <div class="row">
            <div class="col col-md-6">
                <label for="temperatura">Temperatura</label>
                <input type="range" class="custom-range" min="-80" max="50" step="1" id="temperatura" name="temperatura" value="-50"
                onchange="updatevalues('tempval', this.value+'ºC');"/>
                <span class="showval" id="tempval">-50ºC</span>
            </div>
            <div class="col col-md-6">
            </div>
          </div>
          
          <div class="row footerpanel">
            <div class="col col-md-6">
                <!-- PONER RESET?-->
            </div>
            <div class="col col-md-6">
                <input type="submit" class="btn btn-primary" value="Establecer">
            </div>
          </div>
          
        </form>

      </div>
    </div>
  </div>
</div>

<!--Panel drenaje-->
<div class="modal" id="panel-drenaje" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="modal-title">Sistema de drenaje</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
      <div class="row">
            <div class="pantalla-estado" id="pantalla-drenaje">
                <div class="feedbackmsg"></div>
                <table class="2cols">
                    <tr>
                        <td><span id="c1-actual">Cerrada</span><br><span class="tdlabel">Compuerta 1</span></td>
                        <td><span id="c2-actual">Abierta</span><br><span class="tdlabel">Compuerta 1</span></td>
                    </tr>
                    <tr>
                        <td><span id="c3-actual">Abierta</span><br><span class="tdlabel">Compuerta 3</span></td>
                        <td><span id="c4-actual">Abierta</span><br><span class="tdlabel">Compuerta 4</span></td>
                    </tr>
                </table>
            </div>

      </div>
      
      <div class="modal-body" id="modal-body">
        
        <form method="post" action="controlremoto.php" id="form-drenaje">
          <input type="hidden" class="hiddencodlab" name="codigo_lab">
          <div class="row">
            <div class="col col-md-6">
                <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" id="c1" name="c1" 
                        onchange="updatevalues('c1val', (this.checked) ? 'Abierta' :'Cerrada');"/>
                        <label for="c1" class="custom-control-label">Compuerta 1</label>
                </div>
                <span  class="showval" id="c1val">Cerrada</span>
            </div>
            <div class="col col-md-6">
                <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" id="c2" name="c2" checked
                onchange="updatevalues('c2val', (this.checked) ? 'Abierta' :'Cerrada');"/>
                        <label for="c2" class="custom-control-label">Compuerta 2</label>
                </div>
                <span  class="showval" id="c2val">Abierta</span>
            </div>
          </div>
          <div class="row">
            <div class="col col-md-6">
                <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" id="c3" name="c3" checked 
                onchange="updatevalues('c3val', (this.checked) ? 'Abierta' :'Cerrada');"/>
                        <label for="c3" class="custom-control-label">Compuerta 3</label>
                </div>
                <span  class="showval" id="c3val">Abierta</span>
            </div>
            <div class="col col-md-6">
                <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" id="c4" name="c4" checked
                        onchange="updatevalues('c4val', (this.checked) ? 'Abierta' :'Cerrada');"/>
                        <label for="c4" class="custom-control-label">Compuerta 4</label>
                </div>
                <span  class="showval" id="c4val">Abierta</span>
            </div>
          </div>
          
          <div class="row footerpanel">
            <div class="col col-md-6">
                <!-- PONER RESET?-->
            </div>
            <div class="col col-md-6">
                <input type="submit" class="btn btn-primary" value="Establecer">
            </div>
          </div>
          
        </form>

      </div>
    </div>
  </div>
</div>

<!--Panel navegacion-->
<div class="modal" id="panel-navegacion" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="modal-title">Navegación</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
      <div class="row">
            <div class="pantalla-estado" id="pantalla-navegacion">
                <div class="feedbackmsg"></div>
                <table class="2cols">
                    <tr>
                        <td><span id="rumbo-actual">N 80º W</span><br><span class="tdlabel">Rumbo</span></td>
                        <td><span id="velocidad-actual">40 nudos</span><br><span class="tdlabel">Velocidad</span></td>
                    </tr>
                </table>
            </div>

      </div>
      
      <div class="modal-body" id="modal-body">
        
        <form method="post" action="controlremoto.php" id="form-navegacion">
          <input type="hidden" class="hiddencodlab" name="codigo_lab">
          <div class="row">
            <div class="col col-md-6">
                <select name="rumboy" id="rumboy">
                        <option value="N">N</option>
                        <option value="S">S</option>
                </select>
                <input type="number" name="gradosrumbo" value="80" min=0 max=90 id="gradosrumbo"/>
                <select name="rumbox" id="rumbox">
                        <option value="W">W</option>
                        <option value="E">E</option>
                </select>
            </div>
            <div class="col col-md-6">
                    <label for="velocidad">Velocidad</label>
                    <input type="range" class="custom-range" min="0" max="100" step="1" id="velocidad" name="velocidad" value="40"
                    onchange="updatevalues('velval', this.value+' nudos');"/>
                    <span class="showval" id="velval">40 nudos</span>
            </div>
          </div>
          
          
          <div class="row footerpanel">
            <div class="col col-md-6">
                <!-- PONER RESET?-->
            </div>
            <div class="col col-md-6">
                <input type="submit" class="btn btn-primary" value="Establecer">
            </div>
          </div>
          
        </form>

      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="findeljuegomodal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
    <div class="modal-header">
        <h4 class="modal-title">ERROR CRÍTICO</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
              <h5>Laboratorios desconectados</h5>
              <p>Viaje cancelado</p>
      </div>
    </div>
  </div>
</div>

  <!-- Footer -->
  <footer class="py-5 bg-dark">
    <div class="container">
      <p class="m-0 text-center text-white">CRON &copy; 2020</p>
    </div>
  </footer>

</body>

</html>
<?php } ?>