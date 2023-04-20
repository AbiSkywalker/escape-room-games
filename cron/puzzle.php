<?php

//ECHAR SI NO HAY SESION
 session_start();
 if (!isset($_SESSION['session_id']) || $_SESSION['session_id'] == ''){
         header('Location: ../index.php');//redirigir
 } else{

?>
<html>
        <head>
                <link rel="stylesheet" href="css/styles.css">
                <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
                <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
                <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
                <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
                <script>
                  $( function() {
                    $( "#lista_instrucciones" ).sortable({ items: 'li[id!=cursor]' });;
                    $( "#lista_instrucciones" ).disableSelection();
                  } );
                </script>
                 
                <script src="js/puzzle.js"></script>
                <script src="js/fireworks.js"></script>
                
        </head>
        <body class="consola">
 
        <div id="maincontainer">
                <div id="topbar">
                        <ul>
                                <li style="color: #e400ff;">Root</li>
                                <li>Security</li>
                                <li>Console</li>
                                <li>Configuration</li>
                                <li>Exit</li>
                                <li><a href="help.php" target="_blank">Help</a></li>
                        </ul>
                </div>
                <div class="row">
                        <div class="col-md-4" id="sidebardiv">
                            <div id="console_emulator" class="terminal col-md-12">
                                    <ul id="lista_instrucciones">
                                            
                                            <li id="cursor" disabled><span class="blinking">&gt;</span></li>
                                    </ul>
                                    
                            </div>
                            <div class="col-md-3"></div>
                            <button id="run" class="col-md-4">Run</button>
                            <div class="col-md-1"></div>
                            <button id="clear" class="col-md-4">Clear</button>
                        </div>
                        <div class="col-md-8">
                          <div id="topcontrolbar">
                                    <div class="row">
                                        <button id="move_right_button"> moveRight()</button>
                                        <button id="move_left_button">moveLeft()</button>
                                        <button id="move_up_button">moveUp()</button>
                                        <button id="move_down_button">moveDown()</button>
                                        <button id="delete_button" disabled>Delete instruction</button>
                                    </div>
                                    <div class="row">
                                        <input type="number" max="20" min="0" id="steps_number" placeholder="$ nº" disabled>
                                        <button id="enter_steps_button" disabled>addStepsNumber()</button>
                                    </div>
                                    <div class="row">
                                        <div class="feedback_div">
                                            <div id="feedback_output"></div>
                                            <p class="progress_title">Progress: </p>
                                            <div id="progressbar">
                                                <div id="completed_part" style="width: 0%;"><span id="completed_num">0</span>%</div>
                                            </div>
                                            
                                        </div>
                                    </div>
    
                          </div>
                          <div class="row">
                                <div id="canvasdiv">
                                    <canvas width="420" height="150" id="mazecanvas">Can't load the maze game, because your browser doesn't support HTML5.</canvas>
                                    <noscript>JavaScript is not enabled. To play the game, you should enable it.</noscript>
                                </div>
                        </div>
                </div>
                
                </div>
        </div>

        </body>
</html>
<?php } ?>