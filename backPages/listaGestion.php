<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/app.css">
</head>
<body class="body--margin">
<?php
require_once "../bootstrap.php";
include '../compruebaSesion.php';
include "./gestionHeader.html";
require_once '../src/Entity/Entrenador.php';
?>
<h1>Lista de gestiones</h1>
<ul>
    <li><a href="equipos.php">Gestión de Equipos</a></li>
    <li><a href="jugadores.php">Gestión de Jugadores</a></li>
    <li><a href="">Gestión de Eventos</a></li>
    <li><a href="">Gestión de Noticias</a></li>
</ul>
</body>
</html>
    
    

    