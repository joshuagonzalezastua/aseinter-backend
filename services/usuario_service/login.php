<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../../db_conf/database.php';
include_once '../../entities/usuario.php';
 
$database = new Database();
$db = $database->getConnection();

$usuario = new Usuario($db);
$usuario->correo = isset($_GET['correo']) ? $_GET['correo'] : die();
$usuario->contrasena = isset($_GET['contrasena']) ? $_GET['contrasena'] : die();

$usuario->login();

$usuario_arr = array(
        "correo" => $usuario->correo,
        "nombre" => $usuario->nombre,
        "apellidos" => $usuario->apellidos,
        "contrasena" => $usuario->contrasena,
        "privilegio" => $usuario->privilegio
);

print_r(json_encode($usuario_arr));
?>