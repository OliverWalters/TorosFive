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
if (isset($_GET["err"])) {
    if ($_GET["err"] == "1") {
        print "<div class='error'><h3>HA HABIDO UN ERROR AL BORRAR</h3><p>Inténtelo de nuevo</p><br><br></div>";
    }
}
$team = $_GET["team"];

try {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['opciones'])) {
            $opcionesSeleccionadas = $_POST['opciones'];
            if ($_GET["add"] == 0) {
                foreach ($opcionesSeleccionadas as $opcion) {
                    list($datoJugador, $datoEquipo) = explode(':', $opcion);
                    $dato = $entityManager->getRepository('Equipojugador')->findBy(array('dnijugador' => $datoJugador, 'idequipo' => $datoEquipo));
                    $entityManager->remove($dato[0]);
                    $entityManager->flush();
                }
                header("location:" . htmlspecialchars($_SERVER["PHP_SELF"]) . "?team=" . $team);
            } else {
                foreach ($opcionesSeleccionadas as $opcion) {
                    list($datoJugador, $datoEquipo) = explode(':', $opcion);
                    $equipo = $entityManager->find("Equipo", $datoEquipo);
                    $jugador = $entityManager->find("Jugador", $datoJugador);

                    $nuevo = new Equipojugador();
                    $nuevo->setDnijugador($jugador);
                    $nuevo->setIdequipo($equipo);
                    $entityManager->persist($nuevo);
                    $entityManager->flush();
                }
                header("location:" . htmlspecialchars($_SERVER["PHP_SELF"]) . "?team=" . $team);
            }
        }
    }
} catch (Exception $ex) {
    echo "error";
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo ROOT_PATH;?>/css/app.css">
    <link rel="stylesheet" href="<?php echo ROOT_PATH;?>/css/backCss/tablas/tablaEquiposjugadores.css">
    <link rel="stylesheet" href="<?php echo ROOT_PATH;?>/css/backCss/tabla.css">
    <link rel="stylesheet" href="<?php echo ROOT_PATH;?>/css/backCss/equiposjugadores.css">
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="<?php echo ROOT_PATH;?>/backJs/gestionarFilters.js"></script>
</head>

<body class="body--margin">
    <?php
    include '../gestionHeader.php';
    ?>
    <div class="box">
        <div class="box__item">
            <div class="tbl">
                <h2 class="tbl__title">Equipo<small class="tbl__subtitle"></small></h2>
                <input type="text" onkeyup="listarEquipo(<?php echo $team; ?>)" id="nombreJugEq" autocomplete="new-password">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . "?team=" . $team; ?>&add=0" method="post"><input type="submit" value="Eliminar">
                    <li class="tbl__header">
                        <div class="tbl__col tbl__col--1">Elegir</div>
                        <div class="tbl__col tbl__col--2">Jugadora</div>
                    </li>
                    <ul class="tbl__list" id="tblJugEq">
                    </ul>
                </form>
            </div>
        </div>
        <div class="box__item">
            <div class="tbl">
                <h2 class="tbl__title">Jugadoras<small class="tbl__subtitle"></small></h2>
                <input type="text" onkeyup="listarJugadores(<?php echo $team; ?>)" id="nombreJug" autocomplete="new-password">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . "?team=" . $team; ?>&add=1" method="post"><input type="submit" value="Añadir">
                    <li class="tbl__header">
                        <div class="tbl__col tbl__col--1">Elegir</div>
                        <div class="tbl__col tbl__col--2">Jugadora</div>
                    </li>
                    <ul class="tbl__list" id="tblJug">
                    </ul>
                </form>
            </div>
        </div>
    </div>
    <script>
        listarEquipo(<?php echo $team; ?>)
        listarJugadores(<?php echo $team; ?>)
    </script>
</body>

</html>