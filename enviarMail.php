<?php

		$nombre="usuario";
        $fecha=date("d-m-Y");
        $hora=date("H:i:s");      
        $asunto='Compra en techtienda dominio';
        $desde="www.techtienda.com";
        //Direccion del remitente
        $correo.=. $_POST['email'] . "\n";
        /*Debe de indicar los estilos css aqui mismo en la variable  y si quieres incluir imagenes,estas tendran que 
        estar en un servidor yo tome la de google */
       $comentario='
        <div style="
	        border: 1px solid #d6d2d2;
	        border-radius: 5px;
	        box-shadow: 5px 5px 10px rgba(57,29,150,0.5);
	        color:#9378f0;
	        padding:10px;
	        width:800px%;
	        heigth:400px;
        ">
        <center>
        <img src="https://i1.wp.com/qepd.news/wp-content/uploads/2019/05/nvidia.jpg?resize=759%2C500&ssl=1" width="400" heigth="250">
        <h1><em>Muchas Gracias por tu compra</em></h1></center>

            <hr width="90%">

            <p>Hola '.$nombre.' muchas gracias por  comprar en nuestro sitio a continuación te mostramos los detalles de tu compra.</p>
          
            ';


        //para el envío en formato HTML 
         echo $comentario;
        $headers = "MIME-Version: 1.0\r\n"; 
        $headers .= "Content-type: text/html; charset=utf8\r\n"; 

        //dirección del remitente 
        $headers .= "From: Remitente\r\n"; 
        
        //FUNCION PARA ENVIAR EL EMAIL
        mail($correo,$asunto,$comentario,$headers);
?>