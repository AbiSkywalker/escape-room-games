<? 
 //ECHAR SI NO HAY SESION
 session_start();
 if (!isset($_SESSION['session_id']) || $_SESSION['session_id'] == ''){
         header('Location: ../index.php');//redirigir
 } else{

    include("includes/header.php");
    
    $puzzle_completado = false;
    
    if (isset($_GET['puzzle_completado']) && $_GET['puzzle_completado'] != 0){
            $puzzle_completado = $_GET['puzzle_completado'];
    }

?>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
<script src="js/jquery-ui-touch-punch-master/jquery.ui.touch-punch.js"></script>

<script>
<?
         
 if (isset($_SESSION['puzzle_completado']) && $_SESSION['puzzle_completado'] != 0){
         $puzzle_completado = $_SESSION['puzzle_completado'];
         echo "var puzzle_completado = ".$_SESSION['puzzle_completado'];
         
 } else if (isset($_GET['puzzle_completado']) && $_GET['puzzle_completado'] != 0){
         $puzzle_completado = $_GET['puzzle_completado'];
         echo "var puzzle_completado=".$_GET['puzzle_completado'];
 }else{
         echo "var puzzle_completado=0;";
 }

?>

</script>
<script src="js/papeles.js"></script>


</head>
<body id="page-top" class="mesa">


  <header class="">
    <nav>
            <div class="container" id="esc_header" class="controllers_puzzle">
                    <a href="index.php"><button id="btAtras" class="btn btn-primary">Atras</button><a/>
                    
                <?php 
                        if ($puzzle_completado == 0){
                ?>

                    <button id="btRotar" class="btn btn-primary">Rotar</button>
                    
                    <?
                            } 
                    ?>
                    <button id="btGirar" class="btn btn-primary">Girar</button>
            </div>        
    </nav>
  </header>
  
  <section>
    <div class="container main-container">
        <div class="row">
                
                <div class="row" id="divpuzzle">
                
                <?php 
                        if ($puzzle_completado == 0){
                ?>

                  <div class="pieza col-md-3" id="piece-1"><img src="img/1.png"/></div>
                  <div class="pieza col-md-3" id="piece-2"><img src="img/2.png"/></div>
                  <div class="pieza col-md-3" id="piece-3"><img src="img/3.png"/></div>
                  <div class="pieza col-md-3" id="piece-4"><img src="img/4.png"/></div>
                  <div class="pieza col-md-3" id="piece-5"><img src="img/5.png"/></div>
                  <div class="pieza col-md-3" id="piece-6"><img src="img/6.png"/></div>
                  <div class="pieza col-md-3" id="piece-7"><img src="img/7.png"/></div>
                  <div class="pieza col-md-3" id="piece-8"><img src="img/8.png"/></div>
                  
                 <?php 
                      }  else if ($puzzle_completado == 1){
                 ?>
                  <div class="puzzle_completo col-md-12 visible" id="puzzle-1"><img src="img/mapa.png"/></div>
                  <div class="puzzle_completo col-md-12 hidden" id="puzzle-2"><img src="img/mapab.png"/></div>
                 <?php 
                      }  else if ($puzzle_completado == 2){
                 ?>
                  <div class="puzzle_completo col-md-12 hidden" id="puzzle-1"><img src="img/mapa.png"/></div>
                  <div class="puzzle_completo col-md-12 visible" id="puzzle-2"><img src="img/mapab.png"/></div>
                </div>
                <?php 
                      } 
                ?>
        </div>


    

    
    
    </div>
    
   
    
  </section>
  

  <!-- Footer -->
  <footer class="">
    <div class="container">

    </div>

  </footer>

</body>

</html>
<?php } ?>