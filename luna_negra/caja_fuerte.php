<? 
 //ECHAR SI NO HAY SESION
 session_start();
 if (!isset($_SESSION['session_id']) || $_SESSION['session_id'] == ''){
         header('Location: ../index.php');//redirigir
 } else{

    include("includes/header.php");

?>


<script src="js/safebox.js"></script>

</head>
<body id="page-top" class="pared" style="background:  #83d1d2;">

  <section id="pared"> 
  <header class="">
    <nav>
            <div class="container controllers_safebox" id="esc_header" >
                    <a href="index.php"><button id="btAtras" class="btn btn-primary">Atras</button><a/>
            </div>        
    </nav>
  </header>
  
  <form id="form_safebox" action="actualizar_caja.php" method="POST">
           <input id="clave_introducida" type="hidden" name="clave_introducida"/>
  </form>
  
    <div class="container main-container" id="main_cont">
    
    <div id="safeboxdiv">
            <div id="safeboxdoor">
                    <div id="safeboxscreen" class="row">
                           <div class="col-md-6 cajateclas">
                            <div id="numscreen">
                                <p>
                                    <span id="clave_pos_1">_</span>
                                    <span id="clave_pos_2">_</span>
                                    <span id="clave_pos_3">_</span>
                                    <span id="clave_pos_4">_</span>
                                </p>
                            </div>
                            <div id="keysscreen">
                                <div class="row">
                                    <button class="col-md-4 box_key" value="7">7</button>
                                    <button class="col-md-4 box_key" value="8">8</button>
                                    <button class="col-md-4 box_key" value="9">9</button>
                                </div>
                                <div class="row">
                                    <button class="col-md-4 box_key" value="4">4</button>
                                    <button class="col-md-4 box_key" value="5">5</button>
                                    <button class="col-md-4 box_key" value="6">6</button>
                                </div><div class="row">
                                    <button class="col-md-4 box_key" value="1">1</button>
                                    <button class="col-md-4 box_key" value="2">2</button>
                                    <button class="col-md-4 box_key" value="3">3</button>
                                </div>
                                <div class="row">
                                    <button class="col-md-8 box_key" value="0">0</button>
                                    <button class="col-md-4 box_key" value="AC">AC</button>
                                </div>
                            </div>
                            </div>
                            <div class="col-md-2"></div>
                            <div class="col-md-4 caja_cerradura">
                                           <div class="" id="cerradura"></div> 
                                           <div class="" id="dibujo"></div>    
                                    
                           </div>             
                   </div>
            </div>
            <div id="safeboxinside"></div>
    </div>
    

    
    
    </div>
    
   
    
  </section>
  <section class="escritorio"></section>
  

  <!-- Footer -->
  <footer class="py-5">
    <div class="container">

    </div>
    <!-- /.container -->
  </footer>

</body>

</html>
<?php } ?>