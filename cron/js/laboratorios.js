$( document ).ready(function() {


var laboratorios = ['american', 'americas', 'europa', 'asia', 'africa', 'oceania'];
var labs_activos = {'XF103': 'activo', 'GF289': 'activo', 'GS554': 'activo', 'MD351': 'activo', 'GA910': 'activo', 'LP739': 'activo'}

window.setInterval(actualizar_mapa, 5000);

 var codigolab = $('#codigolab').val();

 $form = $('#form-acceso');
 
 $elec = $('#form-elec');
 $redes = $('#form-redes');
 $entorno = $('#form-entorno');
 $atmosfera = $('#form-atmosfera');
 $drenaje = $('#form-drenaje');
 $navegacion = $('#form-navegacion');

var oport = 3;

//Formulario de acceso a laboratorios. Comprueba coordenadas y devuelve html para ventana modal
 $form.on('submit', function(e) {
           e.preventDefault();
           
           console.log($('#codigolab').val());
           var cookie_lab = getCookie($('#codigolab').val());
           console.log(cookie_lab);
           if (cookie_lab == 1){
               return false;
           }
           console.log(labs_activos[$('#codigolab').val()]);
           //si el laboratorio ya esta desactivado, no hacer nada
           if (labs_activos[$('#codigolab').val()] == 'desactivado'){
                   return false;
           }
                                   

         var ajaxData = new FormData($form.get(0));
        
          $.ajax({
            url: $form.attr('action'),
            type: $form.attr('method'),
            data: ajaxData,
            dataType: 'json',
            cache: false,
            contentType: false,
            processData: false,
            complete: function() {
              
            },
            success: function(data) {
              console.log(data);
              $form.addClass( data.success == true ? 'is-success' : 'is-error' );
              if (!data.success){ 

              }else{
                      $('#modal-title').text(data.labName);
                      $('#modal-body').html(data.htmlcontent);
                      
                      restablecer_paneles();
                      
                      codigolab = $('#codigolab').val();
                      $('input.hiddencodlab').val(codigolab);
                      $('#config-lab').modal('show');
              }
            },
            error: function(xhr, ajaxOptions, thrownError) {
              console.log(xhr);
            
            }
          });
                    
                 
          });
          
          
          
//Formulario de panel electrico. Comprueba si se ha desactivado el laboratorio
          
 $elec.on('submit', function(e) {
           e.preventDefault();

         console.log("Enviando form electricidad");
         var formelec = $('#form-elec')[0];
         var datos = new FormData(formelec);

        
          $.ajax({
            url: $elec.attr('action'),
            type: $elec.attr('method'),
            data: datos,
            dataType: 'json',
            cache: false,
            contentType: false,
            processData: false,
            complete: function(data) {

            },
            success: function(data) {

              if (!data.success){ 
                      if (data.message == 'errparametros'){
                              $("#pantalla-elec .feedbackmsg").html("<h5>Parámetros no válidos. Reiniciando</h5>");
                              //volver a valores iniciales y actualizar pantalla
                              $("#voltaje").val(97);
                              $('#voltaje-actual').text('97 %');
                      }
                      
                      if (data.message == 'parametrosok'){
                              $("#pantalla-elec .feedbackmsg").html("<h5>Parámetros establecidos</h5>");
                              //Actualizar pantalla
                              $('#voltaje-actual').text($("#voltaje").val() + ' %');
                              
                      }
                      
              }else{
                      //Laboratorio destruido
                      var cont_seg = 10;
                      
                      var handler = setInterval(function(){
                              var html_error = '<div class="feedbackmsg">';
                                      html_error += '<div class="row">';
                                              html_error += '<div class="col-md-6">';
                                                      html_error += '<h4 class="warning">ALERTA: VOLTAJE INSUFICIENTE</h4><h5>Estableciendo conexion con generadores auxiliares.</h5>';
                                              html_error += '</div>';
                                              html_error += '<div class="col-md-6">';
                                                      html_error += '<span>CORRIENTE RESTANTE: '+cont_seg+' segundos</span>';
                                              html_error += '</div>';
                                      html_error += '</div>';
                              html_error += '</div>';
                              $("#pantalla-elec .feedbackmsg").html(html_error);
                              
                              if (cont_seg == 0){
                                        
                                        //Marcar desactivado en el array y en el mapa
                                        console.log("DESACTIVANDO: "+$('#codigo_lab').val());
                                        labs_activos[$('#codigolab').val()] = 'desactivado';
                                        $('#'+data.continentelab).addClass('desactivado');
                                        
                                        //Cerrar modal y marcar lab desactivado
                                        $('#panel-electrico').modal('hide');
                                        $('#config-lab').modal('hide');
                                        
                                        //reestablecer ventana de panel electrico
                                        $('#pantalla-elec .feedbackmsg').text('');
                                        $("#potencia").val(5);
                                        $("#voltaje").val(5);
                                        $('#potencia-actual').text('5 A');
                                        $('#voltaje-actual').text('5 V');
                                        
                                        clearInterval(handler);
                              }
                              cont_seg = cont_seg-1;
                      }, 1000);
                      
                      
                      console.log(data);
              }
            },
            error: function(xhr, ajaxOptions, thrownError) {
            
            }
          });
                    
                 
  });
  
  
  //Formulario de redes. Comprueba si se ha desactivado el laboratorio
          
 $redes.on('submit', function(e) {
           e.preventDefault();

         console.log("Enviando form redes");
         var formredes = $('#form-redes')[0];
         var datos = new FormData(formredes);

        
          $.ajax({
            url: $redes.attr('action'),
            type: $redes.attr('method'),
            data: datos,
            dataType: 'json',
            cache: false,
            contentType: false,
            processData: false,
            complete: function(data) {
            },
            success: function(data) {
                 console.log(data);

              if (!data.success){ 
                      if (data.message == 'errparametros'){
                              $("#pantalla-redes .feedbackmsg").html("<h5>Parámetros no válidos. Reiniciando</h5>");
                              //volver a valores iniciales y actualizar pantalla
                              $("#banda").val(5)
                              $("#banda2").val(5)
                              $("#canal").val(11)
                              $("#canal2").val(7)
                              $('#frecuencia1-actual').text('5 GHz');
                              $('#frecuencia2-actual').text('5 GHz');
                              $('#canal1-actual').text('11');
                              $('#canal2-actual').text('7');
                      }
                      if (data.message == 'parametrosok'){
                              $("#pantalla-redes .feedbackmsg").html("<h4>Parámetros establecidos</h4>");
                              //Actualizar pantalla
                              $('#frecuencia1-actual').text($("#banda").val() + ' GHz');
                              $('#canal1-actual').text($("#canal").val());
                              $('#frecuencia2-actual').text($("#banda2").val() + ' GHz');
                              $('#canal2-actual').text($("#canal2").val());
                              
                      }
                      
              }else{
                      //Laboratorio destruido
                      var cont_seg = 10;
                      
                      var handler = setInterval(function(){
                              var html_error = '<div class="feedbackmsg">';
                                      html_error += '<div class="row">';
                                              html_error += '<div class="col-md-6">';
                                                      html_error += '<h4 class="warning">ALERTA: SE HA PERDIDO LA SEÑAL DE RED</h4><h5></h5>';
                                              html_error += '</div>';
                                              html_error += '<div class="col-md-6">';
                                                      html_error += '<span>Desconectando en '+cont_seg+' segundos</span>';
                                              html_error += '</div>';
                                      html_error += '</div>';
                              html_error += '</div>';
                              $("#pantalla-redes .feedbackmsg").html(html_error);
                              
                              if (cont_seg == 0){
                                        
                                        //Marcar desactivado en el array y en el mapa
                                        console.log("DESACTIVANDO: "+$('#codigo_lab').val());
                                        labs_activos[$('#codigolab').val()] = 'desactivado';
                                        $('#'+data.continentelab).addClass('desactivado');
                                        
                                        //Cerrar modal y marcar lab desactivado
                                        $('#panel-redes').modal('hide');
                                        $('#config-lab').modal('hide');
                                        
                                        //reestablecer ventana de redes
                                        $('#pantalla-redes .feedbackmsg').text('');
                                        $("#banda").val(5);
                                        $("#canal").val(11);
                                        $('#frecuencia1-actual').text('5 GHz');
                                        $('#canal1-actual').text('11');
                                        $("#banda2").val(5);
                                        $("#canal2").val(7);
                                        $('#frecuencia1-actual').text('5 GHz');
                                        $('#canal1-actual').text('7');
                                        
                                        clearInterval(handler);
                              }
                              cont_seg = cont_seg-1;
                      }, 1000);
                      
                      
                      console.log(data);
              }
            },
            error: function(xhr, ajaxOptions, thrownError) {
            
            }
          });
                    
                 
  });



 //Formulario de entorno. Comprueba si se ha desactivado el laboratorio
          
 $entorno.on('submit', function(e) {
           e.preventDefault();
         console.log("Enviando form entorno");

         var formentorno = $('#form-entorno')[0];
         var datos = new FormData(formentorno);

        
          $.ajax({
            url: $entorno.attr('action'),
            type: $entorno.attr('method'),
            data: datos,
            dataType: 'json',
            cache: false,
            contentType: false,
            processData: false,
            complete: function(data) {

            },
            success: function(data) {
                console.log(data);
              if (!data.success){ 
                       if (data.message == 'errparametros'){
                              oport = oport-1;
                              
                              $("#pantalla-entorno .feedbackmsg").html("<h4>Parámetros no válidos. Reiniciando.</h4><p>Quedan "+oport+" cambios antes de desconectar</p>");
                              //Actualizar pantalla
                              $("#oport").val(oport);//actualizar oportunidades restantes
                              $("#temp").val(19.5);
                              $("#humedad").val(50);
                              $('#temp-actual').text('19.5ºC');
                              $('#humedad-actual').text('50 %');
                              $('#o2val').text('19.5ºC');
                              $('#humedadval').text('50 %');
                              
                      }
                      if (data.message == 'parametrosok'){
                              $("#pantalla-entorno .feedbackmsg").html("<h4>Parámetros establecidos</h4>");
                              //Actualizar pantalla
                              oport = 3;
                              $("#oport").val(oport);
                              $('#temp-actual').text($("#temp").val() + ' ºC');
                              $('#humedad-actual').text($("#humedad").val() + ' %');
                              
                      }
                      
              }else{
                      //Laboratorio destruido
                      var cont_seg = 5;
                      
                      var handler = setInterval(function(){
                              var html_error = '<div class="feedbackmsg">';
                                      html_error += '<div class="row">';
                                              html_error += '<div class="col-md-6">';
                                                      html_error += '<h4 class="warning">ALERTA: ENTORNO DAÑINO</h4><h5></h5>';
                                              html_error += '</div>';
                                              html_error += '<div class="col-md-6">';
                                                      html_error += '<span>Apagando en '+cont_seg+' segundos</span>';
                                              html_error += '</div>';
                                      html_error += '</div>';
                              html_error += '</div>';
                              $("#pantalla-entorno .feedbackmsg").html(html_error);
                              
                              if (cont_seg == 0){
                                        
                                        //Marcar desactivado en el array y en el mapa
                                        console.log("DESACTIVANDO: "+$('#codigo_lab').val());
                                        labs_activos[$('#codigolab').val()] = 'desactivado';
                                        $('#'+data.continentelab).addClass('desactivado');
                                        
                                        //Cerrar modal y marcar lab desactivado
                                        $('#panel-entorno').modal('hide');
                                        $('#config-lab').modal('hide');
                                        
                                        //reestablecer ventana de entorno
                                        $('#pantalla-entorno .feedbackmsg').text('');
                                        $("#temp").val(19.5);
                                        $("#humedad").val(50);
                                        $('#temp-actual').text('19.5ºC');
                                        $('#humedad-actual').text('50 %');
                                        
                                        clearInterval(handler);
                              }
                              cont_seg = cont_seg-1;
                      }, 1000);
                      
                      
                      console.log(data);
              }
            },
            error: function(xhr, ajaxOptions, thrownError) {
            console.log(xhr);
            }
          });
                    
                 
  });



//Formulario de atmosfera. Comprueba si se ha desactivado el laboratorio
          
 $atmosfera.on('submit', function(e) {
           e.preventDefault();
         console.log("Enviando form atmosfera");

         var formatmosfera = $('#form-atmosfera')[0];
         var datos = new FormData(formatmosfera);

        
          $.ajax({
            url: $atmosfera.attr('action'),
            type: $atmosfera.attr('method'),
            data: datos,
            dataType: 'json',
            cache: false,
            contentType: false,
            processData: false,
            complete: function(data) {

            },
            success: function(data) {

              if (!data.success){ 
                      
                      if (data.message == 'parametrosok'){
                              $("#pantalla-atmosfera .feedbackmsg").html("<h4>Parámetros establecidos</h4>");
                              //Actualizar pantalla
                              $('#temperatura-actual').text($("#temperatura").val() + ' ºC');

                              
                      }
                      
              }else{
                      //Laboratorio destruido
                      var cont_seg = 8;
                      
                      var handler = setInterval(function(){
                              var html_error = '<div class="feedbackmsg">';
                                      html_error += '<div class="row">';
                                              html_error += '<div class="col-md-6">';
                                                      html_error += '<h4 class="warning">ALERTA: ATMÓSFERA INSOSTENIBLE</h4><h5></h5>';
                                              html_error += '</div>';
                                              html_error += '<div class="col-md-6">';
                                                      html_error += '<span>Desactivando criogenización en '+ cont_seg +'</span>';
                                              html_error += '</div>';
                                      html_error += '</div>';
                              html_error += '</div>';
                              $("#pantalla-atmosfera .feedbackmsg").html(html_error);
                              
                              if (cont_seg == 0){
                                        
                                        //Marcar desactivado en el array y en el mapa
                                        console.log("DESACTIVANDO: "+$('#codigo_lab').val());
                                        labs_activos[$('#codigolab').val()] = 'desactivado';
                                        $('#'+data.continentelab).addClass('desactivado');
                                        
                                        //Cerrar modal y marcar lab desactivado
                                        $('#panel-atmosfera').modal('hide');
                                        $('#config-lab').modal('hide');
                                        
                                        //reestablecer ventana de entorno
                                        $('#pantalla-atmosfera .feedbackmsg').text('');
                                        $("#temperatura").val(-50);+
                                        $('#temperatura-actual').text('-50ºC');
                                        
                                        clearInterval(handler);
                              }
                              cont_seg = cont_seg-1;
                      }, 1000);
                      
                      
                      console.log(data);
              }
            },
            error: function(xhr, ajaxOptions, thrownError) {
            
            }
          });
                    
                 
  });
  
  
  


//Formulario de drenaje. Comprueba si se ha desactivado el laboratorio
          
 $drenaje.on('submit', function(e) {
           e.preventDefault();
         console.log("Enviando form drenaje");

         var formdrenaje = $('#form-drenaje')[0];
         var datos = new FormData(formdrenaje);

        
          $.ajax({
            url: $drenaje.attr('action'),
            type: $drenaje.attr('method'),
            data: datos,
            dataType: 'json',
            cache: false,
            contentType: false,
            processData: false,
            complete: function(data) {

            },
            success: function(data) {

              if (!data.success){ 
                      
                      if (data.message == 'parametrosok'){
                              $("#pantalla-drenaje .feedbackmsg").html("<h4>Parámetros establecidos</h4>");
                              //Actualizar pantalla
                              $('#c1-actual').text(($('#c1').is(':checked')) ? 'Abierta':'Cerrada');
                              $('#c2-actual').text(($('#c2').is(':checked')) ? 'Abierta':'Cerrada');
                              $('#c3-actual').text(($('#c3').is(':checked')) ? 'Abierta':'Cerrada');
                              $('#c4-actual').text(($('#c4').is(':checked')) ? 'Abierta':'Cerrada');

                              
                      }
                      
              }else{
                      //Laboratorio destruido
                      var cont_seg = 8;
                      
                      var handler = setInterval(function(){
                              var html_error = '<div class="feedbackmsg">';
                                      html_error += '<div class="row">';
                                              html_error += '<div class="col-md-6">';
                                                      html_error += '<h4 class="warning">ALERTA: PELIGRO DE INUNDACIÓN</h4><h5></h5>';
                                              html_error += '</div>';
                                              html_error += '<div class="col-md-6">';
                                                      html_error += '<span>Cerrar compuertas en '+ cont_seg +'</span>';
                                              html_error += '</div>';
                                      html_error += '</div>';
                              html_error += '</div>';
                              $("#pantalla-drenaje .feedbackmsg").html(html_error);
                              
                              if (cont_seg == 0){
                                        
                                        //Marcar desactivado en el array y en el mapa
                                        console.log("DESACTIVANDO: "+$('#codigo_lab').val());
                                        labs_activos[$('#codigolab').val()] = 'desactivado';
                                        $('#'+data.continentelab).addClass('desactivado');
                                        
                                        //Cerrar modal y marcar lab desactivado
                                        $('#panel-drenaje').modal('hide');
                                        $('#config-lab').modal('hide');
                                        
                                        //reestablecer ventana de entorno
                                        $('#pantalla-drenaje .feedbackmsg').text('');
                                        $("#c1").attr('checked', false);
                                        $("#c2").attr('checked', true);
                                        $("#c3").attr('checked', true);
                                        $("#c4").attr('checked', true);
                                        
                                        $('#c1-actual').text('Cerrada');
                                        $('#c2-actual').text('Abierta');
                                        $('#c3-actual').text('Abierta');
                                        $('#c4-actual').text('Abierta');
                                        
                                        clearInterval(handler);
                              }
                              cont_seg = cont_seg-1;
                      }, 1000);
                      
                      
                      console.log(data);
              }
            },
            error: function(xhr, ajaxOptions, thrownError) {
            
            }
          });
                    
                 
  });
  
  
  
  //Formulario de navegacion. Comprueba si se ha desactivado el laboratorio
          
 $navegacion.on('submit', function(e) {
           e.preventDefault();
           
         console.log("Enviando form navegacion");
         
         var formnavegacion = $('#form-navegacion')[0];
         var datos = new FormData(formnavegacion);
         
        
          $.ajax({
            url: $navegacion.attr('action'),
            type: $navegacion.attr('method'),
            data: datos,
            dataType: 'json',
            cache: false,
            contentType: false,
            processData: false,
            complete: function(data) {
            console.log(data);

            },
            success: function(data) {
            
              if (!data.success){ 
                      
                      if (data.message == 'parametrosok'){
                              $("#pantalla-navegacion .feedbackmsg").html("<h4>Parámetros establecidos</h4>");
                              //Actualizar pantalla
                              var rumbo_actual = $("#rumboy").val()+" "+$("#gradosrumbo").val()+"º "+$("#rumbox").val();
                              console.log(rumbo_actual);
                              $('#rumbo-actual').text(rumbo_actual);
                              $('#velocidad-actual').text($("#velocidad").val());

                              
                      }
                      
              }else{
                      //Laboratorio destruido
                      var cont_seg = 8;
                      
                      var handler = setInterval(function(){
                              var html_error = '<div class="feedbackmsg">';
                                      html_error += '<div class="row">';
                                              html_error += '<div class="col-md-6">';
                                                      html_error += '<h4 class="warning">ALERTA: PELIGRO DE CHOQUE</h4><h5></h5>';
                                              html_error += '</div>';
                                              html_error += '<div class="col-md-6">';
                                                      html_error += '<span>Colisión inminente: '+ cont_seg +' segundos</span>';
                                              html_error += '</div>';
                                      html_error += '</div>';
                              html_error += '</div>';
                              $("#pantalla-navegacion .feedbackmsg").html(html_error);
                              
                              if (cont_seg == 0){
                                        
                                        //Marcar desactivado en el array y en el mapa
                                        console.log("DESACTIVANDO: "+$('#codigo_lab').val());
                                        labs_activos[$('#codigolab').val()] = 'desactivado';
                                        $('#'+data.continentelab).addClass('desactivado');
                                        
                                        //Cerrar modal y marcar lab desactivado
                                        $('#panel-navegacion').modal('hide');
                                        $('#config-lab').modal('hide');
                                        
                                        //reestablecer ventana de entorno
                                        $('#pantalla-navegacion .feedbackmsg').text('');
                                        $("#rumboy").val('N');
                                        $("#gradosrumbo").val(80);
                                        $("#rumbox").val('W');
                                        
                                        $('#rumbo-actual').text('N 80º W');
                                        $('#velocidad-actual').text('40 nudos');
                                        
                                        clearInterval(handler);
                              }
                              cont_seg = cont_seg-1;
                      }, 1000);
                      
                      
              }
            },
            error: function(xhr, ajaxOptions, thrownError) {
            
            }
          });
                    
                 
  });
  
  
  function restablecer_paneles(){
          //PANEL ELECTRICO
          //pantalla
          $("#voltaje-actual").text('97 %');
          //form
          $("#voltaje").val(97);
          
          //PANEL REDES
          //pantalla
          $("#frecuencia1-actual").text('5 GHz');
          $("#canal1-actual").text('11');
          $("#frecuencia2-actual").text('5 GHz');
          $("#canal2-actual").text('7');
          //form
          $("#banda").val(5);
          $("#canal").val(11);
          $("#banda2").val(5);
          $("#canal2").val(7);
          
          //PANEL ENTORNO
          //pantalla
          oport = 3;
          $("#oport").val(oport);
          $("#oxigeno-actual").text('21%');
          $("#humedad-actual").text('50%');
          //form
          $("#oxigeno").val(21);
          $("#humedad").val(50);
          
          //PANEL ATMOSFERA
          //pantalla
          $("#temperatura-actual").text('-50ºC');
          //form
          $("#temperatura").val(-50);

  }
  
  
   function actualizar_mapa(){
           $.ajax({
            url: 'actualizar_mapa.php',
            type: 'post',
            /*data: '',
            dataType: 'json',*/
            cache: false,
            contentType: false,
            processData: false,
            complete: function(data) {

            },
            success: function(data) {
              var dataobj = JSON.parse(data);

              if (dataobj.americanorte == 1){
                      $("#americanorte").addClass('desactivado');
              }
              if (dataobj.americasur){
                      $("#americasur").addClass('desactivado');
              }
              if (dataobj.europa){
                      $("#europa").addClass('desactivado');
              }
              if (dataobj.asia){
                      $("#asia").addClass('desactivado');
              }
              if (dataobj.africa){
                      $("#africa").addClass('desactivado');
              }
              if (dataobj.oceania){
                      $("#oceania").addClass('desactivado');
              }
              if(dataobj.completado){
                      $("#findeljuegomodal").modal('show');
                      setTimeout(window.location.href='finjuego.php', 5000);
              }
            },
            error: function(xhr, ajaxOptions, thrownError) {
            
            }
          });
  
  }
  
});