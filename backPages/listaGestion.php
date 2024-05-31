<?php 
if(!defined("ROOT")){
    include '../config.php';
}
include ROOT.'/compruebaSesion.php';
require_once ROOT."/bootstrap.php";
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/app.css">
    <link rel="stylesheet" href="<?php echo ROOT_PATH; ?>/css/backCss/listaGestion.css">
</head>

<body class="body--margin">
    <?php
    include "./gestionHeader.php";
    ?>
    <div class="gestion">
    <h1 class="gestion__titulo">Lista de gestiones</h1>
    <ul class="gestion__lista">
        <li class="gestion__elemento">
            <a class="gestion__enlace" href="equipos/equipos.php">
                <i class="fa-solid fa-people-group gestion__icono"></i>
                Gestión de Equipos
            </a>
        </li>
        <li class="gestion__elemento">
            <a class="gestion__enlace" href="jugadores/jugadores.php">
                <i class="fa-solid fa-user gestion__icono"></i>
                Gestión de Jugadores
            </a>
        </li>
        <li class="gestion__elemento">
            <a class="gestion__enlace" href="eventos/eventos.php">
                <i class="fa-regular fa-calendar gestion__icono"></i>
                Gestión de Eventos
            </a>
        </li>
        <li class="gestion__elemento">
            <a class="gestion__enlace" href="noticias/noticias.php">
                <i class="fa-solid fa-newspaper gestion__icono"></i>
                Gestión de Noticias
            </a>
        </li>
        <li class="gestion__elemento">
            <a class="gestion__enlace" href="entrenadores/entrenadores.php">
                <i class="fa-solid fa-user-gear gestion__icono"></i>
                Gestión de Entrenadores
            </a>
        </li>
    </ul>
</div>

</body>

</html>