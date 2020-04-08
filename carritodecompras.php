<?php
	session_start();
	include './conexion.php';
	if(isset($_SESSION['carrito'])){
		if(isset($_GET['id'])){
					$arreglo=$_SESSION['carrito'];
					$encontro=false;
					$numero=0;
					for($i=0;$i<count($arreglo);$i++){
						if($arreglo[$i]['Id']==$_GET['id']){
							$encontro=true;
							$numero=$i;
						}
					}
					if($encontro==true){
						$arreglo[$numero]['Cantidad']=$arreglo[$numero]['Cantidad']+1;
						$_SESSION['carrito']=$arreglo;
					}else{
						$nombre="";
						$precio=0;
						$imagen="";
						$re=mysql_query("select * from productos where id=".$_GET['id']);
						while ($f=mysql_fetch_array($re)) {
							$nombre=$f['nombre'];
							$precio=$f['precio'];
							$imagen=$f['imagen'];
						}
						$datosNuevos=array('Id'=>$_GET['id'],
										'Nombre'=>$nombre,
										'Precio'=>$precio,
										'Imagen'=>$imagen,
										'Cantidad'=>1);

						array_push($arreglo, $datosNuevos);
						$_SESSION['carrito']=$arreglo;

					}
		}




	}else{
		if(isset($_GET['id'])){
			$nombre="";
			$precio=0;
			$imagen="";
			$re=mysql_query("select * from productos where id=".$_GET['id']);
			while ($f=mysql_fetch_array($re)) {
				$nombre=$f['nombre'];
				$precio=$f['precio'];
				$imagen=$f['imagen'];
			}
			$arreglo[]=array('Id'=>$_GET['id'],
							'Nombre'=>$nombre,
							'Precio'=>$precio,
							'Imagen'=>$imagen,
							'Cantidad'=>1);
			$_SESSION['carrito']=$arreglo;
		}
	}
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8"/>
	<title>Carrito de Compras</title>
	<link rel="stylesheet" type="text/css" href="./css2/estilos2.css">
	<script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
	<script type="text/javascript"  src="./js/scripts.js"></script>
