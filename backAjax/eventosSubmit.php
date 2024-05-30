<?php
if(!defined("ROOT")){
    include '../config.php';
}
include ROOT.'/compruebaSesion.php';
require_once ROOT."/bootstrap.php";
require_once ROOT.'/src/Entity/Evento.php';
$nombre = "";
$fecha = "";
$output = "";

if (isset($_POST['nombre']) && !empty($_POST['nombre'])) {
  $nombre = $_POST['nombre'];
}
if (isset($_POST['fecha']) && !empty($_POST['fecha'])) {
  $fecha = $_POST['fecha'];
}


$dql = 'SELECT e FROM Evento e WHERE e.nombre LIKE :nombre';
$params = ['nombre' => '%' . $nombre . '%'];

if ($fecha != "") {
    $dql .= ' AND e.fecha LIKE :fecha';
    $params['fecha'] = '%' . $fecha . '%';
}

$query = $entityManager->createQuery($dql)->setParameters($params);

// Ejecutar la consulta
$eventos = $query->getResult();



$eventos = $query->getResult();
$output .= '<li class="tbl__header">
            <div class="tbl__col tbl__col--1">Nombre</div>
            <div class="tbl__col tbl__col--2">Fecha</div>
            <div class="tbl__col tbl__col--3">Descripción</div>
            <div class="tbl__col tbl__col--4">Editar</div>
            <div class="tbl__col tbl__col--5">Eliminar</div>
        </li>';

if ($eventos != null) {
  foreach ($eventos as $evento) {
      $output .= 
        '<li class="tbl__row">
            <div class="tbl__col tbl__col--1" data-label="Nombre">' . $evento->getNombre() . '</div>
            <div class="tbl__col tbl__col--2" data-label="Fecha">' . $evento->getFecha()->format('d-m-Y') . '</div>
            <div class="tbl__col tbl__col--3" data-label="Descripción">' . $evento->getDescripcion() . '</div>
            <div class="tbl__col tbl__col--4" data-label="Editar"><a href=\'editEvento.php?event=' . $evento->getIdevento() . '\'><i class="fa-solid fa-pen-to-square"></i></a></div>
            <div class="tbl__col tbl__col--5" data-label="Eliminar"><button class="deleteBtn" onclick="mensajeConfirmar(\'borrarEvento.php?event=' . $evento->getIdevento() . '\')"><i class="fa-solid fa-trash"></i></button></div>
        </li>';
  }
} else {
$output .= '<h2 class="noData">No se han encontrado datos</h2>';
}
echo $output;
