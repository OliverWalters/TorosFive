<?php
include '../compruebaSesion.php';
require_once "../bootstrap.php";
require_once '../src/Entity/Equipo.php';
require_once '../src/Entity/Jugador.php';
require_once '../src/Entity/Equipojugador.php';
require_once '../src/Entity/Entrenador.php';
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


if ($jugadores != null) {
  foreach ($jugadores as $jugador) {
    $output .=  "<tr>"
      . "<td><input type='checkbox' name='opciones[]' value='{$jugador->getDnijugador()}:{$_GET["team"]}'></td>"
      . "<td>{$jugador->getNombre()}</td>"
      . "</tr>";
  }
} else {
  $output = '<h3>No Data Found</h3>';
}
echo $output;
