<?php 

require '../config/config.php';



 if (isset($_POST['id'])) {
    $id=$_POST['id'];
if(isset($_SESSION['carrito']['producto'][$id])){
   $_SESSION ['carrito']['producto'][$id] +=1;
}
else {
   $_SESSION['carrito']['producto'][$id] =1;
}
$datos['numero']=count($_SESSION['carrito']['producto']);

$datos['ok']=true;


 } else {
    $datos['ok']=false;
 }
 

echo json_encode($datos);



?>