<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

include_once '../../db_conf/database.php';
include_once '../../entities/actividad.php';
 
$database = new Database();
$db = $database->getConnection();

$actividad = new Actividad($db);
$actividad->id_actividad = isset($_GET['id_actividad']) ? $_GET['id_actividad'] : die();

$actividad->readOne();

$actividad_arr = array(
        "id_actividad" => $actividad->id_actividad,
        "titulo" => $actividad->titulo,
        "descripcion" => $actividad->descripcion,
        "fecha" => $actividad->fecha
);

print_r(json_encode($actividad_arr));
?>