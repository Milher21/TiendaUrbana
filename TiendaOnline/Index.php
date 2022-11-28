<?php
require 'config/config.php';
include_once 'Modelo/Usuario.php';
$Listar =new Usuario();
$Listar->Listar_productos();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TIENDA ONLINE</title>
    <link rel="stylesheet" href="../css/estilocompra.css">
    <link rel="stylesheet" href="./css/estilos.css">
    <link rel="stylesheet" href="./css/style_principal.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
    <!-- slider -->
    <link rel="stylesheet" href="flexslider.css" type="text/css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<script src="js/jquery.flexslider.js"></script>
	<script type="text/javascript" charset="utf-8">
  $(window).load(function() {
    $('.flexslider').flexslider({
    	touch: true,
    	pauseOnAction: false,
    	pauseOnHover: false,
    });
  });
</script>
<!-- fin slider -->
<body>
    <header>
        <div class="superior">
            <div class="cont-logo">
                <img href="Index.html"src="./img/LOGO-TIENDA.png" alt="" class="Logo">
            </div>
            
            <div class="container">
                    <input type="text" class="buscar-texto" placeholder="Buscar">
                    <div class="btn-buscar">
                        <i > <img src="./img/icon-buscar.png" alt="" width="35px" class="buscar"></i>
                    </div>
            </div>
            <div class="cont-icon"> 
      
                <a href="./Vistas/Login.php" class="iniciar-sesion">
                    <img src="./img/perfil.png" alt="" width="60px">
                </a>  
    
                <a href="Vistas/checkuot.php" class="carrito">
                    <img src="./img/carrito-de-compras.png" alt="" width="60px">
                    <span id="num_cart" class="badge bg-secondary"><?php echo $num_cart; ?></span>
                </a>  
            </div>
            </div>
     
        <div class="nav">
            <label for="check" class="mostrar-menu">
                &#8801  
              </label>
            <input type="checkbox"  id="check">
            
            <nav class="menu">
                    <a href="Vistas/Zapatillas.php" >ZAPATILLAS</a>
                    <a href="Vistas/Jeans.php">JEANS</a>
                    <a href="Vistas/Polos.php">POLOS</a>
                    <a href="Vistas/Casacas.php">CASACAS</a>
                    <label for="check" class="esconder-menu">
                        &#215
                    </label>
                    </div>
            </nav>
        </div>
    </header>
    <body>
        <!-- PROMOCIONES -->
        <div class="flexslider">
            <ul class="slides">
                <li>
                    <img src="./img/PROMOCION/zaptilla_publicidad.jpg" alt="">
                    <section class="flex-caption">
                        <p></p>
                    </section>
                </li>
                <li>
                    <img src="./img/PROMOCION/zaptilla_publicidad.jpg" alt="">
                    <section class="flex-caption">
                        <p></p>
                    </section>
                </li>
                <li>
                    <img src="./img/PROMOCION/Pzaptilla_publicidad.jpg" alt="">
                    <section class="flex-caption">
                        <p></p>
                    </section>
                </li>
            </ul>
        </div>

        <h2 class="pmv">NUESTROS PRODUCTOS</h2>
        <main>
            <div class="container-pro">   
                <?php foreach( $Listar->productos as $row) {?>        
                        <div class="producto-detalle">
                        <?php if(($row['imagen_producto']==null)){
                            
                            ?> 
                            <img width="300px" height="300px" src="img/No_imagen.png" alt="">                           
                         <?php } else{?>  
                            <img width="300px" height="300px" src="data:image/jpeg;base64,<?php 
                            echo base64_encode( $row['imagen_producto'] ); ?>"/>     
                            <?php }?>   
                            <div class="producto-caracteristicas">
                                <h5 class="titulo-producto"><?php echo $row['nombre_producto']; ?></h5>
                                <p class="texto-producto"><?php 
                                echo 'S/.', $row['precio'] ?></p>
                                <div class="botones">
                                    <div class="btn-det">                                      
                                        <a href="Vistas/detalles.php?id_producto=<?php echo $row ['id_producto'];?>" class="btn_detalles">Detalles</a>
                                    </div>
                                    <div class="btn_car">
                                        <button class="btn_agregar" type="button" onclick="addProducto(<?php echo $row['id_producto']; ?>)">AGREGAR </button>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                        <?php }?>  
                    </div>
        </main>

        <script>
            function addProducto(id) {
                var url = 'Vistas/agregar.php';
                var formData = new FormData();
                formData.append('id', id);

                fetch(url, {
                    method: 'post',
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


        <h2 class="categorias_pro">NUESTRAS COLECCIONES</h2>
        <div class="colecciones">

            <div class="container-zapatillas-mas">           
                        <div class="cont_coleccion">
                            <h5 class="titulo-categoria">ZAPATILLAS</h5>
                            <img class="img_coleccion"  src="./img/img_colecciones/ZAPATILLAS_PORT.jpg" >
                            <div class="producto-caracteristicas">     
                                <div class="botones">
                                    <div class="btn-mas">                                      
                                        <a href="#" class="ver_mas">VER MÁS</a>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
            <div class="container-jeans-mas">           
                    <div class="cont_coleccion">
                        <h5 class="titulo-categoria">JEANS</h5>
                        <img class="img_coleccion" src="./img/img_colecciones/jeans_port.png" width="250px" height="300px">
                        <div class="producto-caracteristicas">     
                            <div class="botones">
                                <div class="btn-mas">                                      
                                    <a href="#" class="ver_mas">VER MÁS</a>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            <div  class="container-polos-mas">           
                        <div class="cont_coleccion">
                            <h5 class="titulo-categoria">POLOS</h5>
                            <img class="img_coleccion" src="./img/img_colecciones/polo_port.webp" width="250px" height="300px">
                            <div class="producto-caracteristicas">     
                                <div class="botones">
                                    <div class="btn-mas">                                      
                                        <a href="#" class="ver_mas">VER MÁS</a>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
            <div  class="container-poleras-mas">           
                    <div class="cont_coleccion">
                        <h5 class="titulo-categoria">POLERAS</h5>
                        <img class="img_coleccion" src="./img/img_colecciones/polera_port.webp" width="250px" height="300px">
                        <div class="producto-caracteristicas">     
                            <div class="botones">
                                <div class="btn-mas">                                      
                                    <a href="#" class="ver_mas">VER MÁS</a>
                                </div>
                                
                            </div>
                        </div>
                    </div>
            </div>
        
        </div>



    <!--::::Pie de Pagina::::::-->
    <footer class="pie-pagina">
        <div class="grupo-1">
            <div class="box">
                <figure>
                    <a href="#">
                        <img src="img/LOGO-TIENDA.png" alt="Logo de SLee Dw">
                    </a>
                </figure>
            </div>
            <div class="box">
                <h2>SOBRE NOSOTROS</h2>
                <p>Nuestra tienda online Gettho Style tiene todo lo que necesitas. Revisa todo nuestro catálogo de productos y llévate lo que te hace falta. Recuerda que llegamos a todas las provincias del Perú.
                <p>Aquí podrás encontrar las mejores prendas en una gran variedad de colores, tallas, materiales y formas. ¡No te quedes con las ganas!</p>
                <p>Aceptamos todos los medios de pago: tarjetas VISA, Mastercard, American Express, etc., así como pagos con billeteras digitales: Yape y Tunki. ¡Aprovecha las ofertas y promociones especiales y compra en línea</p>
                </p>

            </div>
            <div class="box">
                <h2>SIGUENOS</h2>
                <div class="red-social">
                   <a href="https://web.facebook.com/Gettho-STYLE-109221728661579"><img src="./img/facebook.png" width="50px" alt=""></a>
                    <a href="https://twitter.com/i/flow/login"><img src="./img/twiter.png" height="50px" alt=""></a>
                    <a href="https://web.whatsapp.com/"><img src="./img/whatsapp.png" height="50px"  alt=""></a>
                    <a href="https://drive.google.com/drive/folders/1EUhQEGyyqNGUsxnohl4989GhvfL2cIpH"><img src="./img/gmail.png" height="50px"  alt=""></a>
               
                </div>
            </div>
        </div>
        <div class="grupo-2">
            <small>&copy; 2022 <b>Gettho Style</b> - Todos los Derechos Reservados.</small>
        </div>
    </footer>
</body>
</html>