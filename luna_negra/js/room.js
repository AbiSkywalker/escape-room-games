  

$(document).ready(function(){

       var btenv = findBootstrapEnvironment();//'xs', 'sm', 'md' -> movil y tablet
       
       
       var classmvl = '';
       
       if (btenv == 'xs' || btenv == 'sm' || btenv == 'md'){
               classmvl = 'mvl';
               
               //si estamos en movil, al abrir un modal, bajamos z-index a los papeles
               $("#libros").click(function(e){
                       $("#modalPistas").css({'z-index': '2050'});
                       $("#papeles").css({'z-index': '1'});
               });
       }
       
       $("body").addClass(classmvl);
       
       set_room_sizes();
       $(window).on('resize', function(){
              set_room_sizes();
        });

       
        function set_room_sizes(){
                
                
        
                var full_h = $("body.pared").outerHeight();
                var full_w = $("body.pared").outerWidth();
                var pantalla_movil = false;
                
                screen_w = $(window).width();
                screen_h = $(window).height();
                
                if (screen_w < 1000 && screen_h > screen_w){ //MOVILES VERTICAL
                        pantalla_movil = true;
                        
                       $("#modalSessionid").addClass(classmvl);
                       
                       //Escritorio: 45% del full_h, 90% del full_w
                        
                        var desk_h = full_h*40/100;
                        var desk_w = full_w;
                        
                        //Fijar tamaño escritorio:
                        
                        $("#escritorio").css({
                               'position': 'absolute',
                               'bottom': '0',
                               'left': '0',
                               'height': desk_h+'px',
                               'width': desk_w+'px',
                        });
                        
                        $("#escritorio_tapa").css({
                               'height': '40px',
                        });
                        
                       $(".cajones_1").css({
                                'width': '100%',
                                'left': '0',
                                'position': 'absolute',
                                'bottom': '0px',
                        });
                       
                       
                        $(".cajones_2").css({
                                'width': '100%',
                                'left': '50%',
                                'position': 'absolute',
                                'bottom':'0px',
                        });
                        
                       //calcular tamaño cajones
                        //altura: escritorio - tapa
                        var cajones_altura = desk_h - 40;
                        var cajones_anchura = cajones_altura * 768/1004
                        
                        
                         $(".cajones_1, .cajones_2").css({
                               'height': cajones_altura+'px',
                               'width': cajones_anchura+'px',
                        });
                        
                        
                       
                        $(".cajones_2").css({
                                'left': full_w-cajones_anchura+'px',
                        });
                        
                        
                        //Ocultamos la silla
                        var silla_h = 0;
                        var silla_w = 0;
                        $("#silla").css({
                                'width': silla_w+'px',
                                'height': silla_h+'px',
                        })
                        
                        
                        //CAJA FUERTE
                        
                        //3/4 ancho de los cajones
                        var caja_w = cajones_anchura*3/4;
                        var caja_h = caja_w*466/800;
                        var caja_bottom = $("#escritorio").height();
                        
                        $("#caja_fuerte").css({
                                'width': caja_w+'px',
                                'height': caja_h+'px',
                                'position': 'absolute',
                                'bottom': caja_bottom+'px',
                                'left': '0px'
                        })
                        
                        
                        
                        //Lámpara
                        
                        //alto = caja fuerte*1.5
                        var lampara_h = caja_h*1.8;
                        var lampara_w = lampara_h*130/101;
                        var lampara_bottom = $("#escritorio").height();
                        var lampara_left = full_w - (lampara_w);
                        
                        $("#lampara").css({
                                'width': lampara_w+'px',
                                'height': lampara_h+'px',
                                'position': 'absolute',
                                'bottom': lampara_bottom+'px',
                                'left': lampara_left+'px'
                        });
                        
                        
                         
                        //Papeles
                        
                        //ancho = caja fuerte
                        var papeles_w = caja_w;
                        var papeles_h = papeles_w*321/398;
                        var papeles_bottom = papeles_h/2;
                        var papeles_left = lampara_left;
                        
                        $("#papeles").css({
                                'width': papeles_w+'px',
                                'height': papeles_h+'px',
                                'position': 'absolute',
                                'bottom': -(papeles_w*1.2*321/398)/3.25+'px',
                                'z-index': '10'
                        }).addClass('mvl');
                        
                        
                        //Libros
                        
                        //ancho = papeles
                        var libros_w = papeles_w;
                        var libros_h = libros_w*300/392;
                        var libros_bottom = $("#escritorio").height()+caja_h;
                        var libros_left = 0;
                        
                        $("#libros").css({
                                'width': libros_w+'px',
                                'height': libros_h+'px',
                                'position': 'absolute',
                                'bottom': libros_bottom+'px',
                                'left': libros_left+'px',
                                'z-index': '100'
                        }).addClass('mvl');
                        
                         
                        //Corchito
                        
                        //alto = 25%
                        var corcho_h = full_h*25/100;
                        var corcho_w = corcho_h*936/720;
                        var corcho_top = corcho_h/4;
                        var corcho_left = (full_w/2) - (corcho_w/2);
                        
                        $("#corcho").css({
                                'width': corcho_w+'px',
                                'height': corcho_h+'px',
                                'position': 'absolute',
                                'top': corcho_top+'px',
                                'left': corcho_left+'px',
                                'z-index': '100'
                        });
                        
                        
                        
                } else if(screen_w < 1000){ //tablets o moviles horizontal
                
                
                        //Escritorio: 45% del full_h, 90% del full_w
                        
                        var desk_h = full_h*45/100;
                        var desk_w = full_w*90/100;
                        
                        //Fijar tamaño escritorio:
                        
                        $("#escritorio").css({
                               'position': 'absolute',
                               'bottom': '0',
                               'left': '5%',
                               'height': desk_h+'px',
                               'width': desk_w+'px',
                        }).addClass(classmvl);
                        
                        $("#escritorio_tapa").css({
                               'height': '20px',
                        });
                        
                        //calcular tamaño cajones
                        //altura: escritorio - tapa
                        var cajones_altura = desk_h - 20;
                        var cajones_anchura = cajones_altura * 768/1004
                        
                        
                         $(".cajones_1, .cajones_2").css({
                               'height': cajones_altura+'px',
                               'width': cajones_anchura+'px',
                        });
                        
                        
                        //calcular posicion cajones 2: escitorio - cajones
                        var pos_cajones_2 = desk_w - cajones_anchura;
                        
                        
                        $(".cajones_2").css({
                                'left': desk_w-(cajones_anchura*2)+'px',
                        })
                        
                        
                        //silla. Altura 50%
                        var silla_h = full_h*65/100;
                        var silla_w = silla_h*748/1280;
                        var silla_left = (full_w/2) - (silla_w/2);
                        
                        $("#silla").css({
                                'width': silla_w+'px',
                                'height': silla_h+'px',
                                'position': 'absolute',
                                'bottom': '0px',
                                'left': silla_left+'px',
                                'z-index': '999',
                        })
                        
                        
                        
                        //CAJA FUERTE
                        
                        //mismo ancho que los cajones
                        var caja_w = cajones_anchura;
                        var caja_h = caja_w*466/800;
                        var caja_bottom = $("#escritorio").height();
                        var caja_left = cajones_anchura/2;
                        
                        $("#caja_fuerte").css({
                                'width': caja_w+'px',
                                'height': caja_h+'px',
                                'position': 'absolute',
                                'bottom': caja_bottom+'px',
                                'left': caja_left+'px'
                        })
                        
                        
                        //Lámpara
                        
                        //alto = caja fuerte*1.5
                        var lampara_h = caja_h*1.8;
                        var lampara_w = lampara_h*130/101;
                        var lampara_bottom = $("#escritorio").height();
                        var lampara_left = pos_cajones_2 - (lampara_w/2);
                        
                        $("#lampara").css({
                                'width': lampara_w+'px',
                                'height': lampara_h+'px',
                                'position': 'absolute',
                                'bottom': lampara_bottom+'px',
                                'left': lampara_left+'px'
                        });
                        
                         
                        //Papeles
                        
                        //ancho = caja fuerte/1.5
                        var papeles_w = caja_w/1.5;
                        var papeles_h = papeles_w*321/398;
                        var papeles_bottom = papeles_h/3.25;
                        var papeles_left = lampara_left;
                        
                        $("#papeles").css({
                                'width': papeles_w+'px',
                                'height': papeles_h+'px',
                                'position': 'absolute',
                                'bottom': -papeles_bottom+'px',
                                'z-index': '1'
                        }).addClass(classmvl);
                        
                        
                        
                        //Libros
                        
                        //ancho = papeles
                        var libros_w = papeles_w;
                        var libros_h = libros_w*300/392;
                        var libros_bottom = $("#escritorio").height();
                        var libros_left = caja_w+libros_w;
                        
                        $("#libros").css({
                                'width': libros_w+'px',
                                'height': libros_h+'px',
                                'position': 'absolute',
                                'bottom': libros_bottom+'px',
                                'left': libros_left+'px',
                                'z-index': '100'
                        }).addClass(classmvl);;
                        
                                                
                         
                        //Corchito
                        
                        //alto = 25%
                        var corcho_h = full_h*30/100;
                        var corcho_w = corcho_h*936/720;
                        var corcho_top = corcho_h/4;
                        var corcho_left = (full_w/2) - (corcho_w/2);
                        
                        $("#corcho").css({
                                'width': corcho_w+'px',
                                'height': corcho_h+'px',
                                'position': 'absolute',
                                'top': corcho_top+'px',
                                'left': corcho_left+'px',
                                'z-index': '100'
                        });
                        
                
                        
                
                }else {
                
                        //Escritorio: 45% del full_h, 90% del full_w
                        
                        var desk_h = full_h*45/100;
                        var desk_w = full_w*90/100;
                        
                        //Fijar tamaño escritorio:
                        
                        $("#escritorio").css({
                               'position': 'absolute',
                               'bottom': '0',
                               'left': '5%',
                               'height': desk_h+'px',
                               'width': desk_w+'px',
                        });
                        
                        //calcular tamaño cajones
                        //altura: escritorio - tapa
                        var cajones_altura = desk_h - 20;
                        var cajones_anchura = cajones_altura * 768/1004
                        
                        
                         $(".cajones_1, .cajones_2").css({
                               'height': cajones_altura+'px',
                               'width': cajones_anchura+'px',
                        });
                        
                        
                        //calcular posicion cajones 2: escitorio - cajones
                        var pos_cajones_2 = desk_w - cajones_anchura;
                        
                        
                        $(".cajones_2").css({
                                'left': pos_cajones_2+'px',
                                'position': 'absolute',
                        })
                        
                        
                        //silla. Altura 50%
                        var silla_h = full_h*65/100;
                        var silla_w = silla_h*748/1280;
                        var silla_left = (full_w/2) - (silla_w/2);
                        
                        $("#silla").css({
                                'width': silla_w+'px',
                                'height': silla_h+'px',
                                'position': 'absolute',
                                'bottom': '0px',
                                'left': silla_left+'px',
                                'z-index': '999',
                        })
                        
                        
                        
                        //CAJA FUERTE
                        
                        //mismo ancho que los cajones
                        var caja_w = cajones_anchura;
                        var caja_h = caja_w*466/800;
                        var caja_bottom = $("#escritorio").height();
                        var caja_left = cajones_anchura/2;
                        
                        $("#caja_fuerte").css({
                                'width': caja_w+'px',
                                'height': caja_h+'px',
                                'position': 'absolute',
                                'bottom': caja_bottom+'px',
                                'left': caja_left+'px'
                        })
                        
                        
                        //Lámpara
                        
                        //alto = caja fuerte*1.5
                        var lampara_h = caja_h*1.8;
                        var lampara_w = lampara_h*130/101;
                        var lampara_bottom = $("#escritorio").height();
                        var lampara_left = pos_cajones_2 - (lampara_w/2);
                        
                        $("#lampara").css({
                                'width': lampara_w+'px',
                                'height': lampara_h+'px',
                                'position': 'absolute',
                                'bottom': lampara_bottom+'px',
                                'left': lampara_left+'px'
                        });
                        
                         
                        //Papeles
                        
                        //ancho = caja fuerte/1.5
                        var papeles_w = caja_w/1.5;
                        var papeles_h = papeles_w*128/317;
                        var papeles_bottom = papeles_h/3.25;
                        var papeles_left = lampara_left;
                        
                        $("#papeles").css({
                                'width': papeles_w+'px',
                                'height': papeles_h+'px',
                                'position': 'absolute',
                                'bottom': -papeles_bottom+'px',
                                'z-index': '1'
                        });
                        
                        //cambiar tamaño en hover
                        
                        $( "#papeles" ).hover(
                          function() {
                            $( this ).css({
                                        'width': papeles_w*1.2+'px',
                                        'height': papeles_w*1.2*321/398+'px',
                                        'bottom': -(papeles_w*1.2*321/398)/3.25+'px',
                                        
                                });
                          }, function() {
                                $("#papeles").css({
                                        'width': papeles_w+'px',
                                        'height': papeles_h+'px',
                                        'bottom': -papeles_bottom+'px',
                                });
                          }
                        );
                        
                        
                        
                        //Libros
                        
                        //ancho = papeles
                        var libros_w = papeles_w;
                        var libros_h = libros_w*192/392;
                        var libros_bottom = $("#escritorio").height();
                        var libros_left = caja_w+libros_w;
                        
                        $("#libros").css({
                                'width': libros_w+'px',
                                'height': libros_h+'px',
                                'position': 'absolute',
                                'bottom': libros_bottom+'px',
                                'left': libros_left+'px',
                                'z-index': '100'
                        });
                        
                        //cambiar tamaño en hover
                        
                       $( "#libros" ).hover(
                          function() {
                            $( this ).css({
                                        'height': libros_w*300/392+'px',
                                        
                                });
                                
                          }, function() {
                                $(this).css({
                                        'height': libros_h+'px',
                                });
                          }
                        );
                        
                        
                        
                        
                         
                        //Corchito
                        
                        //alto = 25%
                        var corcho_h = full_h*30/100;
                        var corcho_w = corcho_h*936/720;
                        var corcho_top = corcho_h/2;
                        var corcho_left = (full_w/2) - (corcho_w/2);
                        
                        $("#corcho").css({
                                'width': corcho_w+'px',
                                'height': corcho_h+'px',
                                'position': 'absolute',
                                'top': corcho_top+'px',
                                'left': corcho_left+'px',
                                'z-index': '100'
                        });
                        
                        
                        
                        
                        
                }
                
                
                
                
                
                
                
                
         }

});


function findBootstrapEnvironment() {
    let envs = ['xs', 'sm', 'md', 'lg', 'xl'];

    let el = document.createElement('div');
    document.body.appendChild(el);

    let curEnv = envs.shift();

    for (let env of envs.reverse()) {
        el.classList.add(`d-${env}-none`);

        if (window.getComputedStyle(el).display === 'none') {
            curEnv = env;
            break;
        }
    }

    document.body.removeChild(el);
    return curEnv;
}
