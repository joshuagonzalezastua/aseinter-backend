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
$usuario->nombre_usuario = isset($_GET['nombre_usuario']) ? $_GET['nombre_usuario'] : die();

$usuario->readOne();

$usuario_arr = array(
        "nombre_usuario" => $usuario->nombre_usuario,
        "contrasena" => $usuario->contrasena
);

print_r(json_encode($usuario_arr));
?>