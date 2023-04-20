$( document ).ready(function() {
        var isTouchDevice = 'ontouchstart' in document.documentElement;
        console.log(isTouchDevice);
        if (isTouchDevice){
                var xDown = null;                                                        
                var yDown = null;
                var codigo_movimiento = '';
                
                var touches_clave = {
                   d1: { code: 'd', pressed: false, next: 'd2' },
                   d2: { code: 'd', pressed: false, next: 'u1' },
                   u1: { code: 'u', pressed: false, next: 'r1' },
                   r1: { code: 'r', pressed: false, next: 'u2' },
                   u2: { code: 'u', pressed: false, next: 'l1' },
                   l1: { code: 'l', pressed: false, next: 'u3' },
                   u3: { code: 'u', pressed: false, next: 'd3' },
                   d3: { code: 'd', pressed: false, next: 'u4' },
                   u4: { code: 'u', pressed: false, next: 'd1' }
               };
                var nextCodigo = 'd1';
                console.log(touches_clave);
       
               
                console.log("añadiendo listeners");
                $(document).on('touchstart', function(evt){
                        const firstTouch = getTouches(evt)[0];                                      
                        xDown = firstTouch.clientX;                                      
                        yDown = firstTouch.clientY;
                 });
                 
                 $(document).on('touchmove', function(evt){
                            if ( ! xDown || ! yDown ) {
                                return;
                            }
                            codigo_movimiento = '';
                            var xUp = evt.touches[0].clientX;                                    
                            var yUp = evt.touches[0].clientY;
                        
                            var xDiff = xDown - xUp;
                            var yDiff = yDown - yUp;
                        
                            if ( Math.abs( xDiff ) > Math.abs( yDiff ) ) {/*most significant*/
                                if ( xDiff > 0 ) {
                                        codigo_movimiento =  'l';
                                } else {
                                        codigo_movimiento =  'r';
                                }                       
                            } else {
                                if ( yDiff > 0 ) {
                                        codigo_movimiento =  'u';
                                } else { 
                                        codigo_movimiento =  'd';
                                }                                                                 
                            }
                            /* reset values */
                            xDown = null;
                            yDown = null;      

                        });
                        
                        
                $(document).on('touchend', function(evt){
                            console.log(codigo_movimiento);
                            if (codigo_movimiento === touches_clave[nextCodigo].code) {
                                   console.log("bien");
                                   touches_clave[nextCodigo].pressed = true;
                                   nextCodigo = touches_clave[nextCodigo].next;
                               } else {
                                   console.log("mal");
                                   touches_clave.d1.pressed = false;
                                   touches_clave.d2.pressed = false;
                                   touches_clave.u1.pressed = false;
                                   touches_clave.r1.pressed = false;
                                   touches_clave.u2.pressed = false;
                                   touches_clave.l1.pressed = false;
                                   touches_clave.u3.pressed = false;
                                   touches_clave.d3.pressed = false;
                                   touches_clave.u4.pressed = false;
                                   nextCodigo = 'd1';
                               }
                        
                               if (touches_clave.d1.pressed && touches_clave.d2.pressed && touches_clave.u1.pressed && 
                               touches_clave.r1.pressed && touches_clave.u2.pressed && touches_clave.l1.pressed &&
                               touches_clave.u3.pressed && touches_clave.d3.pressed && touches_clave.u4.pressed) {
                                    $("#success-alert").fadeTo(15000, 500).slideUp(500, function(){
                                            $("#success-alert").slideUp(500);
                                      });
                                    window.setTimeout(function(){
                                        window.location.href = "../../../cron/puzzle.php";
                                    }, 1500);
                                    
                               }
                            
                 });
                        
        } 
        
        function getTouches(evt) {
          return evt.touches ||             // browser API
                 evt.originalEvent.touches; // jQuery
        }                                                     
                
        
       var keys = {
           d1: { code: 40, pressed: false, next: 'd2' },
           d2: { code: 40, pressed: false, next: 'u1' },
           u1: { code: 38, pressed: false, next: 'r1' },
           r1: { code: 39, pressed: false, next: 'u2' },
           u2: { code: 38, pressed: false, next: 'l1' },
           l1: { code: 37, pressed: false, next: 'u3' },
           u3: { code: 38, pressed: false, next: 'd3' },
           d3: { code: 40, pressed: false, next: 'u4' },
           u4: { code: 38, pressed: false, next: 'd1' }
       };
       
       var nextKey = 'd1';
       

        $(document).keydown(function(e){
               console.log (e.keyCode);
               
               if (e.keyCode === keys[nextKey].code) {
                   keys[nextKey].pressed = true;
                   nextKey = keys[nextKey].next;
               } else {
                   keys.d1.pressed = false;
                   keys.d2.pressed = false;
                   keys.u1.pressed = false;
                   keys.r1.pressed = false;
                   keys.u2.pressed = false;
                   keys.l1.pressed = false;
                   keys.u3.pressed = false;
                   keys.d3.pressed = false;
                   keys.u4.pressed = false;
                   nextKey = 'd1';
               }
        
               if (keys.d1.pressed && keys.d2.pressed && keys.u1.pressed && keys.r1.pressed && keys.u2.pressed && keys.l1.pressed &&
               keys.u3.pressed && keys.d3.pressed && keys.u4.pressed) {
                    $("#success-alert").fadeTo(15000, 500).slideUp(500, function(){
                            $("#success-alert").slideUp(500);
                      });
                    window.setTimeout(function(){
                        window.location.href = "../../../cron/puzzle.php";
                    }, 1500);
                    
               }
        });


		    
});