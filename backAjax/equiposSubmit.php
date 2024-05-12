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


if ($equipos != null) {
    foreach ($equipos as $equipo) {
        $entrenador = $entityManager->getRepository('Entrenador')->find($equipo->getDnientrenador());
        $output .=  "<tr>"
            . "<td>{$equipo->getNombre()}</td>"
            . "<td>{$equipo->getCategoria()}</td>"
            . "<td>{$entrenador->getNombre()}</td>"
            . "<td><a href='gestionarEquipo.php?team={$equipo->getIdequipo()}'>Gestionar</a></td>"
            //. "<td><button>Delete</button></td>"
            . "<td><a href='borrarEquipo.php?team={$equipo->getIdequipo()}'>Delete</a></td>"
            . "<td><a href='".ROOT_PATH."/backPages/jugadores/jugadores.php?team={$equipo->getIdequipo()}'>Acceder</a></td>"
            . "</tr>";
    }
} else {
    $output = '<h3>No Data Found</h3>';
}
echo $output;
