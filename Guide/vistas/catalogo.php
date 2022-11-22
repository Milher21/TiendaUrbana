<?php
    require '../config/database.php';
    $db = new Conexion();
    $con = $db->pdo;

    $sql = $con->prepare("SELECT id, name, price FROM products WHERE active=1");
    $sql->execute();
    //fetch devuelve las filas de la consulta PDO::FETCH_ASSOC etiqueta por el nombre de la columna
    $results = $sql->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>¡¡¡Gracias por su compra!!!</h2>
<?php 
    foreach ($results as $row) {
        # code...
    }
?>
</body>
</html>