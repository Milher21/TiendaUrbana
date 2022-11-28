<?php
    require '../config/database.php';
    require '../config/config1.php';
    
    $db = new Conexion();
    $con = $db->pdo;

    $id = isset($_GET['id']) ? $_GET['id'] : '';
    $token = isset($_GET['token']) ? $_GET['token'] : '';
    if ($id==''||$token=='') {
        echo "Error petición";
        exit;
    } else {
        $token_tmp = hash_hmac('sha1', $id, KEY_TOKEN);
        if ($token == $token_tmp) {
            $sql = $con->prepare("SELECT count(id) FROM products WHERE id=? AND active=1");
            $sql->execute([$id]);
            
            if ($sql->fetchColumn()>0) {
                $sql = $con->prepare("SELECT * FROM products WHERE id=? AND active=1 LIMIT 1");
                $sql->execute([$id]);
                $row = $sql->fetch(PDO::FETCH_ASSOC);

                $categoria = $row['idcategory'];
                $nombre = $row['name'];
                $detalles = $row['details'];
                $precio = $row['price'];
                $desc = $row['discount'];
                $total = $precio*(1-$desc*0.01);
                $dirImg = "../img/productos/".$categoria."/".$nombre."/";
                $imagenP = $dirImg.'principal.jpg';
                $imagenes = array();

                if(!file_exists($imagenP)){
                    $imagenP = "../img/logos/no_imagen.jpg";
                }else{

                    

                    if (file_exists($dirImg)) {
                        $dir = dir($dirImg);

                        while (($archivo=$dir->read())!= false) {
                            if (($archivo!='principal.jpg')&&(strpos($archivo, 'jpg')||strpos($archivo, 'jpeg'))) {
                                $imagenes[] = $dirImg.$archivo; 
                            }
                        }
                        $dir->close();
                    }
            }
            } else {
                echo "Error petición";
                exit;
            }
        } else {
            echo "Error petición";
            exit;
        }
    }
?>


<?php include "../layouts/head.php"; ?>
<?php include "../layouts/navbar.php"; ?>

<hr class="featurette-divider">
<hr class="featurette-divider">
<hr class="featurette-divider">

    <div class="container">
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">           
            <div class="col-md-6 order-md-1">

                <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="<?php echo $imagenP; ?>" class="d-block w-100" alt="...">
                        </div>
                    <?php foreach ($imagenes as $imagen) { ?>
                        <div class="carousel-item">
                            <img src="<?php echo $imagen; ?>" class="d-block w-100" alt="...">
                        </div>                        
                    <?php } ?>    
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>

            </div>
            <div class="col-md-6 order-md-1">
                <h2><?php echo $nombre; ?></h2>

            <?php if ($desc>0) { ?>
               <p><del><?php echo MONEDA.number_format($precio, 2, '.', ','); ?></del></p>
                <h2>
                    <?php echo MONEDA.number_format($total, 2, '.', ','); ?>
                    <small class="text-success"><?php echo $desc; ?>% descuento</small> 
                </h2>
            <?php  } else { ?>
                <h2><?php echo MONEDA.number_format($precio, 2, '.', ','); ?></h2>
            <?php  } ?>
                <p class="lead"><?php echo $detalles; ?></p>
                <div class="d-grid gap-3 col-10 max-auto">
                    <button class="btn btn-primary" type="button">Comprar</button>
                    <button class="btn btn-outline-primary" type="button" onclick="agregarCarrito(<?php echo $id; ?>, '<?php echo $token_tmp; ?>')">Agregar</button>
            </div>                
            </div>
        </div>
    </div>

<?php include "../layouts/footer.php"; ?>
