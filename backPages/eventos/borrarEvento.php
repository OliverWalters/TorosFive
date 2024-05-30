<?php
if(!defined("ROOT")){
    include '../../config.php';
}
include ROOT.'/compruebaSesion.php';
require_once ROOT."/bootstrap.php";
require_once ROOT.'/src/Entity/Evento.php';
if ($_SERVER["REQUEST_METHOD"] == "GET") {


    $evento = $entityManager->find("Evento", $_GET["event"]);


    try {
        $entityManager->remove($evento);
        $entityManager->flush();
        header("location:eventos.php?err=0");
    } catch (Exception $ex) {
        header("location:eventos.php?err=1");
    }
}
