$(document).ready(function(){ 
        
        
        //constantes
        
        var piezaSeleccionada = false;
	var piezzaSeleccionada1; 
	var piezzaSeleccionada2; 
	var srcPiezzaSeleccionada1; 
	var srcPiezzaSeleccionada2; 
	var backSrcPiezzaSeleccionada1; 
	var backSrcPiezzaSeleccionada2; 
        var classPiezaSeleccionada1; 
        var classPiezaSeleccionada2;
        
        if (puzzle_completado == 0){ 
                window.setInterval(actualizar_puzzle, 5000);
        } else {
                
               if($(".puzzle_completo.visible")){
                       piezaSeleccionada = true;
                       piezzaSeleccionada1 = $(".puzzle_completo.visible").attr('id');
               }
        }
        
	var imgs_piezas = ['1.png', '2.png', '3.png', '4.png', '5.png', '6.png', '7.png', '8.png']
        var imgs_piezas_back = ['1b.png', '2b.png', '3b.png', '4b.png', '5b.png', '6b.png', '7b.png', '8b.png'];
        

        var piezas_desordenadas = shuffle([0,1,2,3,4,5,6,7]);
        
        
        var cont = 0;
        
        for (p = 0; p <= 8; p++){
                cont++;
                
                var sourceimg = '';
                var backsource = '';
                
                if (Math.random() <= 0.5){
                        sourceimg = 'img/'+imgs_piezas[piezas_desordenadas[p]]
                        backsource = 'img/'+imgs_piezas_back[piezas_desordenadas[p]]
                }else{
                        sourceimg = 'img/'+imgs_piezas_back[piezas_desordenadas[p]]
                        backsource = 'img/'+imgs_piezas[piezas_desordenadas[p]]
                }
                
                $("#piece-"+cont+" img").attr('src', sourceimg).attr('backsrc',backsource);
                
                if (Math.random() <= 0.5){
                        $("#piece-"+cont+" img").addClass('inverted');
                }
        }
        
        
        
        
        //controles
        
       $('#btRotar').click(function(){
       
               if(piezaSeleccionada == false){
                       return false;
               }
               else if (piezzaSeleccionada1 == 'puzzle-1' || piezzaSeleccionada2 == 'puzzle-2'){
               
               }else{
               
                       //rotar 180º
                        
                        
                        if($("#"+piezzaSeleccionada1+" img").hasClass('inverted')){
                                
                                $("#"+piezzaSeleccionada1+" img").animate({  transform: 360 }, {
                                    step: function(now,fx) {
                                        $(this).css({
                                            '-webkit-transform':'rotate('+now+'deg)', 
                                            '-moz-transform':'rotate('+now+'deg)',
                                            'transform':'rotate('+now+'deg)'
                                        });
                                    }
                                });
                                $("#"+piezzaSeleccionada1+" img").removeClass('inverted');
                        }else{
                                
                                $("#"+piezzaSeleccionada1+" img").animate({  transform: 180 }, {
                                    step: function(now,fx) {
                                        $(this).css({
                                            '-webkit-transform':'rotate('+now+'deg)', 
                                            '-moz-transform':'rotate('+now+'deg)',
                                            'transform':'rotate('+now+'deg)'
                                        });
                                    }
                                });
                                $("#"+piezzaSeleccionada1+" img").addClass('inverted');
                        }
                       
               }
               check_completo();
       
       });
        
       $('#btGirar').click(function(){
       
               if(piezaSeleccionada == false){
                       return false;
               }
               else if (piezzaSeleccionada1 == 'puzzle-1' || piezzaSeleccionada1 == 'puzzle-2'){
                       girarPuzzle();
               }else{
               
                       //girar al reverso
                       girarImagen("#"+piezzaSeleccionada1+" img");
                       check_completo();
               }
       
       });
        
        //seleccionar piezas
        

        $('.pieza').click(function(){
                console.log("CLIC EN PIEZA "+$(this).attr('id'));
                
                if(piezzaSeleccionada1 === $(this).attr('id')){//si es la misma
                
                        //  remove the glow and reset the first tile
			$('.pieza').removeClass('glow');
			piezaSeleccionada = false;
                        piezzaSeleccionada1 = false;
                
                } else {  // seleccionar otra pieza
        
		   $('.pieza').removeClass('glow');

                    piezzaSeleccionada1 = $(this).attr('id');
                   

                    // highlight tile
                    $(this).addClass('glow');
                    piezaSeleccionada = true;
                    
                    
                }
        
            });  // fin click function
            
            $(".puzzle_completo").click(function(){
                    piezzaSeleccionada1 = $(this).attr('id');
                    piezaSeleccionada = true;
            
            });
        
            //intercambiar piezas
            
            
            $( ".pieza img" ).draggable({ 
                  snap: true,
                  start: function( event, ui ) {
                          console.log("iniciar");
                          //Cojo los datos iniciales
                          
                          $('.pieza').removeClass('glow');

                          piezzaSeleccionada1 = $(this).parent().attr('id');;
                           
                          srcPiezzaSeleccionada1 = $(this).attr('src');
                          backSrcPiezzaSeleccionada1 = $(this).attr('backsrc');
                          classPiezaSeleccionada1 = $(this).attr('class');
        
                          // highlight
                          $('#'+piezzaSeleccionada1).addClass('glow');
                          piezaSeleccionada = true;
                          
                          
                  }
            });

            $(".pieza").droppable({
                    drop: function(event, ui) {

                       //coger pieza 2
                       piezzaSeleccionada2 = $(this).attr('id');
		       srcPiezzaSeleccionada2 =  $("#"+piezzaSeleccionada2+" img").attr('src');
                       backSrcPiezzaSeleccionada2 = $("#"+piezzaSeleccionada2+" img").attr('backsrc');
                       classPiezaSeleccionada2 =$("#"+piezzaSeleccionada2+" img").attr('class');

			//  intercambiar
			$("#"+piezzaSeleccionada1+" img").attr('src', srcPiezzaSeleccionada2);
			$("#"+piezzaSeleccionada1+" img").attr('backsrc', backSrcPiezzaSeleccionada2);
			$("#"+piezzaSeleccionada1+" img").attr('class', '');
			$("#"+piezzaSeleccionada1+" img").attr('class', classPiezaSeleccionada2);
			$("#"+piezzaSeleccionada1+" img").attr('style', 'position: relative;');
                        
			$("#"+piezzaSeleccionada2+" img").attr('src', srcPiezzaSeleccionada1);
			$("#"+piezzaSeleccionada2+" img").attr('backsrc', backSrcPiezzaSeleccionada1);
			$("#"+piezzaSeleccionada2+" img").attr('class', '');
			$("#"+piezzaSeleccionada2+" img").attr('class', classPiezaSeleccionada1);
			$("#"+piezzaSeleccionada2+" img").attr('style', 'position: relative;');
                        

			//  remove the glow and reset the first tile
			$('.pieza').removeClass('glow');
			piezaSeleccionada = false;
                        
                        check_completo();
                       
                    },
                    over: function(event, ui) {
                    },
                    out: function(event, ui) {
                    }
                });
            
            
        
        
});




