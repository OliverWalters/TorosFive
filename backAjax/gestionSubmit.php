<?php
if(!defined("ROOT")){
    include '../config.php';
}
include ROOT.'/compruebaSesion.php';
require_once ROOT."/bootstrap.php";
require_once ROOT.'/src/Entity/Equipo.php';
require_once ROOT.'/src/Entity/Jugador.php';
require_once ROOT.'/src/Entity/Entrenador.php';
require_once ROOT.'/src/Entity/Equipojugador.php';
$nombre = "";
$equipo = "";
$excepto = "";
$output = "";

if (isset($_POST['nombre']) && !empty($_POST['nombre'])) {
  $nombre = $_POST['nombre'];
}
if (isset($_POST['equipo']) && !empty($_POST['equipo'])) {
  $equipo = $_POST['equipo'];
}
if (isset($_POST['excepto']) && !empty($_POST['excepto'])) {
  $excepto = $_POST['excepto'];
}


if ($equipo == "") {
  $query = $entityManager->createQuery(
    'SELECT j 
         FROM Jugador j
         WHERE j.nombre LIKE :nombre 
         AND NOT EXISTS (
             SELECT ej
             FROM Equipojugador ej
             WHERE ej.dnijugador = j.dnijugador
             AND ej.idequipo = :idequipo
         )'
  )->setParameters([
    'nombre' => '%' . $nombre . '%',
    'idequipo' => $excepto
  ]);
} else {
  $query = $entityManager->createQuery(
    'SELECT j 
         FROM Jugador j
         JOIN Equipojugador ej WITH j.dnijugador = ej.dnijugador
         WHERE j.nombre LIKE :nombre 
         AND ej.idequipo = :idequipo'
  )->setParameters([
    'nombre' => '%' . $nombre . '%',
    'idequipo' =>  $equipo
  ]);
}



$jugadores = $query->getResult();
/*$output .= '<li class="tbl__header">
                <div class="tbl__col tbl__col--1">Elegir</div>
                <div class="tbl__col tbl__col--2">Jugadora</div>
            </li>';*/

if ($jugadores != null) {
  foreach ($jugadores as $jugador) {
      $output .= 
        '<li class="tbl__row">
            <div class="tbl__col tbl__col--1" data-label="Seleccionado">
                <div class="checkbox-wrapper-59">
                    <label class="switch">
                        <input type="checkbox" name="opciones[]" value="'.$jugador->getDnijugador().':'.$_GET["team"].'">
                        <span class="slider"></span>
                    </label>
                </div>
            </div>
            <div class="tbl__col tbl__col--2" data-label="Jugadora">' . $jugador->getNombre() . '</div>
        </li>';
      
  }
} else {
  $output .= '<h3>No Data Found</h3>';
}
echo $output;
