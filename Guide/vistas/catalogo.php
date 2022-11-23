
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

                    $imagen = "img/productos/".$categoria."/principal.jpg";

                    if(!file_exists($imagen)){
                        $imagen = "img/logos/no_imagen.jpg";
                    }

                    ?>
                    <img width="140" height="180" src="<?php echo $imagen ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $nombre ?></h5>
                        <p class="card-text"><?php echo number_format($precio, 2, '.', ',') ?></p>
                        <div class="d-flex justify-content-between align-items-center">                        
                            <a href="vistas/detalles.php?id=<?php echo $id; ?>&token=<?php echo hash_hmac('sha1', $id, KEY_TOKEN) ?>" class="btn btn-primary">Detalles</a>
                            <a href="#" class="btn btn-success">Agregar</a>                        
                        </div>
                    </div>
                </div>
            </div>
<?php       } ?>
        </div>
    </div>
