<?php
    require '../config/database.php';
    require '../config/config1.php';
    
    $db = new Conexion();
    $con = $db->pdo;

    $id_trade = isset($_GET['key']) ? $_GET['key'] : 0 ;

    $err = '';

    if ($id_trade == 0 || $id_trade == '') {
    	$err = 'Error de compra';
    }else{
    	$sql = $con->prepare("SELECT count(id) FROM compra WHERE id_trade=? AND status=?");
         $sql->execute([$id_trade, 'COMPLETED']);
            
        if ($sql->fetchColumn()>0) {
            $sql = $con->prepare("SELECT * FROM compra WHERE id_trade=? AND status=? LIMIT 1");
            $sql->execute([$id_trade, 'COMPLETED']);
            $row = $sql->fetch(PDO::FETCH_ASSOC);

            $idCompra = $row['id'];
            $total = $row['total'];
            $fecha = $row['date'];

            $sql_detalle = $con->prepare("SELECT * FROM detalles_compra WHERE id_compra=?");
            $sql_detalle->execute([$idCompra]);
            
        }else{
        	$err = 'Error al relacionar compra con detalle de compra';
        }
    }

    include "../layouts/head.php";
    include "../layouts/navbar.php";
?>
	<main>
		<div class="container">
			<?php 
				if (strlen($err>0)) {
			?>	
			<div class="row">
				<div class="col">
					<h4><?php echo $err;?></h4>
				</div>
			</div>	
			<?php
				}else{
			?>
		    <div class="row">
				<div class="col">
					<b>Compra ID#</b><?php echo $id_trade;?><br>
					<b>Fecha de compra:</b><?php echo $fecha;?><br>
					<b>Total de compra:</b><?php echo MONEDA.number_format($total, 2, '.', ',');?><br>
				</div>
			</div>

			<div class="row">
				<div class="col">
			        <table class="table">
			            <thead>
			                <tr>
			                    <th>Cantidad</th>
			                    <th>Producto</th>
			                    <th>Importe</th>
			                </tr>
			            </thead>
			            <tbody>
			            	<?php while ($row_det = $sql_detalle->fetch(PDO::FETCH_ASSOC)){ 
			                	$importe = $row_det['cantidad']*$row_det['precio']; 
			                ?>
			                	<tr>
			                		<td><?php echo $row_det['cantidad']; ?></td>
			                		<td><?php echo $row_det['nombre']; ?></td>
			                		<td><?php echo $importe; ?></td>
			                	</tr>
			                <?php } ?>
			            </tbody>
			         </table>
			    </div>
			</div>
		    <?php
				}
			?>
		</div>
	</main>
