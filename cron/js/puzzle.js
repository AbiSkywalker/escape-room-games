

$(document).ready(function(){

        var w_adapt=$("#mazecanvas").width();
        var c_graph = $("#mazecanvas")[0].getContext("2d"); // Llamada al método de dibujo
        var w_graph = $("#mazecanvas").width(); // Ancho del canvas
        var h_graph = $("#mazecanvas").height(); // Alto del canvas 
        var tam_w=w_graph/10; //Medida de separación de meses
        var tam_h=h_graph/10; // Medida de separación de cantidades
        var amounts_max_value=10000;
        var amounts=10;
        var valores=10;
        
        var currRectX = 0;
        var currRectY = 0;
                
        var instrucciones_recibidas = [];
        console.log(tam_h);
        console.log(tam_w);
        var maze_map = {
            'correctcells_test': [{x: 80, y:0, done: false, final:true}],
            'correctcells': [{x: tam_w, y:0, done:false}, {x: tam_w*2, y:0, done:false}, {x: tam_w*2, y:tam_h, done:false}, {x: tam_w*2, y: tam_h*2, done:false}, {x: tam_w*3, y:tam_h*2, done:false}, 
                {x: tam_w*4, y:tam_h*2, done:false}, {x: tam_w*4, y: tam_h, done:false}, {x: tam_w*5, y: tam_h, done:false}, {x: tam_w*6, y: tam_h, done:false},
                {x: tam_w*6, y:tam_h*2, done:false}, {x: tam_w*6, y:tam_h*3, done:false}, {x: tam_w*6, y: tam_h*4, done:false}, {x: tam_w*5, y: tam_h*4, done:false}, {x: tam_w*4, y: tam_h*4, done:false},
                {x: tam_w*3, y:tam_h*4, done:false}, {x: tam_w*3, y:tam_h*5, done:false}, {x: tam_w*3, y: tam_h*6, done:false}, {x: tam_w*3, y: tam_h*7, done:false}, {x: tam_w*4, y: tam_h*7, done:false},
                {x: tam_w*4, y:tam_h*8, done:false}, {x: tam_w*5, y:tam_h*8, done:false}, {x: tam_w*5, y: tam_h*9, done:false}, {x: tam_w*6, y: tam_h*9, done:false}, {x: tam_w*7, y: tam_h*9, done:false},
                {x: tam_w*7, y:tam_h*8, done:false}, {x: tam_w*7, y:tam_h*7, done:false}, {x: tam_w*7, y: tam_h*6, done:false}, {x: tam_w*8, y: tam_h*6, done:false}, {x: tam_w*9, y: tam_h*6, done:false},
                {x: tam_w*9, y:tam_h*7, done:false}, {x: tam_w*9, y:tam_h*8, done:false}, {x: tam_w*9, y: tam_h*9, done:false, final: true}
                ],
             
            'deathcells': [{x:tam_w, y: tam_h}, {x: tam_w*5, y: tam_h*2}, {x:tam_w*4, y:tam_h*9}, {x:tam_w*7, y:tam_h*5}, {x:tam_w*8, y:tam_h*7}]

        }
        console.log(maze_map.correctcells);
        var resultado_codigo = 2; //2: inicial; 1: correcto finalizado; 0: correcto sin completar; -1: muerte; 

        draw_graph();
        
        $(window).resize(function() {
            if(w_adapt!=$("#mazecanvas").width()){
                w_adapt=$("#mazecanvas").width();
                draw_graph();
            }
        });
        
        
        $( "#move_right_button" ).click(function() {
                add_instruction('moveRight');
        });
        
        $( "#move_left_button" ).click(function() {
                add_instruction('moveLeft');
        });
        
        $( "#move_up_button" ).click(function() {
                add_instruction('moveUp');
        });
        
        
        $( "#move_down_button" ).click(function() {
                add_instruction('moveDown');
        });
        
        $( "#enter_steps_button" ).click(function(){
        
             var steps_number = 0; 
             
             steps_number = $("#steps_number").val();
             
             if(steps_number > 0 && steps_number <=9){
                 $("#lista_instrucciones li[selected] span.var_steps").html("$steps="+steps_number);
                 $("#lista_instrucciones li[selected]").attr('steps', steps_number);
             }
        });

        $("#delete_button").click(function(){
        	 $("#lista_instrucciones li[selected]").remove();
        });
        
        
        $('#lista_instrucciones').on('click', 'li.ui-state-default', function() {
              var new_state =  !$(this).attr('selected'); //estado que voy a poner
              $('#lista_instrucciones li').each(function( index ) {
              
                      $(this).attr('selected', false).attr('style','');      //si tuviera estilo tambien lo borro
              
              });
              $(this).attr('selected', new_state);
              
              //si se ha activado, activo boton steps
              $('#steps_number').attr('disabled', !new_state);
              $('#enter_steps_button').attr('disabled', !new_state);
              $('#delete_button').attr('disabled', !new_state); //cambio tambien el estado de delete_instruction
        });
        
    
        
       
        $( "#clear" ).click(function() {
        
                clear_console();
        });
        
        $("#run").click( function() {
        	resultado_codigo = 2;
            run_pseudo_code();
        });
        
        function clear_console(){
        	$("#lista_instrucciones li" ).each(function( index ) {
                    if ($(this).attr('id') != 'cursor'){
                            $(this).remove();
                    }
            });
        }
        
        function add_instruction(instruc){
                 console.log("mover "+instruc);
                 
                 var oden_instruccion = 0;
                 //añadir un id
                 var new_inst = "<li class='ui-state-default' direccion='"+instruc+"' steps=1>pointer.<span class='funcion'>"+instruc+"(<span class='var_steps'></span>);</span></li>";
                 $("#cursor").before(new_inst);
        }
        

        function draw_graph(){
            if ($("#mazecanvas")[0].getContext) { // Si el navegador lo soporta
                
                $("#mazecanvas").attr("width",$("#mazecanvas").width()); // Aplico la anchura del canvas a su atributo width
                $("#mazecanvas").attr("height",$("#mazecanvas").height()); // Aplico la altura del canvas a su atributo width
               
                c_graph.lineWidth = 1;
                c_graph.strokeStyle = "#00FF00";
                c_graph.textAlign="left";
                draw_horizontal_lines();
                draw_vertical_lines();
                draw_pointer(0, 0);
                var final_cell = maze_map.correctcells[maze_map.correctcells.length-1];
                draw_lock(final_cell.x, final_cell.y);
                
            }
        }
        
        function draw_horizontal_lines(){
            for (i=0; i<10; i++){
                        c_graph.beginPath();
                        c_graph.moveTo(0, h_graph-(tam_h*i));
                        c_graph.lineTo(w_graph, h_graph-(tam_h*i));
                        c_graph.stroke();
                        c_graph.textAlign="left";
                       /* if (i!=amounts){
                            c_graph.fillText(valores[i], 0, h_graph-(tam_h*i)-4);
                        }*/
            }
        }

       function draw_vertical_lines(){
            for (i=0; i<10; i++){
                        c_graph.beginPath();
                        c_graph.moveTo(w_graph-(tam_w*i), 0);
                        c_graph.lineTo(w_graph-(tam_w*i), h_graph);
                        c_graph.stroke();
                        c_graph.textAlign="left";
                       /* if (i!=amounts){
                            c_graph.fillText(valores[i], 0, h_graph-(tam_h*i)-4);
                        }*/
            }
        }
        
        function draw_lock(x, y){
                var img = new Image;
                img.src = "img/lock.png";
                img.onload = function(){
                          
                        c_graph.drawImage(img,x+(tam_h/2),y, tam_w/2, tam_h);
                }
                

        }
        
        function draw_pointer(x, y){
            c_graph.fillStyle = '#b5f100';
            c_graph.fillRect(x, y, tam_w, tam_h);

        }

        function draw_orange_pointer(x, y){
            c_graph.fillStyle = '#ff8d00';
            c_graph.fillRect(x, y, tam_w, tam_h);

        }
        
        function draw_red_pointer(x, y){
            c_graph.fillStyle = '#ff0000';
            c_graph.fillRect(x, y, tam_w, tam_h);
        }
        
        function erase(x, y, sizew, sizeh){
             c_graph.fillStyle = '#000000';
             c_graph.fillRect(x, y, sizew, sizeh);
        }
        
        
        function check_death_cell(x, y){ //devuelve true si es una celda de muerte, false si no
                for (i=0; i<= maze_map.deathcells.length -1; i++){
                        death_cell = maze_map.deathcells[i];
                        if (death_cell.x == x && death_cell.y == y){
                                return true;
                        }
                } 
                
                return false;
        }
        
        function check_correct_cell(x, y){ //devuelve true si es celda correcta, false si no. Si es correcta la marca como done
                for (i=0; i<= maze_map.correctcells.length-1; i++){
                        ok_cell = maze_map.correctcells[i];
                        if (ok_cell.x == x && ok_cell.y == y){
                                ok_cell.done = true;
                                return true;
                        }
                } 
                return false;
        }

        function check_final_cell(x, y){ //porcentaje del camino completado
        	var porcentaje_alcanzado = 0;
        	//todas las casillas correctas deben estar marcadas como done, incluida la final
        	for (i=0; i <= maze_map.correctcells.length-1; i++){
        		ok_cell = maze_map.correctcells[i];
        			if (!ok_cell.done){
        				console.log("Celda sin alcanzar: "+ok_cell.x+", "+ok_cell.y);
        				return Math.floor( porcentaje_alcanzado );
        				break;
        			}
					if (ok_cell.final == true && ok_cell.x == x && ok_cell.y == y && ok_cell.done && i == maze_map.correctcells.length-1){
						return 100;
					}
				porcentaje_alcanzado = (i+1)*100/(maze_map.correctcells.length+1);
        	}
        	return Math.floor( porcentaje_alcanzado );
        }
        

        function check_destino(destX, destY){ //devuelve true si el destino existe, false si no
        	//Primero compruebo que estemos dentro de los limites del canvas
            if(destX >= 0 && destX <= w_graph - tam_w && destY >= 0 && destY <= h_graph - tam_h){
                console.log("Estamos dentro de los limites del canvas");
                return true
                
            } else {
                console.log("Nos salimos del canvas!!");
                return false;
            }
        }
        
        
        function run_pseudo_code(){
                
                $("#feedback_output").html("<span>INFO: Executing code...</span>");

        	//compruebo que haya instrucciones
        	if( $("#lista_instrucciones li[id!='cursor']").length < 1){
                        $("#feedback_output").html("<span style='color:red'>ERROR: Couldn't load code to execute</span>");
                        return false;
                }
        	// primero reestablezco el canvas y las instrucciones recibidas
        	draw_graph();
        	instrucciones_recibidas = []; 

        	//reestablezco el porcentaje y el progreso a 0
        	var porcentaje = 0
    		$("#completed_part").attr('style', 'width: '+porcentaje+'%;');
    		$("#completed_num").html(porcentaje);


        	//marco todas las correctcells del mapeo como not done
        	for (var i=0; i<maze_map.correctcells.length-1; i++){
        		maze_map.correctcells[i].done = false;
        	}

        	//Actualizo a coordenadas iniciales
			var currentx=0, newX=0;
            var currenty=0, newY=0;
            var index_li = 0;

        	$("#lista_instrucciones li[id!='cursor']").each(function(){
        		index_li ++;
        		//Añado un id a cada elemento li. Lo voy a usar en el array para enlazar con el origen. Ademas borro los estilos añadidos
        		$(this).attr('id', 'inst'+index_li).attr('style', '');
        		var instruccion = $(this);
        		var direccion = instruccion.attr('direccion');
				var dict_instr = {x: currentx, y: currenty, origen: ''}

        		console.log("damos "+instruccion.attr('steps')+" pasos hacia " + direccion);

        		for (var i=0; i<instruccion.attr('steps'); i++){

        			//calculamos nuevos valores x y
        			switch (direccion){
	                    case 'moveUp':
	                        newX = currentx;
	                        newY = currenty - tam_h;
	                        break;
	                    case 'moveLeft':
	                        newX = currentx - tam_w;
	                        newY = currenty;
	                        break;
	                    case 'moveDown':
	                        newX = currentx;
	                        newY = currenty + tam_h;
	                        break;
	                    case 'moveRight':
	                        newX = currentx + tam_w;
	                        newY = currenty;
	                        break;
	                    default: return;
	                }

	                //creamos diccionario con las coordenadas de destino de esta instruccion:
	                dict_instr = {x: newX, y: newY, origen: 'inst'+index_li};
	                //guardamos la instruccion en el array
        			instrucciones_recibidas.push(dict_instr);

        			//actualizamos los valores de posicion actual
	                currenty = newY;
	                currentx = newX;

        		} //fin repeticiones

        		
        	}); //fin instrucciones

			//al terminar de actualizar el diccionario, lo mostramos
			console.log(instrucciones_recibidas);


			//inicializo intervalo para recorrer el camino

			var indice_movimientos = 0; //movimientos realizados
			

			var handler = setInterval(function(){

				if (resultado_codigo == 2){

	                var movimiento = instrucciones_recibidas[indice_movimientos] //cojo movimiento a realizar
	                
	                indice_movimientos++;

	                console.log("Movimiento "+indice_movimientos+"---> voy a "+movimiento.x+", "+movimiento.y);

	                var destino_existe = check_destino(movimiento.x, movimiento.y);

	                if (destino_existe){

	                	 //compruebo si los valores de destino x,y son una celda de muerte 
		                var is_death_cell = check_death_cell(movimiento.x, movimiento.y);

		                if (!is_death_cell){
		                	//compruebo si el destino es una celda correcta
		                	var is_correct_cell = check_correct_cell(movimiento.x, movimiento.y);

		                	if(is_correct_cell){
		                		//Pintamos de verde y pasamos al siguiente movimiento
		                		draw_pointer(movimiento.x, movimiento.y);//pintar el pointer en el canvas
		                		var porcentaje = check_final_cell(movimiento.x, movimiento.y);

		                		//pintar porcentaje en la barra de progreso
		                		$("#completed_part").attr('style', 'width: '+porcentaje+'%;');
    							$("#completed_num").html(porcentaje);
		                		//comprobar si es la celda final
		                		if (porcentaje == 100){
		                			resultado_codigo = 1;
                                                        $("#feedback_output").html("<span style='color: #00ff00;'>SUCCESS: Congratulations! Path unlocked</span>");
                                                        
                                                        window.setTimeout(function(){
                                                            window.location.href = "secret_login.php";
                                                        }, 1500);
                                                        
                                                        //start_fireworks();
                                                        clearInterval(handler);
		                		}
		                	}else{
		                		//es una celda incorrecta. Dejamos de avanzar y pintamos de naranja.
		                		draw_orange_pointer(movimiento.x, movimiento.y);//pintar el pointer naranja en el canvas
		                		document.getElementById(movimiento.origen).setAttribute('style', 'background: #ff8d00;'); //marcar en naranja tambien la instruccion de la terminal
                                resultado_codigo = 0;
		                	}

		                }else{
		                	//has caido en una celda de muerte, revelar camino y devolver -1
		                	draw_red_pointer(movimiento.x, movimiento.y);//pintar el pointer rojo en el canvas... o todas las rojas?
	                		document.getElementById(movimiento.origen).setAttribute('style', 'background: #ff0000;'); //marcar en rojo tambien la instruccion de la terminal
                            resultado_codigo = -1;
		                }


		                

	                }else{
	                	document.getElementById(movimiento.origen).setAttribute('style', 'background: #ff8d00;'); //marcar en naranja la instruccion de la terminal
	                	resultado_codigo = 0; //Destino inexistente
	                }
	               
	               
	                //por ultimo compruebo si he llegado al paso final
	                if ( indice_movimientos >= instrucciones_recibidas.length){
	                	console.log("He terminado de moverme");
                                if ( resultado_codigo == 2){
                                        resultado_codigo = 0;
                                }
                                if(resultado_codigo == 1){resultado_codigo = 1;}
                                if(resultado_codigo == 0){resultado_codigo = 0;}
                                if(resultado_codigo == -1){resultado_codigo = -1;}
	                }
	            } else {
	            	//compruebo el resultado final de la ejecucion. 
		            switch(resultado_codigo){
		            	case 1:
                                        ("#feedback_output").html("<span style='color: #00ff00'>SUCCESS: Congratulations! Path unlocked</span>");
		            		draw_finished_graph();
                                        clearInterval(handler); 
		            		break;
		            	case 0:
                                        $("#feedback_output").html("<span style='color: orange'>WARNING: Wrong or incomplete path. Keep trying.</span>");
		            		clearInterval(handler);
		            		break;
		            	case -1:
		            		draw_graph();
		            		clear_console();
		            		currRectY = 0; currRectY = 0;
                                        $("#feedback_output").html("<span style='color: red'>FATAL ERROR: Wrong path, start over.</span>");
		            		clearInterval(handler);
		                    break;
		                default:
                                        $("#feedback_output").html("");
		            		clearInterval(handler); 
		                	return -1;
		            }
	            }
            }, 1000);

        } //fin funcion run_pseudo_code()

});