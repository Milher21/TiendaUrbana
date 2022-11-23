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
                $row = $sql->fetchAll(PDO::FETCH_ASSOC);

                $categoria = $row[0]['idcategory'];
                $nombre = $row[0]['name'];
                $detalles = $row[0]['details'];
                $precio = $row[0]['price'];
                $desc = $row[0]['discount'];
                $total = $precio*(1-$desc*0.01);
                $dirImg = "../img/productos/".$categoria."/";
                $imagen = $dirImg."principal.jpg"; 
                if(!file_exists($imagen)){
                        $imagen = "img/logos/no_imagen.jpg";
                }
            
        } else {
            echo "Error petición";
            exit;
        }
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
                <img src="<?php echo $imagen; ?>" width="350">
            </div>
            <div class="col-md-6 order-md-1">
                <h2><?php echo $nombre; ?></h2>
                <h2><?php echo MONEDA.number_format($precio, 2, '.', ','); ?></h2>
                <p class="lead"><?php echo $detalles; ?></p>
                <div class="d-grid gap-3 col-10 max-auto">
                    <button class="btn btn-primary" type="button">Comprar</button>
                    <button class="btn btn-outline-primary" type="button">Agregar</button>
            </div>                
            </div>
        </div>
    </div>
