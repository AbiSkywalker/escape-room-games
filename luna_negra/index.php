<? 
 //ECHAR SI NO HAY SESION
 session_start();
 if (!isset($_SESSION['session_id']) || $_SESSION['session_id'] == ''){
         header('Location: ../index.php');//redirigir
 } else{

    include("includes/header.php");

?>

<script src="js/room2.js"></script>
<script>

var comprobar_solucion = true;
        $(document).ready(function(){
                if(comprobar_solucion){
                        $('.btsolucion').click(function(){
                                console.log("solucionN");
                                $.ajax({
                                            url: 'solucion.php',
                                            type: 'POST',
                                            success: function(data) {
                                                   console.log(data);
                                                  comprobar_solucion = false;
                                                
                                            },
                                            error: function(xhr, ajaxOptions, thrownError) {}
                                    });
                                    
                                
                        });
                }
        });
</script>
</head>
<body id="page-top" class="suelo">


  <header class="">
    <div class="container text-right" id="esc_header">
     
    </div>
  </header>
  
  <section>


    <div class="container main-container">
    
    <div id="pared"></div>
    
    
    <a href="#modalPistas" data-toggle="modal"  data-target="#modalPistas"><div id="estanteria"></div></a>

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
    
    <div id="lampara"></div>
    <div id="escritorio">
    <div id="carta" data-toggle="modal" data-target="#modalCarta"></div>
                 
    <a href="papeles.php"><div id="papeles"></div></a>
  
    <a href="caja_fuerte.php"><div id="caja_fuerte"></div></a>
    <div id="id_postit" data-toggle="modal" data-target="#modalSessionid"></div>
    <div id="pared"></div>
  
    
  </section>
  <div class="modal fade mensajeid" id="modalSessionid" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-body">
              <?=$_SESSION['session_id'];?>
              </div>
            </div>
          </div>
</div>

<div class="modal fade" id="modalCarta" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <div class="modal-body text-left text-white">
                      <?=include ("mensaje_inicial.html");?>
      </div>
    </div>
  </div>
</div>




  <!-- Footer -->
  <footer class="py-5">
    <div class="container">

    </div>
    <!-- /.container -->
  </footer>

</body>
<?php } ?>

</html>
