<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

include_once '../../db_conf/database.php';
include_once '../../entities/usuario.php';
 
$database = new Database();
$db = $database->getConnection();

$usuario = new Usuario($db);
$usuario->correo = isset($_GET['correo']) ? $_GET['correo'] : die();

$usuario->readOne();

$usuario_arr = array(
        "correo" => $usuario->correo,
        "nombre" => $usuario->nombre,
        "apellidos" => $usuario->apellidos,
        "contrasena" => $usuario->contrasena,
        "privilegio" => $usuario->privilegio
);

print_r(json_encode($usuario_arr));
?>