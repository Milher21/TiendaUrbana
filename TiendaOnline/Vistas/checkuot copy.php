<!DOCTYPE html>
<html lang="es">
	
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Tienda en linea - DEMO</title>
		
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
		<link href="css/all.min.css" rel="stylesheet">
		<link href="css/estilos.css" rel="stylesheet">
	<script type="text/javascript" src="https://me.kis.v2.scr.kaspersky-labs.com/FD126C42-EBFA-4E12-B309-BB3FDD723AC1/main.js?attr=zOiOj8bsfacJeaxNkn5znKt3tjMRlRMHpi-aPeNVrzdjZQRbQIGZCZEAqlmsrLHnK1CuYojh60Uei7G1RcAfRx6ZGbjR0_RZYo-dMFdXlwc" charset="UTF-8"></script><link rel="stylesheet" crossorigin="anonymous" href="https://me.kis.v2.scr.kaspersky-labs.com/E3E8934C-235A-4B0E-825A-35A08381A191/abn/main.css?attr=aHR0cHM6Ly9zaXN0ZW1hcnYuY29tL2RlbW8vdGllbmRhX29ubGluZS9jaGVja291dC5waHA"/></head>
	
	<body>
		
		<header>
			<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
				<div class="container">
					<a class="navbar-brand" href="index.php">Tienda online</a>
					<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navBarTop" aria-controls="navBarTop" aria-expanded="false">
						<span class="navbar-toggler-icon"></span>
					</button>
					
					<div class="collapse navbar-collapse" id="navBarTop">
						<ul class="navbar-nav me-auto mb-2 mb-lg-0">
							<li class="nav-item">
								<a class="nav-link active" href="index.php">Catálogo</a>
							</li>
							
							<li class="nav-item">
								<a class="nav-link" href="https://codigosdeprogramacion.com/contacto" target="_blank">Contacto</a>
							</li>
						</ul>
						
						<a class="btn btn-success me-3" href="https://store.codigosdeprogramacion.com/details.php?id=18" target="_blank">
							<i class="fas fa-arrow-circle-down"></i> Descarga proyecto
						</a>
					</div>
				</div>
			</nav>
		</header>
		
		<main>
			<div class="container">
				
				<div class="row">
					<div class="col">
						<div class="alert alert-danger" role="alert">
							<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
								<path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
							</svg>
							Esta tienda online es sólo de demostración.
							<strong>No introduzcas datos personales.</strong>
						</div>
					</div>
				</div>
				
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
							<tr><td colspan="5" class="text-center"><b>Lista vacia</b></td></tr>							
						</tbody>
					</table>
				</div>
				
				<!--<div class="row justify-content-end">-->
							</div>
		</main>
		
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
			
			function actualizaCantidad(cantidad, id) {
				
				if(!isNaN(cantidad) && cantidad > 0){
					
					let url = 'clases/actualizar_carrito.php';
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
				
				let url = 'clases/actualizar_carrito.php';
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
				$('#eliminaModal').modal('hide')
			}
		</script>
		
	</body>
	
</html>