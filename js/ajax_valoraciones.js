$( document ).ready(function() {


        $form = $('#form_valoracion');

        $form.on('submit', function(e) {
                   e.preventDefault();
                   
                  console.log("enviando valoracion");
                  
        
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
                          $("#res_form_finjuego").html('<div class="alert alert-error" role="alert">'+data.message+'</div>');   
                      }else{
                          $("#form_valoracion").hide();
                          $("#res_form_finjuego").html('<div class="alert alert-primary" role="alert">'+data.message+'</div>');   
                      }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                      console.log(xhr);
                    
                    }
                  });
                            
                         
                  });
                  
});