</head>
<body>
	<header>
		<h1>Carrito de compras</h1>
		<a href="./carritodecompras.php" title="ver carrito de compras">
			<img src="./Imagenes/carrito.png">
		</a>
	</header>
	<section>
		<?php
			$total=0;
			if(isset($_SESSION['carrito'])){
			$datos=$_SESSION['carrito'];
			
			$total=0;
			for($i=0;$i<count($datos);$i++){
				
	?>
				<div class="producto">
					<center>
						<img src="./productos/<?php echo $datos[$i]['Imagen'];?>"><br>
						<span ><?php echo $datos[$i]['Nombre'];?></span><br>
						<span>Precio: <?php echo $datos[$i]['Precio'];?></span><br>
						<span>Cantidad: 
							<input type="text" value="<?php echo $datos[$i]['Cantidad'];?>"
							data-precio="<?php echo $datos[$i]['Precio'];?>"
							data-id="<?php echo $datos[$i]['Id'];?>"
							class="cantidad">
						</span><br>
						<span class="subtotal">Subtotal:<?php echo $datos[$i]['Cantidad']*$datos[$i]['Precio'];?></span><br>
						<a href="#" class="eliminar" data-id="<?php echo $datos[$i]['Id']?>">Eliminar</a>
					</center>
				</div>
			<?php
				$total=($datos[$i]['Cantidad']*$datos[$i]['Precio'])+$total;
			}
				
			}else{
				echo '<center><h2>No has añadido ningun producto</h2></center>';
			}
			echo '<center><h2 id="total">Total: '.$total.'</h2></center>';
			if($total!=0){
					//echo '<center><a href="./compras/compras.php" class="aceptar">Comprar</a></center>';
			?>
			<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Formulario</title>
    <link rel="stylesheet" href="materialize.min.css">
</head>
<body>
   <div class="container">
       <div class="row">
                <h3>Formulario de Datos</h3>
	            <h6>Dejanos tus datos y te contactaremos a la brevedad para el envio de tus productos.<br><i>(da cliclk en eviar y despues en comprar )</i></h6>
	            <div class="col m12 s12">
	                <form action="" class="formulario">
	                    <div class="input-field col m6 s12">
                          <input id="nombre" name="nombre" type="text" class="validate" required>
                          <label for="nombre">Nombre</label>
                        </div>
                        <div class="input-field col m6 s12">
                            <input id='apellido'name='apellido' type="text" class="validate" required>
                            <label for="apellido">Apellido</label>
                        </div>
                        <div class="input-field col m6 s12">
                            <input id='email' name="email" type="email" class="validate" required>
                            <label for="email">Email</label>
                        </div>
                        <div class="input-field col m6 s12">
                            <input id='telefono' name="telefono" type="tel" pattern="[0-9]{10}" class="validate" required>
                            <label for="apellido">Telefono</label>
                        </div>
                        <div class="input-field col m12 s12">
                            <textarea id="mensaje" name="mensaje" class="materialize-textarea" data-length="240"></textarea>
                            <label for="textarea1">Direccion</label>
                        </div>
                        <input type="button" class="btn waves-effect  green accent-4" onclick="enviarFormulario()" onclick="enviarMail()" value="Enviar">
                        <p class="green-text" id="enviado"></p>
	                </form>
	            </div>
	        </div>
   </div> 
<script src="jquery-3.1.1.min.js"></script>
<script src="materialize.min.js"></script>
<script>
    function enviarFormulario(){
         var formData = new FormData($(".formulario")[0]);
            $.ajax({
            data: formData,
            url: 'mail.php',
            type: 'post',
            contentType: false,       // The content type used when sending data to the server.
            cache: false,             // To unable request pages to be cached
            processData:false,
            success: function(response){
                if(response){
                    $('#enviado').text(response);
                    $('#nombre').val('');
                    $('#apellido').val('');
                    $('#email').val('');
                    $('#telefono').val('');
                    $('#mensaje').val('');
                }else{
                   $('#enviado').text(response); 
                }
            }
        });
        
    }

    
</script>

<script src="jquery-3.1.1.min.js"></script>
<script src="materialize.min.js"></script>
<script>
    function enviarMail(){
         var formData = new FormData($(".formulario")[0]);
            $.ajax({
            data: formData,
            url: 'enviarMail.php',
            type: 'post',
            contentType: false,       // The content type used when sending data to the server.
            cache: false,             // To unable request pages to be cached
            processData:false,
            success: function(response){
                if(response){
                    $('#enviado').text(response);
                    $('#nombre').val('');
                    $('#apellido').val('');
                    $('#email').val('');
                    $('#telefono').val('');
                    $('#mensaje').val('');
                }else{
                   $('#enviado').text(response); 
                }
            }
        });
        
    }

    
</script>
				<form action="https://www.paypal.com/cgi-bin/webscr" method="post" id="formulario">
					<input type="hidden" name="cmd" value="_cart">
					<input type="hidden" name="upload" value="1">
					<input type="hidden" name="business" value="dulcelanderosuwu@gmail.com">
					<input type="hidden" name="currency_code" value="MXN">
					
					<?php 
						for($i=0;$i<count($datos);$i++){
					?>
						<input type="hidden" name="item_name_<?php echo $i+1;?>" value="<?php echo $datos[$i]['Nombre'];?>">
						<input type="hidden" name="amount_<?php echo $i+1;?>" value="<?php echo $datos[$i]['Precio'];?>">
						<input	type="hidden" name="quantity_<?php echo $i+1;?>" value="<?php echo $datos[$i]['Cantidad'];?>">	
					<?php 
						}
					?>
						

					<center><input type="submit" value="comprar" class="aceptar" style="width:200px"></center>
			</form>
			<?php
			}
			
		?>
		<center><a href="Productos.php">Ver catalogo</a></center>

		
	</section>
</body>
</html>