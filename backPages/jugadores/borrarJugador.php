<?php
if(!defined("ROOT")){
    include '../../config.php';
}
include ROOT.'/compruebaSesion.php';
require_once ROOT."/bootstrap.php";
require_once ROOT.'/src/Entity/Jugador.php';
require_once ROOT.'/src/Entity/Equipo.php';
require_once ROOT.'/src/Entity/Entrenador.php';
require_once ROOT.'/src/Entity/Equipojugador.php';
if ($_SERVER["REQUEST_METHOD"] == "GET") {


    $jugador = $entityManager->find("Jugador", $_GET["jug"]);
    $equiposjugador = $entityManager->getRepository("Equipojugador")->findBy(["dnijugador" => $jugador]);


    try {
        foreach ($equiposjugador as $ej) {
            $entityManager->remove($ej);
        }
        $entityManager->remove($jugador);
        $entityManager->flush();
        header("location:jugadores.php");
    } catch (Exception $ex) {
        header("location:jugadores.php?err=1");
    }
}
