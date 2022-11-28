<?php 
	require '../config/database.php';
    require '../config/config1.php';
    
    $db = new Conexion();
    $con = $db->pdo;

    $json = file_get_contents('php://input');
    $datos = json_decode($json, true);


    if(is_array($datos)){
    	$id_trade = $datos['orderData']['id'];
    	$total = $datos['orderData']['purchase_units'][0]['amount']['value'];
    	$status = $datos['orderData']['status'];
    	$fecha = $datos['orderData']['update_time'];
    	$fecha_format = date('Y-m-d H:i:s', strtotime($fecha));
    	$email = $datos['orderData']['payer']['email_address'];
    	$idCliente = $datos['orderData']['payer']['payer_id'];

    	$sql_compra = $con->prepare("INSERT INTO compra (id_trade, date, status, email, id_cliente, total) values (?,?,?,?,?,?)");
    	$sql_compra->execute([$id_trade, $fecha_format, $status, $email, $idCliente, $total]);
    	$id = $con->lastInsertId();

    	if ($id>0) {
    		$productos = isset($_SESSION['carrito']['productos']) ?$_SESSION['carrito']['productos']:null;

    		if($productos!=null){
        		foreach ($productos as $clave => $cantidad) {
            		$sql_compra = $con->prepare("SELECT * FROM products WHERE id=? AND active=1");
            		$sql_compra->execute([$clave]);
    				//fetch devuelve las filas de la consulta PDO::FETCH_ASSOC etiqueta por el nombre de la columna
            		$row_producto = $sql_compra->fetch(PDO::FETCH_ASSOC);

            		$precio = $row_producto['price'];
            		$descuento = $row_producto['discount'];
                    $precioF = $precio*(1-$descuento/100);

                    $sql_detalle = $con->prepare("INSERT INTO detalles_compra (id_compra, id_producto, nombre, precio, cantidad) values (?,?,?,?,?)");
    				$sql_detalle->execute([$id, $clave, $row_producto['name'], $precioF, $cantidad]);
        		}
                include '../clases/enviar_email.php';
    		}
    		unset($_SESSION['carrito']);
    	}
    }

?>