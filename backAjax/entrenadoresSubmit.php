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
$usuario = "";
$output = "";

if (isset($_POST['nombre']) && !empty($_POST['nombre'])) {
  $nombre = $_POST['nombre'];
}
if (isset($_POST['usuario']) && !empty($_POST['usuario'])) {
  $usuario = $_POST['usuario'];
}



  $query = $entityManager->createQuery(
    'SELECT e 
         FROM Entrenador e
         WHERE e.nombre LIKE :nombre 
         AND e.usuario LIKE :usuario'
  )->setParameters([
    'nombre' => '%' . $nombre . '%',
    'usuario' => '%' . $usuario . '%'
  ]);


$entrenadores = $query->getResult();
$output .= '<li class="tbl__header">
            <div class="tbl__col tbl__col--1">Nombre</div>
            <div class="tbl__col tbl__col--2">Usuario</div>
            <div class="tbl__col tbl__col--3">Editar</div>
            <div class="tbl__col tbl__col--4">Eliminar</div>
        </li>';

if ($entrenadores != null) {
  foreach ($entrenadores as $entrenador) {
      $output .= 
        '<li class="tbl__row">
            <div class="tbl__col tbl__col--1" data-label="Nombre">' . $entrenador->getNombre() . '</div>
            <div class="tbl__col tbl__col--2" data-label="Usuario">' . $entrenador->getUsuario() . '</div>
            <div class="tbl__col tbl__col--3" data-label="Editar"><a href=\'editEntrenador.php?entr=' . $entrenador->getDnientrenador() . '\'><i class="fa-solid fa-pen-to-square" style="color: #ffde2e;font-size: 20px"></i></a></div>
            <div class="tbl__col tbl__col--4" data-label="Eliminar"><button class="deleteBtn" onclick="mensajeConfirmar(\'borrarEntrenador.php?entr=' . $entrenador->getDnientrenador() . '\')"><i class="fa-solid fa-trash" style="color: red"></i></button></div>
        </li>';
  }
} else {
  $output .= '<h2 class="noData">No se han encontrado datos</h2>';
}
echo $output;
