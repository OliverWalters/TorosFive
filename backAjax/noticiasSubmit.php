<?php
if(!defined("ROOT")){
    include '../config.php';
}
include ROOT.'/compruebaSesion.php';
require_once ROOT."/bootstrap.php";
require_once ROOT.'/src/Entity/Noticia.php';
$nombre = "";
$fecha = "";
$output = "";

if (isset($_POST['nombre']) && !empty($_POST['nombre'])) {
  $nombre = $_POST['nombre'];
}
if (isset($_POST['fecha']) && !empty($_POST['fecha'])) {
  $fecha = $_POST['fecha'];
}


$dql = 'SELECT n FROM Noticia n WHERE n.nombre LIKE :nombre';
$params = ['nombre' => '%' . $nombre . '%'];

if ($fecha != "") {
    $dql .= ' AND n.fecha LIKE :fecha';
    $params['fecha'] = '%' . $fecha . '%';
}

$query = $entityManager->createQuery($dql)->setParameters($params);

// Ejecutar la consulta
$noticias = $query->getResult();



$noticias = $query->getResult();
$output .= '<li class="tbl__header">
            <div class="tbl__col tbl__col--1">Nombre</div>
            <div class="tbl__col tbl__col--2">Fecha</div>
            <div class="tbl__col tbl__col--3">Descripción</div>
            <div class="tbl__col tbl__col--4">Editar</div>
            <div class="tbl__col tbl__col--5">Eliminar</div>
        </li>';

if ($noticias != null) {
  foreach ($noticias as $noticia) {
      $output .= 
        '<li class="tbl__row">
            <div class="tbl__col tbl__col--1" data-label="Nombre">' . $noticia->getNombre() . '</div>
            <div class="tbl__col tbl__col--2" data-label="Fecha">' . $noticia->getFecha()->format('d-m-Y') . '</div>
            <div class="tbl__col tbl__col--3" data-label="Descripción">' . $noticia->getDescripcion() . '</div>
            <div class="tbl__col tbl__col--4" data-label="Editar"><a href=\'editNoticia.php?not=' . $noticia->getIdnoticia() . '\'><i class="fa-solid fa-pen-to-square"></i></a></div>
            <div class="tbl__col tbl__col--5" data-label="Eliminar"><button class="deleteBtn" onclick="mensajeConfirmar(\'borrarNoticia.php?not=' . $noticia->getIdnoticia() . '\')"><i class="fa-solid fa-trash"></i></button></div>
        </li>';
  }
} else {
$output .= '<h2 class="noData">No se han encontrado datos</h2>';
}
echo $output;
