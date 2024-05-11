<?php
include '../compruebaSesion.php';
if($_SERVER["REQUEST_METHOD"] == "GET"){
    require_once "../bootstrap.php";
    require_once '../src/Entity/Equipo.php';
    require_once '../src/Entity/Entrenador.php';
    
    $equipo = $entityManager->find("Equipo",$_GET["team"]);

    try{
        $entityManager->remove($equipo);
	$entityManager->flush();
        header("location:equipos.php");
    } catch (Exception $ex) {
        header("location:equipos.php?err=1");
    }
    
}