function girarImagen(imgid){
    
    var newsrc = $(imgid).attr('backsrc');
    var newbacksrc = $(imgid).attr('src');
    
    $(imgid).attr('src', newsrc).attr('backsrc', newbacksrc);

}



function girarPuzzle(){

    $(".puzzle_completo").toggleClass('hidden').toggleClass('visible');
    piezaSeleccionada = true;
    piezzaSeleccionada1 = $(".puzzle_completo.visible").attr('id');
}
        

function shuffle(a) {

    var j, x, i;
    
    for (i = a.length - 1; i > 0; i--) {
    
        j = Math.floor(Math.random() * (i + 1)); 
        
        x = a[i];
        a[i] = a[j];
        a[j] = x;
    }
    
    return a;
}

function check_completo(){

    console.log("COMPROBANDO "+puzzle_completado);
    if(puzzle_completado != 0)
            return false;
        
    var cont_invertidas = $("#divpuzzle .pieza img.inverted").length;

    if(cont_invertidas > 0){
            puzzle_completado = 0;
            return false;
    }
        
    var piezas_puzzle_1 = [{'id': 'piece-1', 'img': 'img/1.png'}, {'id': 'piece-2', 'img': 'img/2.png'}, 
            {'id': 'piece-3', 'img': 'img/3.png'}, {'id': 'piece-4', 'img': 'img/4.png'},
            {'id': 'piece-5', 'img': 'img/5.png'}, {'id': 'piece-6', 'img': 'img/6.png'},
            {'id': 'piece-7', 'img': 'img/7.png'}, {'id': 'piece-8', 'img': 'img/8.png'}];
            
    var completado_1 = true;
    
    for (i=0; i <= piezas_puzzle_1.length-1; i++){
        var img_pieza_ok = piezas_puzzle_1[i];
        
        if ($("#"+piezas_puzzle_1[i].id+" img").attr("src") != piezas_puzzle_1[i].img){
                completado_1 = false;
                break;
        }
    }
    
    if (completado_1 == true){
            puzzle_completado = 1;
    }
    
    var piezas_puzzle_2 = [{'id': 'piece-1', 'img': 'img/4b.png'}, {'id': 'piece-2', 'img': 'img/3b.png'}, 
            {'id': 'piece-3', 'img': 'img/2b.png'}, {'id': 'piece-4', 'img': 'img/1b.png'},
            {'id': 'piece-5', 'img': 'img/8b.png'}, {'id': 'piece-6', 'img': 'img/7b.png'},
            {'id': 'piece-7', 'img': 'img/6b.png'}, {'id': 'piece-8', 'img': 'img/5b.png'}];
    
    var completado_2 = true;
    
    for (i=0; i <= piezas_puzzle_2.length-1; i++){
        var img_pieza_ok = piezas_puzzle_2[i];
        
        if ($("#"+piezas_puzzle_2[i].id+" img").attr("src") != piezas_puzzle_2[i].img){
                completado_2 = false;
                break;
        }
    }
    
    if (completado_2 == true){
            puzzle_completado =  2;
    }
    
    if (!completado_1 && !completado_2){
            puzzle_completado = 0;
    }
}

function actualizar_puzzle(){
        var ajaxData = {"puzzle_completado" : "0"};
        
        if (puzzle_completado != 0){
             ajaxData = {"puzzle_completado" : puzzle_completado};
        }
        
        console.log(ajaxData);
        
        $.ajax({
            type: 'POST',
            data: ajaxData,
            dataType: 'json',
            url: 'actualizar_puzzle.php',
            success: function(data) {
                   if(data.redirigir){
                           window.location.href = data.redirigir;
                   }
            },
            error: function(xhr, ajaxOptions, thrownError) {
              
            }
         });
         
}
