        <hr class="featurette-divider">
        
<footer class="sticky-footer bg-white">
	<div class="container my-auto">
		 <div class="copyright text-center my-auto">
            <span>Copyright &copy; Your Website 2022</span>
        </div>

        <p class="float-end"><a href="#">Back to top</a></p>
        <p>&copy; 2017–2022 Company, Inc. &middot; <a href="#">Privacy</a> &middot; <a href="#">Terms</a></p>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>

<script>
	function agregarCarrito(id, token){
		let url = '../clases/carrito.php';
		let formData = new FormData();
		formData.append('id', id);
		formData.append('token', token);

		fetch(url, {
			method: 'POST',
			body: formData,
			mode: 'cors'			
		}).then(response => response.json())
		.then(data => {
			if (data.ok) {
				let elemento = document.getElementById("num_carrito");
				elemento.innerHTML = data.numero;
			}
		})
	}
</script>

<script>

	let eliminaModal = document.getElementById('eliminaModal');
	eliminaModal.addEventListener('show.bs.modal', function(event){
		let button = event.relatedTarget;
		let id = button.getAttribute('data-bs-id');
		let buttonElimina = eliminaModal.querySelector('.modal-footer #btn-elimina');
		buttonElimina.value = id;
	})

	function actualizarCantidad(cantidad, id){
		let url = '../clases/actualizar_carrito.php';
		let formData = new FormData();
		formData.append('action', 'agregar');
		formData.append('id', id);
		formData.append('cantidad', cantidad);

		fetch(url, {
			method: 'POST',
			body: formData,
			mode: 'cors'			
		}).then(response => response.json())
		.then(data => {
			if (data.ok) {
				let divsubtotal = document.getElementById('subtotal_' + id);
				divsubtotal.innerHTML = data.sub;

				let total = 0.00
				let list = document.getElementsByName('subtotal[]')
							
				for (var i = 0; i < list.length; ++i) {
					total += parseFloat(list[i].innerHTML.replace(/[S/,]/g, ''))
				}
							
				total = new Intl.NumberFormat('en-US', {
					minimumFractionDigits: 2
				}).format(total)
				document.getElementById("total").innerHTML = '<?php echo MONEDA; ?>' + total
			}
		})
	}

	function eliminar() {
		let botonElimina = document.getElementById('btn-elimina')
		let id = botonElimina.value

		let url = '../clases/actualizar_carrito.php';
		let formData = new FormData();
		formData.append('action', 'eliminar');
		formData.append('id', id);
				
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

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

 <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">¿Desea cerrar sesión?</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Selecciona el botón cerrar sessión para salir de su cuenta.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <a href="vistas/logout.php" class="btn btn-primary">Cerrar Sesión</a>
      </div>
    </div>
  </div>
</div>