<?php
 //ECHAR SI NO HAY SESION
 session_start();
 if (!isset($_SESSION['session_id']) || $_SESSION['session_id'] == ''){
         header('Location: ../index.php');//redirigir
 } else{


?>

<html lang="es-ES" >
<head>

<title>CRON - Centro de Investigación y Desarrollo</title>

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-167445149-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-167445149-1');
</script>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>


<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

<link href="css/all.css" rel="stylesheet">
<link rel="stylesheet" href="css/styles.css">

<script>

$( document ).ready(function() {
        var isTouchDevice = 'ontouchstart' in document.documentElement;
        console.log(isTouchDevice);
        //if(isTouchDevice){
                $('#fingerprintfile').addClass('clickableloader');
        //}

        var isAdvancedUpload = function() {
          var div = document.createElement('div');
          return (('draggable' in div) || ('ondragstart' in div && 'ondrop' in div)) && 'FormData' in window && 'FileReader' in window;
        }();
        
        var $form = $('#fingerprintform');
        var $input = $('#fingerprintfile');
        
        if (isAdvancedUpload) {
          $form.addClass('has-advanced-upload');
         
          /*var droppedFiles = false;
          var droppedUrl = false;
          
          $form.on('drag dragstart dragend dragover dragenter dragleave drop', function(e) {
            e.preventDefault();
            e.stopPropagation();
          })
          .on('dragover dragenter', function() {
            $form.addClass('is-dragover');
          })
          .on('dragleave dragend drop', function() {
            $form.removeClass('is-dragover');
          })
          .on('drop', function(e) {
            if (e.originalEvent.dataTransfer.getData('url')){
                    droppedUrl = e.originalEvent.dataTransfer.getData('url');
            }
            else if(e.originalEvent.dataTransfer.files){
                    droppedFiles = e.originalEvent.dataTransfer.files;
            }
            console.log("Dropped URL "+droppedUrl);
            console.log("Dropped files "+droppedFiles);
            $form.trigger('submit');
          });*/
          
          $input.on('change', function(e) { // when drag & drop is NOT supported
              $form.trigger('submit');
          });
          
          
          $form.on('submit', function(e) {
                  if ($form.hasClass('is-uploading') && !$form.hasClass('is-error')) return false;
                
                  $form.addClass('is-uploading').removeClass('is-error');

                  if (isAdvancedUpload) {
                         
                            // ajax for modern browsers
                          e.preventDefault();
                          

                          var ajaxData = new FormData($form.get(0));
                          /*console.log(droppedFiles);
                          console.log(droppedUrl);
                          if (droppedFiles) {
                            $.each( droppedFiles, function(i, file) {
                              ajaxData.append( $input.attr('name'), file );
                            });
                          } else if (droppedUrl){
                              ajaxData.append($input.attr('name'), droppedUrl);
                          }*/
                        
                          $.ajax({
                            url: $form.attr('action'),
                            type: $form.attr('method'),
                            data: ajaxData,
                            dataType: 'json',
                            cache: false,
                            contentType: false,
                            processData: false,
                            complete: function(data) {
                              console.log("complete");
                              console.log(ajaxData);
                              $form.removeClass('is-uploading');
                            },
                            success: function(data) {
                              console.log("success", data);
                              $form.addClass( data.success == true ? 'is-success' : 'is-error' );
                              if (!data.success){ 
                                      $('#box__msg').text("Acceso denegado");
                              }else{
                                      $('#box__msg').text("Acceso permitido");
                                       window.setTimeout(function(){
                                        window.location.href = "administrar.php";
                                    }, 1500);
                              }
                            },
                            error: function(xhr, ajaxOptions, thrownError) {
                              console.log("error", xhr);
                            }
                          });
                    
                  } else {
                            // ajax for legacy browsers
                            
                            var iframeName  = 'uploadiframe' + new Date().getTime();
                            $iframe   = $('<iframe name="' + iframeName + '" style="display: none;"></iframe>');
                        
                          $('body').append($iframe);
                          $form.attr('target', iframeName);
                        
                          $iframe.one('load', function() {
                            var data = JSON.parse($iframe.contents().find('body' ).text());
                            $form
                              .removeClass('is-uploading')
                              .addClass(data.success == true ? 'is-success' : 'is-error')
                              .removeAttr('target');
                            if (!data.success) $('#box__msg').text("Acceso denegado");
                            $form.removeAttr('target');
                            $iframe.remove();
                          });
                          
                          
                  }
          });
        }
});

</script>
<script>(function(e,t,n){var r=e.querySelectorAll("html")[0];r.className=r.className.replace(/(^|\s)no-js(\s|$)/,"$1js$2")})(document,window,0);</script>

</head>

<body id="page-top" style="background: #05b3d28f;">

  <!-- Navigation -->

  <header class="bg-primary">
    <div class="text-right">
      <nav>
    <ul>
        <li>
                <a href="index.php"><button class="btn btn-primary" id="login" data-toggle="modal" data-target="#modalLogin">Salir</button></a>

         </li>
         <li>
                 <button class="btn btn-primary" id="myid" data-toggle="modal" data-target="#modalSessionid">Mi ID</button>
                 

                  <div class="modal fade" id="modalSessionid" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Id de grupo</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                      <?=$_SESSION['session_id'];?>
                      </div>
                    </div>
                  </div>
                </div>
         </li>
         <li>
                 <button class="btn btn-primary" id="myid" data-toggle="modal" data-target="#modalPistas">Pista</button>
                 <div class="modal fade" id="modalPistas" tabindex="-1" role="dialog" aria-hidden="true">
                  <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Pistas</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                      <?=include ("pistas.html");?>
                      </div>
                    </div>
                  </div>
                </div>
         </li>
         
    </ul>
</nav>
    </div>
  </header>

  <section class="bg-login">
    <div class="container">
      <div class="row">
        <div class="col-lg-4 mx-auto">
        
        
        </div>
        <div class="col-lg-4 mx-auto">
             <form class="box" method="post" action="comprobarhuella.php" enctype="multipart/form-data" id="fingerprintform">
                  <h4>Acceso restringido</h4>
                  <h5>Inicie sesión con sus credenciales biométricas</h5>
                  <div class="box__input">
                    <input class="box__file" type="file" name="fingerprintfile" id="fingerprintfile" />
                    <label for="file"><!--strong>Carga aquí tu huella</strong><span class="box__dragndrop"></span--></label>
                    <button class="box__button" type="submit">Upload</button>
                  </div>
                  <div class="box__msg" id="box__msg"></div>
             </form>


          <!--form  method="post" action="comprobarhuella.php" enctype="multipart/form-data" id="fingerprintform">
               <input type="file" name="fingerprintfile" id="fingerprintfile" />
               <label for="file">Choose a file.</label>
               <input type="submit" id="btsubmit" value="Upload"/>
          </form-->
          
        </div>
        <div class="col-lg-4 mx-auto"></div>
    </div>
 </div>

  </section>

</body>

</html>
<?php } ?>