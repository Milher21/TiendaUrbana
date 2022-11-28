<?php
    require '../config/database.php';
    require '../config/config1.php';
    
    $db = new Conexion();
    $con = $db->pdo;

    $productos = isset($_SESSION['carrito']['productos']) ?$_SESSION['carrito']['productos']:null;
    $lista_carrito = array();

    if($productos!=null){
        foreach ($productos as $clave => $cantidad) {
            $sql = $con->prepare("SELECT *, $cantidad as cantidad FROM products WHERE id=? AND active=1 ORDER BY idCategory");
            $sql->execute([$clave]);
    //fetch devuelve las filas de la consulta PDO::FETCH_ASSOC etiqueta por el nombre de la columna
            $lista_carrito[] = $sql->fetch(PDO::FETCH_ASSOC);
        }
    }

    

    #session_destroy();
    #print_r($_SESSION);
?>

<?php include "../layouts/head.php"; ?>

<body>
<?php include "../layouts/navbar.php"; ?>
<main>
    <hr class="featurette-divider">
    <hr class="featurette-divider">
    <hr class="featurette-divider">
    <div class="container">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <th>Producto</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th>Subtotal</th>
                    <th></th>
                </thead>
                <tbody>
                    <?php if($lista_carrito==null){
                        echo '<tr><td colspan="5" class="text-center"><b>Sin productos</b></td></tr>';
                    }else {
                        $total = 0;
                        foreach ($lista_carrito as $producto) {
                            $_id = $producto['id'];
                            $nombre = $producto['name'];
                            $precio = $producto['price'];
                            $descuento = $producto['discount'];
                            $cantidad = $producto['cantidad'];
                            $precioF = $precio*(1-$descuento/100);
                            $subtotal = $precioF*$cantidad;
                            $total += $subtotal;
                    ?>
                    <tr>
                        <td><?php echo $nombre; ?></td>
                        <td><?php echo MONEDA.number_format($precioF, 2, '.', ','); ?></td>
                        <td>
                            <input type="number" name="" min="1" max="20" step="1" value="<?php echo $cantidad; ?>" size="5" id="cantidad_<?php echo $_id; ?>" onchange="actualizarCantidad(this.value, <?php echo $_id; ?>)">
                        </td>
                        <td>
                            <div id="subtotal_<?php echo $_id; ?>" name="subtotal[]"><?php echo MONEDA.number_format($subtotal, 2, '.', ','); ?>                                
                            </div>
                        </td>
                        <td>
                            <a href="#" id="eliminar" class="btn btn-warning btn-sm" data-bs-id="<?php echo $_id;?>" data-bs-toggle="modal" data-bs-target="#eliminaModal">Eliminar</a>
                        </td>                        
                    </tr>
                <?php   } ?>

                <tr>
                    <td colspan="3"></td>
                    <td colspan="2">
                        <p class="h3" id="total"><?php echo MONEDA.number_format($total, 2 , '.', ',');?></p>
                    </td>
                </tr>

                </tbody>
        <?php   } ?>
            </table>
        </div>
        <div class="row">
            <div class="col-md-5 offset-md-7 d-grid gap-2">
                <a href="pago.php" class="btn btn-primary btn-lg">Realizar pago</a>
            </div>
        </div>
    </div><!-- /.container -->
<!-- Button trigger modal -->
    <!-- Modal -->
    <div class="modal fade" id="eliminaModal" tabindex="-1" aria-labelledby="eliminaModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="eliminaModalLabel">Alerta</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ¿Está seguro de eliminar el producto?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button id="btn-elimina" type="button" class="btn btn-danger" onclick="eliminar()">Eliminar</button>
                </div>
            </div>
        </div>
    </div>

  <!-- FOOTER -->
    <?php include '../layouts/footer.php'; ?>
</main>
    
</body>
</html>