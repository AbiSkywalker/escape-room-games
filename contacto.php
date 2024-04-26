<?php

/* Namespace alias. */
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

include('includes/PHPMailer/src/Exception.php');
include('includes/PHPMailer/src/PHPMailer.php');
include('includes/PHPMailer/src/SMTP.php');



// Create connection
include("includes/connect.php");
$conn = new mysqli($servername, $username, $password, $db);

// Check connection
if ($conn->connect_error) {
    die("Error de conexion: " . $conn->connect_error);
}

$datosenviados = false;

/* Create a new PHPMailer object. Passing TRUE to the constructor enables exceptions. */
$mail = new PHPMailer(TRUE);

if(isset($_POST['nombre']) && isset($_POST['email']) && isset($_POST['asunto']) && isset($_POST['mensaje'])){
        $datosenviados = true;

        /* Open the try/catch block. */
        try {
           /* Set the mail sender. */
           $mail->setFrom($_POST['email'], $_POST['nombre']);
        
           /* Add a recipient. */
           $mail->addAddress('hola@abiramirez.dev', 'Info');
        
           /* Set the subject. */
           $mail->Subject = $_POST['asunto'];
        
           /* Set the mail message body. */
           $mail->Body = $_POST['mensaje'];
        
           /* Finally send the mail. */
           $res = $mail->send();
        }
        catch (Exception $e)
        {
           /* PHPMailer exception. */
           $res = $e->errorMessage();
        }
        catch (\Exception $e)
        {
           /* PHP exception (note the backslash to select the global namespace Exception class). */
           $res = $e->getMessage();
        }
}

?>

<html lang="es-ES" >
<head>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-167445149-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-167445149-1');
</script>

<title>Contacto- Escape Room Desde Casa</title>
<meta name="description" content="Contacta con nosotros" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">


<link href="css/main.css" rel="stylesheet">

</head>

<body id="page-top">

  <!-- Navigation -->

  
  
  <header class="bg-primary text-white">
    <div class="container" id="esc_header">
    <div class="row">
              <div class="col-md-2">
                      <img src="img/logo.png" class="img-fluid imglogomain"/>
              </div>
              <div class="col-md-8 my-auto">
                      <h1 class=" text-right">Escape Room Desde Casa</h1>
                      <p class="lead  text-right">Juega sin salir de casa</p>
              </div>
              </div>
    </div>
  </header>
  <nav class="">
        <div class="container text-right">
                <a class="btn navbtn" href="https://abiramirez.dev/escapegames/"><i class="fas fa-home"></i></a>
                <a class="btn navbtn" href="https://abiramirez.dev/escapegames/contacto.php"><i class="far fa-envelope"></i></a>
                <a class="btn navbtn" href="https://www.instagram.com/escapedesdecasa/" target="_blank"><i class="fab fa-instagram"></i></a>
        </div>
  </nav>

  

  

  <section class="section_juego">
    <div class="container">
      <div class="row">
          <div class="col-lg-12 " id="mainsec">
          
                 <h4>Contacta con nosotros</h4>
                 <?php if($datosenviados && $res){
                         echo "<div class='alert alert-success'><h4>¡Gracias por tu mensaje!</h4></div>";
                 }else if($datosenviados){
                         echo "<div class='alert alert-error'>¡Ups! Parece que ha habido un error... Vuelve a intentarlo más tarde.</div>";
                 }?>
                 
 <form id="contact-form" method="post" action="#" role="form">

    <div class="messages"></div>

    <div class="controls">

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="form_name">Nombre *</label>
                    <input id="form_name" type="text" name="nombre" class="form-control" placeholder="Nombre" required="required" data-error="Introduce tu nombre">
                    <div class="help-block with-errors"></div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="form_email">Email *</label>
                    <input id="form_email" type="email" name="email" class="form-control" placeholder="example@example.com" required="required" data-error="Introduce un emal válido.">
                    <div class="help-block with-errors"></div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="form_asuntp">Asunto *</label>
                    <input id="form_asuntp" type="text" name="asunto" class="form-control" placeholder="Asunto" required="required" data-error="Introduce un asunto.">
                    <div class="help-block with-errors"></div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="form_message">Mensaje *</label>
                    <textarea id="form_message" name="mensaje" class="form-control" placeholder="Tu mensaje *" rows="4" required="required" data-error="Introduce texto en el mensaje."></textarea>
                    <div class="help-block with-errors"></div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <p class="text-muted small">
                    <strong>*</strong> Estos campos son obligatorios.</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <input type="submit" class="btn btn-success btn-send" value="Enviar">
            </div>
        </div>
    </div>

</form>
                 
                 

           </div>
      </div>
    </div>
  </section>
  

</body>

</html>
