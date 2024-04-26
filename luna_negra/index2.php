<html lang="es-ES" >
<head>

<title>Escape Room Desde Casa</title>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
<link href="css/index2.css" rel="stylesheet">

<body id="page-top">


  <header class="">
    <div class="container text-right" id="esc_header">
     
    </div>
  </header>
  
  
  

<script src="js/room2.js"></script>

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
    
    <div id="lampara"></div>
    <div id="escritorio">
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



<!--PISTAS-->
 <div class="modal fade and carousel slide" id="modalPistas" style="z-index: 10000;" >
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-body">
          <div class="carousel-inner">
                            <div class="carousel-item active">
                                      <img class="d-block w-100" src="img/cuaderno1.png" alt="First slide">
                            </div>
                            <div class="carousel-item">
                                      <img class="d-block w-100" src="img/cuaderno2.png" alt="Second slide">
                            </div>
                            <div class="carousel-item">
                                      <img class="d-block w-100" src="img/cuaderno3.png" alt="Third slide">
                            </div>
          </div><!-- /.carousel-inner -->
          <a class="carousel-control-prev" href="#modalPistas" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                  </a>
                  <a class="carousel-control-next" href="#modalPistas" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                  </a>
        </div><!-- /.modal-body -->
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->

  <!-- Footer -->
  <footer class="py-5">
    <div class="container">

    </div>
    <!-- /.container -->
  </footer>

</body>
<?php 

//}

?>

</html>
