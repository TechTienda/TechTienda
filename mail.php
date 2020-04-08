<?php
    if(!empty($_POST)){
    $email_to = "hdfg2016@gmail.com";
    $email_subject = "Contacto de Venta! Nuevo Cliente!";
    $email_message = "Detalles del formulario de contacto:\n\n";
    $email_message .= "Nombre: " . $_POST['nombre'] . "\n";
    $email_message .= "Apellido: " . $_POST['apellido'] . "\n";
    $email_message .= "E-mail: " . $_POST['email'] . "\n";
    $email_message .= "Telefono: " . $_POST['telefono'] . "\n";
    $email_message .= "Direccion: " . $_POST['mensaje'] . "\n\n";

 $email_message .=date("d-m-Y");
  $email_message .=date("H:i:s");


    // Ahora se envía el e-mail usando la función mail() de PHP
     $mail = $_POST['email'];
    $header = 'From: ' . $mail . " \r\n";
    $header .= "X-Mailer: PHP/" . phpversion() . " \r\n";
    $header .= "Mime-Version: 1.0 \r\n";
    $header .= "Content-Type: text/plain";

    if(mail($email_to, $email_subject, $email_message,$header)){
        echo 'Enviado Correctamente ahora puedes dar al boton comprar, para el pago de tus productos en paypal.com';
    }else{
        echo 'No se pudo enviar el correo';
    }

    
}
?>