<?php
if(!defined("ROOT")){
    include '../config.php';
}
include ROOT.'/compruebaSesion.php';
require_once ROOT."/bootstrap.php";
require_once ROOT.'/src/Entity/Equipo.php';
require_once ROOT.'/src/Entity/Entrenador.php';
$nombre = "";
$categoria = "";
$entrenador = "";
$output = "";

if (isset($_POST['nombre']) && !empty($_POST['nombre'])) {
    $nombre = $_POST['nombre'];
}

if (isset($_POST['categoria']) && !empty($_POST['categoria'])) {
    $categoria = $_POST['categoria'];
}

if (isset($_POST['entrenador']) && !empty($_POST['entrenador'])) {
    $entrenador = $_POST['entrenador'];
}

$query = $entityManager->createQuery(
    'SELECT e FROM Equipo e 
        JOIN e.dnientrenador entrenador
        WHERE e.nombre LIKE :nombre 
        AND e.categoria LIKE :categoria 
        AND entrenador.dnientrenador LIKE :entrenador'
)->setParameters([
    'nombre' => '%' . $nombre . '%',
    'categoria' => '%' . $categoria . '%',
    'entrenador' => '%' . $entrenador . '%'
]);


$equipos = $query->getResult();
$output .= '<li class="tbl__header">
            <div class="tbl__col tbl__col--1">Nombre</div>
            <div class="tbl__col tbl__col--2">Categoria</div>
            <div class="tbl__col tbl__col--3">Entrenador</div>
            <div class="tbl__col tbl__col--4">Gestionar</div>
            <div class="tbl__col tbl__col--5">Eliminar</div>
            <div class="tbl__col tbl__col--6">Acceder</div>
        </li>';

if ($equipos != null) {
    foreach ($equipos as $equipo) {
        $entrenador = $entityManager->getRepository('Entrenador')->find($equipo->getDnientrenador());
        $output .= 
        '<li class="tbl__row">
            <div class="tbl__col tbl__col--1" data-label="Nombre">' . $equipo->getNombre() . '</div>
            <div class="tbl__col tbl__col--2" data-label="Categoria">' . $equipo->getCategoria() . '</div>
            <div class="tbl__col tbl__col--3" data-label="Entrenador">' . $entrenador->getNombre() . '</div>
            <div class="tbl__col tbl__col--4" data-label="Gestionar"><a href=\'gestionarEquipo.php?team=' . $equipo->getIdequipo() . '\'><i class="fa-solid fa-pen-to-square" style="color: #ffde2e;font-size: 20px"></i></a></div>
            <div class="tbl__col tbl__col--5" data-label="Eliminar"><a href=\'borrarEquipo.php?team=' . $equipo->getIdequipo() . '\'><i class="fa-solid fa-trash" style="color: red"></i></a></div>
            <div class="tbl__col tbl__col--6" data-label="Acceder"><a href="' . ROOT_PATH . '/backPages/jugadores/jugadores.php?team=' . $equipo->getIdequipo() . '"><i class="fa-solid fa-chevron-right"></i></a></div>
        </li>';

    }
} else {
    $output .= '<h3>No Data Found</h3>';
}
echo $output;
