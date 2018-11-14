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
 
$usuario->correo = $data->correo;
$usuario->nombre = $data->nombre;
$usuario->apellidos = $data->apellidos;
$usuario->contrasena = $data->contrasena;
$usuario->privilegio = $data->privilegio; 
 
if($usuario->delete()){
    echo '{';
        echo '"message": "Se eliminó el usuario"';
    echo '}';
}
 
 
else{
    echo '{';
        echo '"message": "Imposible eliminar el usuario"';
    echo '}';
}
?>