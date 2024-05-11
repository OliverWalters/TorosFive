<?php
require_once "../bootstrap.php";
require_once '../src/Entity/Equipo.php';
require_once '../src/Entity/Entrenador.php';
$nombre = "";
$categoria = "";
$entrenador = "";
$output = "";

if (isset($_GET['nombre']) && !empty($_GET['nombre'])) {
    $nombre = $_GET['nombre'];
}

if (isset($_GET['categoria']) && !empty($_GET['categoria'])) {
    $categoria = $_GET['categoria'];
}

if (isset($_GET['entrenador']) && !empty($_GET['entrenador'])) {
    $entrenador = $_GET['entrenador'];
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
        $output .= "<tr ondblclick=\"window.location.href='jugares.php?team={$equipo->getIdequipo()}';\">"
            . "<td>{$equipo->getNombre()}</td>"
            . "<td>{$equipo->getCategoria()}</td>"
            . "<td>{$entrenador->getNombre()}</td>"
            . "</tr>";
    }
} else {
    $output = '<h3>No Data Found</h3>';
}
echo $output;
