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
$posicion = "";
$fecha = "";
$output = "";

if (isset($_POST['nombre']) && !empty($_POST['nombre'])) {
  $nombre = $_POST['nombre'];
}
if (isset($_POST['equipo']) && !empty($_POST['equipo'])) {
  $equipo = $_POST['equipo'];
}

if (isset($_POST['posicion']) && !empty($_POST['posicion'])) {
  $posicion = $_POST['posicion'];
}

if (isset($_POST['fecha']) && !empty($_POST['fecha'])) {
  $fecha = $_POST['fecha'];
}
/*
if ($equipo == "") {
  $query = $entityManager->createQuery(
    'SELECT j 
         FROM Jugador j
         WHERE j.nombre LIKE :nombre 
         AND j.posicion LIKE :posicion'
  )->setParameters([
    'nombre' => '%' . $nombre . '%',
    'posicion' => '%' . $posicion . '%'
  ]);
} else {
  $query = $entityManager->createQuery(
    'SELECT j 
         FROM Jugador j
         JOIN Equipojugador ej WITH j.dnijugador = ej.dnijugador
         WHERE j.nombre LIKE :nombre 
         AND j.posicion LIKE :posicion
         AND ej.idequipo = :idequipo'
  )->setParameters([
    'nombre' => '%' . $nombre . '%',
    'posicion' => '%' . $posicion . '%',
    'idequipo' =>  $equipo
  ]);
}
*/


$dql = 'SELECT j 
         FROM Jugador j
         WHERE j.nombre LIKE :nombre 
         AND j.posicion LIKE :posicion';
    $params = ['nombre' => '%' . $nombre . '%',
        'posicion' => '%' . $posicion . '%'];

if ($equipo != "") {
    $dql = 'SELECT j 
         FROM Jugador j
         JOIN Equipojugador ej WITH j.dnijugador = ej.dnijugador
         WHERE j.nombre LIKE :nombre 
         AND j.posicion LIKE :posicion';
    $params = ['nombre' => '%' . $nombre . '%',
        'posicion' => '%' . $posicion . '%'];
    $dql .= ' AND ej.idequipo = :idequipo';
    $params['idequipo'] = $equipo ;
}else{
    
}

if ($fecha != "") {
    $dql .= ' AND j.nacimiento LIKE :fecha';
    $params['fecha'] = '%' . $fecha . '%';
}

$query = $entityManager->createQuery($dql)->setParameters($params);

// Ejecutar la consulta
$eventos = $query->getResult();


$jugadores = $query->getResult();
$output .= '<li class="tbl__header">
            <div class="tbl__col tbl__col--1">Nombre</div>
            <div class="tbl__col tbl__col--2">Posición</div>
            <div class="tbl__col tbl__col--3">Nacimiento</div>
            <div class="tbl__col tbl__col--4">Número</div>
            <div class="tbl__col tbl__col--5">Editar</div>
            <div class="tbl__col tbl__col--6">Eliminar</div>
        </li>';

if ($jugadores != null) {
  foreach ($jugadores as $jugador) {
      $output .= 
        '<li class="tbl__row">
            <div class="tbl__col tbl__col--1" data-label="Nombre">' . $jugador->getNombre() . '</div>
            <div class="tbl__col tbl__col--2" data-label="Posición">' . $jugador->getPosicion() . '</div>
            <div class="tbl__col tbl__col--3" data-label="Nacimiento">' . $jugador->getNacimiento()->format("d-m-Y") . '</div>
            <div class="tbl__col tbl__col--4" data-label="Número">' . $jugador->getNumero() . '</div>
            <div class="tbl__col tbl__col--5" data-label="Editar"><a href=\'editJugador.php?jug=' . $jugador->getDnijugador() . '\'><i class="fa-solid fa-pen-to-square"></i></a></div>
            <div class="tbl__col tbl__col--6" data-label="Eliminar"><button class="deleteBtn" onclick="mensajeConfirmar(\'borrarJugador.php?jug=' . $jugador->getDnijugador() . '\')"><i class="fa-solid fa-trash""></i></button></div>
        </li>';
  }
} else {
$output .= '<h2 class="noData">No se han encontrado datos</h2>';
}
echo $output;
