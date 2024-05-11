<?php
include '../compruebaSesion.php';
require_once "../bootstrap.php";
require_once '../src/Entity/Equipo.php';
require_once '../src/Entity/Jugador.php';
require_once '../src/Entity/Equipojugador.php';
require_once '../src/Entity/Entrenador.php';
$nombre ="";
$equipo="";
$posicion="";
$output="";
  
  if (isset($_POST['nombre']) && !empty($_POST['nombre'])){
    $nombre = $_POST['nombre'];
  }
if (isset($_POST['equipo']) && !empty($_POST['equipo'])){
    $equipo = $_POST['equipo'];
  }

  if (isset($_POST['posicion']) && !empty($_POST['posicion'])){
      $posicion = $_POST['posicion'];
  }

  if($equipo == ""){
    $query = $entityManager->createQuery(
        'SELECT j 
         FROM Jugador j
         WHERE j.nombre LIKE :nombre 
         AND j.posicion LIKE :posicion'
    )->setParameters([
        'nombre' => '%' . $nombre . '%',
        'posicion' => '%' . $posicion . '%'
    ]);
  }else{
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



$jugadores = $query->getResult();


if($jugadores != null){
    foreach($jugadores as $jugador)
    {
        $output .=  "<tr>"
            . "<td>{$jugador->getNombre()}</td>"
            . "<td>{$jugador->getPosicion()}</td>"
            . "<td><a href='editJugador.php?jug={$jugador->getDnijugador()}'>Editar</a></td>"
            //. "<td><button>Delete</button></td>"
            . "<td><a href='borrarJugador.php?jug={$jugador->getDnijugador()}'>Delete</a></td>"
            . "</tr>";
    }
}
else
{
    $output = '<h3>No Data Found</h3>';
}
echo $output;


