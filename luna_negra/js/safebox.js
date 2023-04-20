  

$(document).ready(function(){
       set_safebox_size();
       $(window).on('resize', function(){
              set_safebox_size();
        });

       
                       

         var claveintroducida = "";
         var num_teclas = 0;
 
       $('#keysscreen .box_key').click(function(){
               
               num_teclas++;
               
               valor = $(this).val();
               
               if (valor == "AC"){ //borrar
                        $("#numscreen").removeClass("claveerror").removeClass("claveok")
                        $("#numscreen span").html("_");
                        
                        claveintroducida = "";
                        num_teclas = 0; //resetear clave
                }else{
                    if(num_teclas == 1){
                            $("#numscreen").removeClass("claveerror").removeClass("claveok")
                            $("#numscreen span").html("_");
                            claveintroducida = "";
                            
                    }
                    
                    claveintroducida = claveintroducida + valor;
                    $("#numscreen span#clave_pos_"+num_teclas).html(valor);
                    $("#clave_introducida").val(claveintroducida);
                    
                    if(num_teclas == 4){
                            
                            console.log("COMPROBAR CLAVE: "+claveintroducida);
                            $form = $('#form_safebox');
                            var ajaxData = new FormData($form.get(0));
                            //console.log(ajaxData);
                            $.ajax({
                                    url: $form.attr('action'),
                                    type: $form.attr('method'),
                                    data: ajaxData, 
                                    dataType: 'json',
                                    cache: false,
                                    contentType: false,
                                    processData: false,
                                    success: function(data) {
                                      console.log(data);
                                      if (data.caja_abierta){ 
                                        
                                            $("#numscreen").removeClass("claveerror").addClass("claveok"); 
                                            $("#cerradura").addClass("unlocking"); 
                                            console.log("test");
                                            
                                            setTimeout(function (){ 
        
                                                    $("#safeboxdoor").addClass("unlocked"); 
                                                    
                                                    $("#safeboxinside").html("<img src='img/diamante.png' class='img-diamante'/>");
                                                    $("#safeboxinside").css("opacity", "1");
                                                    $(".box_key").attr("disabled", "disabled");
        
                                            }, 1500);
                                            
                                            setTimeout(function (){ 
                                                   window.location.href = data.redirigir;
                                            }, 4500);

                                        
                                      }else{
                                              $("#numscreen").removeClass('claveok').addClass("claveerror");
                                      }
                                    },
                                    error: function(xhr, ajaxOptions, thrownError) {
                                          console.log(thrownError);
                                          $("#numscreen").removeClass('claveok').addClass("claveerror");
                                    
                                    }
                            });
                            
                            num_teclas = 0; //resetear clave
                            
                    }
                }
               
               
               
               
               
               
               
       
       });
       
        function set_safebox_size(){
                
                
                
                
                if ($("#safeboxdoor").hasClass('unlocked')){
                        var insidetop = $("#safeboxdoor").offset().top+'px';
                       var insideleft = $("#safeboxdiv").offset().left+'px';
                       var insideheight = +$("#safeboxdoor").outerHeight()+'px';

                       
                       $("#safeboxinside").css({
                               'position': 'absolute',
                               'top': insidetop,
                               'left': ((full_w/2) - ($(this).outerWidth()/2)) +'px',
                               'height': insideheight,
                               'width': '68%'
                        });
                }else{
                       var insidetop = $("#safeboxdoor").offset().top+'px';
                       var insideleft = $("#safeboxdoor").offset().left+'px';
                       var insideheight = +$("#safeboxdoor").outerHeight()+'px';
                       var insidewidth = +$("#safeboxdoor").outerWidth()+'px';
                       
                       
                       $("#safeboxinside").css({
                               'position': 'absolute',
                               'top': insidetop,
                               'left': insideleft,
                               'height': insideheight,
                               'width': insidewidth
                        });
                }
                
                
                $(".escritorio").css({
                       'position':'absolute',
                       'top': $("#pared").outerHeight() + 'px',
                       'width': '100%',
                       'height': $("body").outerHeight() - $("#pared").outerHeight() + 'px',
               });
                

               /* var full_w = $("body.pared").outerWidth();
                var full_h = $("body.pared").outerHeight();
                var caja_w = $("#safeboxdiv").outerWidth();
                var box_left = (full_w/2) - (caja_w/2);
                
                $("body").css({
                        'height': $(window).height()+'px',
                })
                
                $("#main_cont").css({
                        'position': 'absolute',
                        'bottom': '0',
                        'left': box_left+'px',
                });
                
                
                
                $("#safeboxinside").css({
                       'left': ((full_w/2) - ($(this).outerWidth()/2)) +'px',
               });*/
               
                
        }

});

