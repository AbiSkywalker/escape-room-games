<?php ?>

  <html>
  <head>
  <link rel="stylesheet" href="css/main.css"/>
  
  </head>
  
  
  <body>
  
  <div class="root">  <input type="radio" name="vista" id="left">
    <input type="radio" name="vista" id="center" checked>
    <input type="radio" name="vista" id="right">   
  <input type="radio"  name="vista" id="door">
    <input type="checkbox" id="luz">

<div class="screen">
        <div class="room">
            <div class="pared_left">
             <label class="left" for="left"> </label>
                            <label class="luz" for="luz"></label> 
            </div>
            <div class="pared_front">
              <label class="center" for="center"></label>
              <label class="door" for="door"> 

              </label>
            </div>
            <div class="pared_right">
              <label class="right" for="right"></label>
          </div>
            <div class="floor"></div>
        </div>
    </div>
</div>
</body>
</html>