<?php
require '../config/config.php';
require '../Modelo/database.php';
$db = new Database();
$con = $db->conectar();
//include_once '../Vistas/producto.php';
// $id=$_GET['id_producto'];
// echo $id;

// $detalle->detalles($id);

$productos = isset($_SESSION['carrito']['producto']) ? $_SESSION['carrito']['producto'] : null;

$lista_carrito = array();
if($productos != null){
    foreach ($productos as $clave => $cantidad) {
        $sql = $con-> prepare("SELECT id_producto, nombre_producto, precio, $cantidad AS cantidad  FROM ropaurbana.productos where  id_producto=? and activo=1");
           
            $sql->execute(([$clave]));
        $lista_carrito[] = $sql->fetch(PDO::FETCH_ASSOC);
           //return $this->$lista_carrito;
    }

}
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
<body>
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
        <h2 class="pmv">DETALLES</h2>
        <br>
        <main>
        <div class="table-responsive">
					<table class="table">
						<thead>
							<tr>
								<th>Producto</th>
								<th>Precio</th>
								<th>Cantidad</th>
								<th>Subtotal</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
						<?php if($lista_carrito == null){
							echo '<tr><td colspan= "5" class="text-center"><b>lista vacia</b><td></tr>';
						} else {
							$total = 0;
							foreach ($lista_carrito as $productos) {
							    $_id = $productos['id_producto'];
							    $_nombre =$productos['nombre_producto'];
							    $_precio =$productos['precio'];
							    $cantidad = $productos['cantidad'];
							    $_subtotal =$cantidad*$_precio;
								$total +=$_subtotal;
								?>
							
						<tr>
	                        <td><?php echo $_nombre; ?></td>
	                        <td><?php echo $_precio; ?></td>
	                        <td>
	                            <input type="number" name="" min="1" max="20" step="1" value="<?php echo $cantidad; ?>" size="5" id="cantidad_<?php echo $_id; ?>" onchange="actualizarCantidad(this.value, <?php echo $_id; ?>)">
	                        </td>
	                        <td>
	                            <div id="subtotal_<?php echo $_id; ?>" name="subtotal[]">
	                            	<?php echo $_subtotal; ?>                               
	                            </div>
	                        </td>
	                        <td>
	                            <a href="#" id="eliminar" class="btn btn-warning btn-sm" data-bs-id="<?php echo $_id;?>" data-bs-toggle="modal" data-bs-target="#eliminaModal">Eliminar</a>
	                        </td>                        
                    	</tr>
                    	<?php   } ?>
						<tr>
							<td colspan= "3"></td>
							<td colspan= "2">
								<p class="h3" id="total"><?php echo'Total'.'  '.'s/.  '.number_format($total,2,'.','.'); ?></p>
							</td>
						</tr>
						
						</tbody> <?php } ?>
					</table>
				</div>
				
				<div class="row">
					<div class="col-md-5 offset-md-7 d-grid gap-2">
						<a href="pago.php"class="btn btn-primary btn-lg">REALIZAR PAGO</a>
				</div>
							</div>
		
		<div class="modal fade" id="eliminaModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-sm">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Alerta</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						¿Desea eliminar el producto de la lista?
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
						<button id="btn-elimina" class="btn btn-danger" onclick="elimina()">Eliminar</button>
					</div>
				</div>
			</div>
		</div>
		
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
		
		
		<script>
			let eliminaModal = document.getElementById('eliminaModal')
			eliminaModal.addEventListener('show.bs.modal', function(event) {
				// Button that triggered the modal
				let button = event.relatedTarget
				// Extract info from data-bs-* attributes
				let recipient = button.getAttribute('data-bs-id')
				let botonElimina = eliminaModal.querySelector('.modal-footer #btn-elimina')
				botonElimina.value = recipient
			})
			
			function actualizarCantidad(cantidad, id) {
				
				if(!isNaN(cantidad) && cantidad > 0){
					
					let url = 'carrito1.php';
					let formData = new FormData();
					formData.append('action', 'agregar');
					formData.append('id', id);
					formData.append('cantidad', cantidad);
					
					fetch(url, {
						method: 'POST',
						body: formData,
						mode: 'cors',
					}).then(response => response.json())
					.then(data => {
						if (data.ok) {
							let divSubtotal = document.getElementById('subtotal_' + id)
							divSubtotal.innerHTML = data.sub
							
							let total = 0.00
							let list = document.getElementsByName('subtotal[]')
							
							for (var i = 0; i < list.length; ++i) {
								total += parseFloat(list[i].innerHTML.replace(/[$,]/g, ''))
							}
							
							total = new Intl.NumberFormat('en-US', {
								minimumFractionDigits: 2
							}).format(total)
							document.getElementById("total").innerHTML = '$' + total
						}
					})
				}
			}
			
			function elimina() {
				let botonElimina = document.getElementById('btn-elimina')
				let recipient = botonElimina.value
				
				let url = 'carrito1.php';
				let formData = new FormData();
				formData.append('action', 'eliminar');
				formData.append('id', recipient);
				
				fetch(url, {
                    method: 'POST',
					body: formData,
					mode: 'cors',
				}).then(response => response.json())
				.then(data => {
					if (data.ok) {
						location.reload();
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
