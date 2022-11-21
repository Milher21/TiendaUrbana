<?php

include_once '../Modelo/Conexion.php';
require '../config/config.php';

class producto
{
    public $objetos;
   public  $lista_carrito ;
    public function __construct()
    {
        $db = new Conexion();
        $this->acceso = $db->pdo;
    }
    
public function mostrar()
{
    global $productos;
$productos=isset($_SESSION['carrito']['producto']) ? $_SESSION['carrito']['producto'] : null;
 
    if ($productos != null) {
        foreach ($productos as $clave => $cantidad) {
            $sql ="SELECT nombre, precio, $cantidad AS cantidad  FROM  productos where  id_producto=? and activo=1";
            $query = $this->acceso->prepare($sql);
            $query->execute([$clave]);
            $lista_carrito[] = $query->fetch(PDO::FETCH_ASSOC);

            // return $this->$lista_carrito[];
        }
    }
    return $lista_carrito;
}

}
?>