
    <div class="container">
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">            
<?php       foreach ($resultados as $row) { ?>
            <div class="col">
                <div class="card shadow-sm">
                    <?php   
                    $id = $row['id'];
                    $categoria = $row['idcategory'];
                    $nombre = $row['name'];
                    $detalles = $row['details'];
                    $precio = $row['price'];

                    $imagen = "../img/productos/".$categoria."/".$nombre."/principal.jpg";

                    if(!file_exists($imagen)){
                        $imagen = "../img/logos/no_imagen.jpg";
                    }

                    ?>
                    <img class="bd-placeholder-img rounder-circle" class="d-block w-100" width="100" src="<?php echo $imagen ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $nombre ?></h5>
                        <p class="card-text"><?php echo number_format($precio, 2, '.', ',') ?></p>
                        <div class="d-flex justify-content-between align-items-center">                        
                            <a href="detalles.php?id=<?php echo $id; ?>&token=<?php echo hash_hmac('sha1', $id, KEY_TOKEN) ?>" class="btn btn-primary">Detalles</a>
                            <button class="btn btn-outline-success" type="button" onclick="agregarCarrito(<?php echo $id; ?>, '<?php echo hash_hmac('sha1', $id, KEY_TOKEN) ?>')">Agregar</button>                        
                        </div>
                    </div>
                </div>
            </div>
<?php       } ?>
        </div>
    </div>
    <script>
    function agregarCarrito(id, token){
        let url = 'clases/carrito.php';
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