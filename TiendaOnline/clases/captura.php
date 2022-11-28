<?php
    require '../config/config.php';
    require '../Modelo/database.php';
    $db = new Database();
    $con = $db->conectar();

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

    	$sql_compra = $con->prepare("INSERT INTO ropaurbana.compra (id_trade, date, status, email, id_cliente, total) values (?,?,?,?,?,?)");
    	$sql_compra->execute([$id_trade, $fecha_format, $status, $email, $idCliente, $total]);
    	$id = $con->lastInsertId();

    	if ($id>0) {
    		$productos = isset($_SESSION['carrito']['producto']) ?$_SESSION['carrito']['producto']:null;

    		if($productos!=null){
        		foreach ($productos as $clave => $cantidad) {
            		$sql_compra = $con->prepare("SELECT * FROM ropaurbana.productos WHERE id_producto=? AND activo=1");
            		$sql_compra->execute([$clave]);
    				//fetch devuelve las filas de la consulta PDO::FETCH_ASSOC etiqueta por el nombre de la columna
            		$row_producto = $sql_compra->fetch(PDO::FETCH_ASSOC);

            		$precio = $row_producto['precio'];

                    $sql_detalle = $con->prepare("INSERT INTO ropaurbana.detalles_compra (id_compra, id_producto, nombre, precio, cantidad) values (?,?,?,?,?)");
    				$sql_detalle->execute([$id, $clave, $row_producto['nombre_producto'], $precio, $cantidad]);
        		}
                include '../clases/enviar_email.php';
    		}
    		unset($_SESSION['carrito']);
    	}
    }

?>