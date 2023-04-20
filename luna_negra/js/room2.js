  

$(document).ready(function(){

       var btenv = findBootstrapEnvironment();//'xs', 'sm', 'md' -> movil y tablet
       
       var classmvl = '';
       
       if (btenv == 'xs' || btenv == 'sm' || btenv == 'md'){
               classmvl = 'mvl';
               
       }
       
       $("body").addClass(classmvl);
       
       set_room_sizes();
       $(window).on('resize', function(){
              set_room_sizes();
        });

       
        function set_room_sizes(){
                
                
        
                var full_h = $("body").outerHeight();
                var full_w = $("body").outerWidth();
                var pantalla_movil = false;
                
                screen_w = $(window).width();
                screen_h = $(window).height();
                
                if (screen_w < 1000 && screen_h > screen_w){ //MOVILES VERTICAL
                       
                       //Escritorio: 90% del full_w
                        
                        var desk_w = full_w*90/100;
                        var desk_h = desk_w*557/1010;
                        
                        
                        var left_desk = (full_w/2) - (desk_w/2);
                        //Fijar tamaño escritorio:
                        
                        $("#escritorio").css({
                               'position': 'absolute',
                               'bottom': '0',
                               'left': left_desk+'px',
                               'height': desk_h+'px',
                               'width': desk_w+'px',
                        });
                        
                        
                        //pared
                        
                        var suelo_h = desk_h*23/100;
                         $("#pared").css({
                               'position': 'absolute',
                               'top': '0',
                               'left': '0',
                               'height': full_h - suelo_h+'px',
                               'width': '100%'
                        });
                        
                        
                        //Lampara
                        
                        var lamp_w = desk_w*20/100;
                        var lamp_h = lamp_w*184/156;
                        
                        
                        var left_lamp = (full_w/2) - (lamp_w/2);
                        //Fijar tamaño:
                        
                        $("#lampara").css({
                               'position': 'absolute',
                               'top': '0',
                               'left': left_lamp+'px',
                               'height': lamp_h+'px',
                               'width': lamp_w+'px',
                        });
                        
                        
                        //Estanteria
                        
                        var estanteria_w = desk_w*40/100;
                        var estanteria_h = estanteria_w*252/451;
                        
                        
                        var left_estanteria = (full_w*90/100) - (estanteria_w);
                        var top_estanteria = (full_h*20/100);
                        //Fijar tamaño:
                        
                        $("#estanteria").css({
                               'position': 'absolute',
                               'top': top_estanteria+'px',
                               'left': left_estanteria+'px',
                               'height': estanteria_h+'px',
                               'width': estanteria_w+'px',
                        });
                        
                        
                        
                        //Caja fuerte
                        
                        var caja_w = desk_w*32/100;
                        var caja_h = caja_w*524/1000;
                        
                        
                        var left_caja = (caja_w/3);
                        var top_caja = desk_h - (caja_h/5);
                        //Fijar tamaño:
                        
                        $("#caja_fuerte").css({
                               'position': 'absolute',
                               'bottom': top_caja+'px',
                               'left': left_caja+'px',
                               'height': caja_h+'px',
                               'width': caja_w+'px',
                        });
                        
                        
                        
                        
                        //Papeles
                        
                        var papeles_w = caja_w*80/100;
                        var papeles_h = papeles_w*128/317;
                        
                        
                        var left_papeles = desk_w - (papeles_w*2);
                        var top_papeles = top_caja - (papeles_h/4);
                        //Fijar tamaño:
                        
                        $("#papeles").css({
                               'position': 'absolute',
                               'bottom': top_papeles+'px',
                               'left': left_papeles+'px',
                               'height': papeles_h+'px',
                               'width': papeles_w+'px',
                        });
                        
                        
                        //Carta
                        
                        var carta_w = papeles_w/2;
                        var carta_h = carta_w*78/218;
                        
                        
                        var left_carta = desk_w - (papeles_w);
                        var top_carta = top_caja - (carta_h/4);
                        //Fijar tamaño:
                        
                        $("#carta").css({
                               'position': 'absolute',
                               'bottom': top_carta+'px',
                               'left': left_carta+'px',
                               'height': carta_h+'px',
                               'width': carta_w+'px',
                        });
                        
                        
                        //postit
                        
                        var postit_w = papeles_w/4;
                        var postit_h = postit_w*365/394;
                        
                        
                        var left_postit = left_papeles + (papeles_w/2);
                        var top_postit = top_papeles + (papeles_h*2);
                        //Fijar tamaño:
                        
                        $("#id_postit").css({
                               'position': 'absolute',
                               'bottom': top_postit+'px',
                               'left': left_postit+'px',
                               'height': postit_h+'px',
                               'width': postit_w+'px',
                        });
                        
                              
                              
                       $("#modalSessionid").css({
                               'height': full_h+'px',
                               'padding-top': full_h/3+'px',
                               'font-size': '2.5em',
                       });
                        
                } else {
                
                        //Escritorio: 50% del full_w
                        
                        var desk_w = full_w*45/100;
                        var desk_h = desk_w*557/1010;
                        
                        
                        var left_desk = (full_w/2) - (desk_w/2);
                        //Fijar tamaño escritorio:
                        
                        $("#escritorio").css({
                               'position': 'absolute',
                               'bottom': '0',
                               'left': left_desk+'px',
                               'height': desk_h+'px',
                               'width': desk_w+'px',
                        });
                        
                        
                        //pared
                        
                        var suelo_h = desk_h*23/100;
                         $("#pared").css({
                               'position': 'absolute',
                               'top': '0',
                               'left': '0',
                               'height': full_h - suelo_h+'px',
                               'width': '100%'
                        });
                        
                        
                        //Lampara
                        
                        
                        var lamp_w = desk_w*20/100;
                        var lamp_h = lamp_w*184/156;
                        
                        
                        var left_lamp = (full_w/2) - (lamp_w/2);
                        //Fijar tamaño:
                        
                        $("#lampara").css({
                               'position': 'absolute',
                               'top': '0',
                               'left': left_lamp+'px',
                               'height': lamp_h+'px',
                               'width': lamp_w+'px',
                        });
                        
                        
                        //Estanteria
                        
                        var estanteria_w = desk_w*40/100;
                        var estanteria_h = estanteria_w*252/451;
                        
                        
                        var left_estanteria = (full_w*90/100) - (estanteria_w);
                        var top_estanteria = (full_h*15/100);
                        //Fijar tamaño:
                        
                        $("#estanteria").css({
                               'position': 'absolute',
                               'top': top_estanteria+'px',
                               'left': left_estanteria+'px',
                               'height': estanteria_h+'px',
                               'width': estanteria_w+'px',
                        });
                        
                        
                        
                        //Caja fuerte
                        
                        var caja_w = desk_w*32/100;
                        var caja_h = caja_w*524/1000;
                        
                        
                        var left_caja = (caja_w/3);
                        var top_caja = desk_h - (caja_h/5);
                        //Fijar tamaño:
                        
                        $("#caja_fuerte").css({
                               'position': 'absolute',
                               'bottom': top_caja+'px',
                               'left': left_caja+'px',
                               'height': caja_h+'px',
                               'width': caja_w+'px',
                        });
                        
                        
                        
                        
                        //Papeles
                        
                        var papeles_w = caja_w*80/100;
                        var papeles_h = papeles_w*128/317;
                        
                        
                        var left_papeles = desk_w - (papeles_w*2);
                        var top_papeles = top_caja - (papeles_h/4);
                        //Fijar tamaño:
                        
                        $("#papeles").css({
                               'position': 'absolute',
                               'bottom': top_papeles+'px',
                               'left': left_papeles+'px',
                               'height': papeles_h+'px',
                               'width': papeles_w+'px',
                        });
                        
                        //Carta
                        
                        var carta_w = papeles_w/2;
                        var carta_h = carta_w*78/218;
                        
                        
                        var left_carta = desk_w - (papeles_w);
                        var top_carta = top_caja - (carta_h/4);
                        //Fijar tamaño:
                        
                        $("#carta").css({
                               'position': 'absolute',
                               'bottom': top_carta+'px',
                               'left': left_carta+'px',
                               'height': carta_h+'px',
                               'width': carta_w+'px',
                        });
                        
                        
                        //postit
                        
                        var postit_w = papeles_w/4;
                        var postit_h = postit_w*365/394;
                        
                        
                        var left_postit = left_papeles + (papeles_w/2);
                        var top_postit = top_papeles + (papeles_h*2);
                        //Fijar tamaño:
                        
                        $("#id_postit").css({
                               'position': 'absolute',
                               'bottom': top_postit+'px',
                               'left': left_postit+'px',
                               'height': postit_h+'px',
                               'width': postit_w+'px',
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
