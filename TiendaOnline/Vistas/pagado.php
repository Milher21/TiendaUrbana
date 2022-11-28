<?php
    require '../config/config.php';
    require '../Modelo/database.php';
    $db = new Database();
    $con = $db->conectar();

    $id_trade = isset($_GET['key']) ? $_GET['key'] : 0 ;

    $err = '';

    if ($id_trade == 0 || $id_trade == '') {
    	$err = 'Error de compra';
    }else{
    	$sql = $con->prepare("SELECT count(id) FROM ropaurbana.compra WHERE id_trade=? AND status=?");
         $sql->execute([$id_trade, 'COMPLETED']);
            
        if ($sql->fetchColumn()>0) {
            $sql = $con->prepare("SELECT * FROM ropaurbana.compra WHERE id_trade=? AND status=? LIMIT 1");
            $sql->execute([$id_trade, 'COMPLETED']);
            $row = $sql->fetch(PDO::FETCH_ASSOC);

            $idCompra = $row['id'];
            $total = $row['total'];
            $fecha = $row['date'];

            $sql_detalle = $con->prepare("SELECT * FROM ropaurbana.detalles_compra WHERE id_compra=?");
            $sql_detalle->execute([$idCompra]);
            
        }else{
        	$err = 'Error al relacionar compra con detalle de compra';
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Compra</title>
    <link rel="stylesheet" href="../css/estilos.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
    <link rel="stylesheet" href="../css/style_principal.css">
    
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
		<link href="css/all.min.css" rel="stylesheet">
    <!-- slider -->
    <link rel="stylesheet" href="flexslider.css" type="text/css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<script src="js/jquery.flexslider.js"></script>
    <script src="js/jquery-3.2.1.js"></script>
	<script src="js/script.js"></script>
</head>
    <header>
        <div class="superior">
            <div class="cont-logo">
                <img href="Index.html"src="../img/LOGO-TIENDA.png" alt="" class="Logo">
            </div>
            
            <div class="cont-icon"> 
                 <a href="Login.php" class="iniciar-sesion">
                    <img src="../img/perfil.png" alt="" width="60px">
                </a> 

				<a href="checkuot.php" class="carrito">
                    <img src="../img/carrito-de-compras.png" alt="" width="60px">
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
	<main>
			<?php 
				if (strlen($err>0)) {
			?>	
			<div class="row">
				<div class="col">
					<h4><?php echo $err;?></h4>
				</div>
			</div>	
			<?php
				}else{
			?>
		    <div class="row">
				<div class="col">
					<b>Compra ID#</b><?php echo $id_trade;?><br>
					<b>Fecha de compra:</b><?php echo $fecha;?><br>
					<b>Total de compra:</b><?php echo number_format($total, 2, '.', ',');?><br>
				</div>
			</div>

			<div class="row">
				<div class="col">
			        <table class="table">
			            <thead>
			                <tr>
			                    <th>Cantidad</th>
			                    <th>Producto</th>
			                    <th>Importe</th>
			                </tr>
			            </thead>
			            <tbody>
			            	<?php while ($row_det = $sql_detalle->fetch(PDO::FETCH_ASSOC)){ 
			                	$importe = $row_det['cantidad']*$row_det['precio']; 
			                ?>
			                	<tr>
			                		<td><?php echo $row_det['cantidad']; ?></td>
			                		<td><?php echo $row_det['nombre']; ?></td>
			                		<td><?php echo $importe; ?></td>
			                	</tr>
			                <?php } ?>
			            </tbody>
			         </table>
			    </div>
			</div>
		    <?php
				}
			?>
	</main>
    <!--::::Pie de Pagina::::::-->
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
                <p>Nuestra tienda online Gettho Style tiene todo lo que necesitas. Revisa todo nuestro catálogo de productos y llévate lo que te hace falta. Recuerda que llegamos a todas las provincias del Perú.
                <p>Aquí podrás encontrar las mejores prendas en una gran variedad de colores, tallas, materiales y formas. ¡No te quedes con las ganas!</p>
                <p>Aceptamos todos los medios de pago: tarjetas VISA, Mastercard, American Express, etc., así como pagos con billeteras digitales: Yape y Tunki. ¡Aprovecha las ofertas y promociones especiales y compra en línea</p>
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