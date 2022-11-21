<?php
class Database
{
    Private $hostname ="Localhost:3307";
    Private $database="ropaurbana";
    Private $username= "root";
    private $password = "12MSarifer";
    Private $charset="utf8mb4";
    function conectar ()
    {
        $conexion = "mysql:host=" . $this->hostname . "; dbname" . $this->database . 
        "; charset=" . $this->charset;
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
PDO::ATTR_EMULATE_PREPARES => false
        ];
        $pdo = new PDO($conexion, $this->username, $this->password, $options);
        return $pdo;
    }
}
?>