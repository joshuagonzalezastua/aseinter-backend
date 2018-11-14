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

$data = json_decode(file_get_contents("php://input"));

$usuario->nombre_usuario = $data->nombre_usuario;
$usuario->contrasena = $data->contrasena;

$usuario->login();

$usuario_arr = array(
        "nombre_usuario" => $usuario->nombre_usuario,
        "contrasena" => $usuario->contrasena
);

print_r(json_encode($usuario_arr));
?>