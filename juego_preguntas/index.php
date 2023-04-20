<? 
 //ECHAR SI NO HAY SESION
 session_start();
 if (!isset($_SESSION['session_id']) || $_SESSION['session_id'] == ''){
         header('Location: ../index.php');//redirigir
 } else{

    include("includes/header.php");

?>

<script>
        $(document).ready(function(){
        
        });
</script>
</head>
<body id="page-top">


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
        <div class="col-lg-12 mx-auto">
          <h1 class="display-4 title" >&nbsp;&nbsp;Juego de preguntas</h1>
          
          <div class="col-md-12">
                  <img src="" class="imgportada" alt="Juego preguntas"/>
          </div>
          
          <div class="col-md-12">
                  <div class="col-md-6">
                          <form action="create_player.php" method="POST" class="inlineform">
                                 <div class="form-group">
                                    <small id="nombreHelp" class="form-text text-muted">Introduce tu nombre y tu avatar</small>
                                    <input type="text" class="form-control" id="nombrejugador" name="nombrejugador" aria-describedby="nombreHelp" placeholder="Tu nombre" required/>
                                    <input type="file" class="form-control" id="avatarjugador" name="avatarjugador" aria-describedby="avatarHelp" placeholder="Tu avatar"/>
                                    
                                  </div>
                                  <button type="submit" class="btn btn-primary">Crear jugador</button>
                         </form>
                 </div>
          </div>
                                 
           <div class="col-md-12">
                         
                  
                                     
                            
                  
          </div>
        </div>
      </div>
    </div>
    
  </section>
  
    

  <!-- Footer -->
  <footer class="py-5 bg-dark">
    <div class="container">
    <div class="col-md-5">
         <p>Valóranos y descubre más escape room en: <br/>
        <a target="_blank" href="https://runwilly.com" class="partner_logo"><img src="img/runwilly.svg" alt="Directorio de escape room RunWilly"></a></p>
     </div>
    </div>
    <!-- /.container -->
  </footer>
  

</body>
<?php } ?>

</html>
