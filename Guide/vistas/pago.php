<?php
    require '../config/database.php';
    require '../config/config1.php';
    
    $db = new Conexion();
    $con = $db->pdo;

    $total = 0;
    $productos = isset($_SESSION['carrito']['productos']) ?$_SESSION['carrito']['productos']:null;
    $lista_carrito = array();

    if($productos!=null){
        foreach ($productos as $clave => $cantidad) {
            $sql = $con->prepare("SELECT *, $cantidad as cantidad FROM products WHERE id=? AND active=1 ORDER BY idCategory");
            $sql->execute([$clave]);
    //fetch devuelve las filas de la consulta PDO::FETCH_ASSOC etiqueta por el nombre de la columna
            $lista_carrito[] = $sql->fetch(PDO::FETCH_ASSOC);
        }
    }else {
        header("location : index.php");
        exit;
    }
?>

<?php include "../layouts/head.php"; ?>

<body>
<?php include "../layouts/navbar.php"; ?>
<main>
    <hr class="featurette-divider">
    <hr class="featurette-divider">
    <hr class="featurette-divider">

    <div class="container">
        <div class="row">      
            <div class="col-6">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <th>Producto</th>
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
                                <td>
                                    <div id="subtotal_<?php echo $_id; ?>" name="subtotal[]"><?php echo MONEDA.number_format($subtotal, 2, '.', ','); ?>                                
                                    </div>
                                </td>                        
                            </tr>
                        <?php   } ?>

                        <tr>
                            <td colspan="2">
                                <p class="h3 text-end" id="total"><?php echo MONEDA.number_format($total, 2 , '.', ',');?></p>
                            </td>
                        </tr>

                        </tbody>
                <?php   } $total = number_format($total, 2 , '.', ','); ?>
                    </table>
                </div>
            </div>
            <div class="col-6">
                <h4>Pagar</h4>
                <div id="paypal-button-container"></div>
            </div>
        </div>
    </div>

    <!-- /.container -->
<!-- Replace "test" with your own sandbox Business account app client ID -->
     <script src="https://www.paypal.com/sdk/js?client-id=AUrzZ3_-ohWTf6GQNoJJM5V_ssU-T-MvIGzX-IeS5ySX9Ld0xqo6S--k-9nVyTbq7R0fwbisLCi5_BhA&currency=USD"></script>
    <!-- Set up a container element for the button -->
    

    <script>

    paypal.Buttons({
        //Styles
        style:{
            /*Here code button's style*/
        },
        // Sets up the transaction when a payment button is clicked
        createOrder: (data, actions) => {
          return actions.order.create({
            purchase_units: [{
              amount: {
                value: '<?php echo $total; ?>' // Can also reference a variable or function
              }
            }]
          });
        },
        // Finalize the transaction after payer approval
        onApprove: (data, actions) => {
            let URL = '../clases/captura.php';

            actions.order.capture().then(function(orderData) {

            let url = '../clases/captura.php';

            return fetch(url, {
                method: 'post',
                header: {
                    'content-type': 'application/json' 
                },
                body: JSON.stringify({
                    orderData: orderData
                }) 
            }).then(function(response){
                window.location.href = 'pagado.php?key=' + orderData['id']; //$id_trade = $datos['orderData']['id'];
            })
            //windows.location.href = "pagado.php";
            // When ready to go live, remove the alert and show a success message within this page. For example:
            // const element = document.getElementById('paypal-button-container');
            // element.innerHTML = '<h3>Thank you for your payment!</h3>';
            // Or go to another URL:  actions.redirect('thank_you.html');
          });
        },
        onCancel: (data)=>{
            alert("¡Pago no realizado!");
            console.log(data);
        }
    }).render('#paypal-button-container');
    </script>
  <!-- FOOTER php include '../layouts/footer.php'-->
    
         <!-- Replace "test" with your own sandbox Business account app client ID -->

</main>
    
</body>
</html>