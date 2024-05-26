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

    $entrenador = $entityManager->find("Entrenador", $_GET["entr"]);


    try {
        $entityManager->remove($entrenador);
        $entityManager->flush();
        header("location:entrenadores.php?err=0");
    } catch (Exception $ex) {
        echo $ex->getMessage();
        /*header("location:entrenadores.php?err=1");*/
    }
}
