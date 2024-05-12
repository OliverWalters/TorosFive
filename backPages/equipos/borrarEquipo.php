<?php
if(!defined("ROOT")){
        include '../../config.php';
    }
    include ROOT.'/compruebaSesion.php';
    require_once ROOT."/bootstrap.php";
    require_once ROOT.'/src/Entity/Equipo.php';
    require_once ROOT.'/src/Entity/Jugador.php';
    require_once ROOT.'/src/Entity/Entrenador.php';
    require_once ROOT.'/src/Entity/Equipojugador.php';
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    

    $equipo = $entityManager->find("Equipo", $_GET["team"]);

    try {
        $entityManager->remove($equipo);
        $entityManager->flush();
        header("location:equipos.php");
    } catch (Exception $ex) {
        header("location:equipos.php?err=1");
    }
}
