<?php

 require '../config/config.php';
include_once '../Modelo/Usuario.php';
$id=$_GET['id_producto'];
echo $id;
$detalle =new Usuario();
$detalle->detalles($id);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DETALLES</title>
    <link rel="stylesheet" href="../css/estilos.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
    <link rel="stylesheet" href="../css/style_principal.css">
    <link rel="stylesheet" type="" href="../css/detalle.css">
    <!-- slider -->
    <link rel="stylesheet" href="flexslider.css" type="text/css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<script src="js/jquery.flexslider.js"></script>
    <script src="js/jquery-3.2.1.js"></script>
	<script src="js/script.js"></script>
	<script type="text/javascript" charset="utf-8">
</script>

<body>
    <header>
        <div class="superior">
            <div class="cont-logo">
                <img href="Index.html"src="../img/LOGO-TIENDA.png" alt="" class="Logo">
            </div>
            
            <div class="cont-icon"> 
      
                <a href="checkuot.php" class="iniciar-sesion">
                    <img src="../img/carrito-de-compras.png" alt="" width="60px"  >
                    <span id="num_cart" class="badge bg-secondary"><?php echo $num_cart; ?></span>
                </a>  
    
            </div>
        </div>
     
        <div class="nav">
            <label for="check" class="mostrar-menu">
              </label>
            <input type="checkbox"  id="check">
            
            <nav class="menu">
                    <a href="../Index.php">INICIO</a>
                    <a href="../Vistas/Zapatillas.php">ZAPATILLAS</a>
                    <a href="../Vistas/Jeans.php">JEANS</a>
                    <a href="../Vistas/Polos.php">POLOS</a>
                    <a href="../Vistas/Casacas.php">CASACAS</a>
                    <label for="check" class="esconder-menu">
                    
                    </label>
            </nav>
        </div>
    </header>
    <body>

        <h2 class="pmv1">DETALLES</h2>
        
        <div class="cont_detalle">   
                <?php foreach( $detalle ->detalle as $row) {?>        
                        <div class="img_detalle">
                        <?php if(($row['imagen_producto']==null)){
                        
                            ?> 
                            <img class="img_det" width="300px" height="300px" src="img/No_imagen.png" alt="">                           
                         <?php } else{?>  
                            <img class="img_det" width="300px" height="300px" src="data:image/jpeg;base64,<?php 
                            echo base64_encode( $row['imagen_producto'] ); ?>"/>     
                            <?php }?> 
                         </div>
                                <div class="det_descrip" >
                                <h1 class="nom_det" ><?php echo $row['nombre_producto']; ?></h1>
                                <h5 class="descrip" ><?php echo $row['detalle']; ?></h5>
                                <h2 class="talla" >TALLAS</h2>
                                <h5 class="talla" ><?php echo $row['talla']; ?></h5>
                                <p class="precio"><?php 

                                    echo 'S/.', $row['precio'] ?></p>
                    
                                   <div class="btn_car"> 
                                        <button class="btn_agregar_car" type="button" onclick="addProducto(<?php echo $id; ?>)">AGREGAR AL CARRITO</button>
                                    </div>
                                
                                </div>
                        </div>
                        <?php }?>  
                    </div>
                    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
	
                    <script>
        function addProducto(id) {
				var url = 'agregar.php';
				var formData = new FormData();
				formData.append('id', id);
				
				fetch(url, {
					method: 'POST',
					body: formData,
					mode: 'cors',
				}).then(response => response.json())
				.then(data => {
					if (data.ok) {
						let elemento = document.getElementById("num_cart")
						elemento.innerHTML = data.numero;
					}
				})
				
		}
	</script>

        </main>
       
    <!--::::Pie de Pagina::::::-->
    <footer class="pie-pagina">
        <div class="grupo-1">
            <div class="box">
                <figure>
                    <a href="#">
                        <img src="../img/LOGO-TIENDA.png" alt="Logo de SLee Dw">
                    </a>
                </figure>
            </div>
            <div class="box">
            <h2>SOBRE NOSOTROS</h2>
                <p>Nuestra tienda online Gettho Style tiene todo lo que necesitas. Revisa todo nuestro cat??logo de productos y ll??vate lo que te hace falta. Recuerda que llegamos a todas las provincias del Per??.
                <p>Aqu?? podr??s encontrar las mejores prendas en una gran variedad de colores, tallas, materiales y formas. ??No te quedes con las ganas!</p>
                <p>Aceptamos todos los medios de pago: tarjetas VISA, Mastercard, American Express, etc., as?? como pagos con billeteras digitales: Yape y Tunki. ??Aprovecha las ofertas y promociones especiales y compra en l??nea</p>
                </p>

            </div>
            <div class="box">
                <h2>SIGUENOS</h2>
                <div class="red-social">
                    <a href="https://web.facebook.com/Gettho-STYLE-109221728661579"><img src="../img/facebook.png" width="50px" alt=""></a>
                    <a href="https://twitter.com/i/flow/login"><img src="../img/twiter.png" height="50px" alt=""></a>
                    <a href="https://web.whatsapp.com/"><img src="../img/whatsapp.png" height="50px"  alt=""></a>
                    <a href="https://mail.google.com/"><img src="../img/gmail.png" height="50px"  alt=""></a>
                </div>
            </div>
        </div>
        <div class="grupo-2">
        <small>&copy; 2022 <b>Gettho Style</b> - Todos los Derechos Reservados.</small>
        </div>
    </footer>
</body>
</html>
