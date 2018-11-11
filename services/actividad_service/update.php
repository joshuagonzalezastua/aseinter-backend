<?php
 
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
 
include_once '../../db_conf/database.php';
include_once '../../entities/actividad.php';
 
$database = new Database();
$db = $database->getConnection();
 
$actividad = new Actividad($db);
 
$data = json_decode(file_get_contents("php://input"));

$actividad->id_actividad = $data->id_actividad;
$actividad->titulo = $data->titulo;
$actividad->descripcion = $data->descripcion;
$actividad->fecha = $data->fecha;

if($actividad->update()){
    echo '{ "response": "1" }';
}
 
else{
    echo '{ "response": "-1" }';
}
?>