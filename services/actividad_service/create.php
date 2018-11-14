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
 
$actividad->titulo = $data->titulo;
$actividad->descripcion = $data->descripcion;
$actividad->color = $data->color;
$actividad->startDate = $data->startDate;
$actividad->endDate= $data->endDate;

if($actividad->create()) {

    $response = array(
        "id_actividad" => $actividad->id_actividad,
        "titulo" => $actividad->titulo,
        "descripcion" => $actividad->descripcion,
        "color" => $actividad->color,
        "startDate" => $actividad->startDate,
        "endDate" => $actividad->endDate
    );

    echo '"response":' . json_encode($response);
}
 
 
else {
    echo '"response": "-1"';
}
?>