<?php
if(!defined("ROOT")){
        include '../../config.php';
    }
    include ROOT.'/compruebaSesion.php';
    require_once ROOT."/bootstrap.php";
    require_once ROOT.'/src/Entity/Equipo.php';
    require_once ROOT.'/src/Entity/Entrenador.php';

$equipos = $entityManager->getRepository('Equipo')->findAll();
$result;
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $result = $entityManager->getRepository('Equipo')->find($_GET["team"]);
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    try {
        $result = $entityManager->getRepository('Equipo')->find($_GET["team"]);
        $result->setNombre($_POST["nombre"]);
        $result->setCategoria($_POST["categoria"]);
        $entrenador = $entityManager->getRepository('Entrenador')->find($_POST["entrenador"]);
        $result->setDnientrenador($entrenador);

        header("location:equipos.php?err=0");
    } catch (PDOException $e) {
        header("location:editEquipo.php?err=1");
        //echo 'Error al conectar: ' . $e->getMessage();
    }
}

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo ROOT_PATH;?>/css/app.css">
</head>

<body class="body--margin">
    <?php
    include 'gestionHeader.html';
    if (isset($_GET["err"])) {
        if ($_GET["err"] == "1") {
            print "<div class='error'><h3>ERROR AL EDITAR LOS DATOS</h3><p>Inténtelo de nuevo</p><br><br></div>";
        }
    }

    ?>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . "?team=" . $_GET["team"]; ?>" method="post">
        Nombre:
        <input required autocomplete="off" type="text" name="nombre" id="nombre" value="<?php echo $result->getNombre(); ?>"><br><br>
        Categoria:
        <select required type="text" name="categoria" id="categoria">
            <option value=""></option>
            <?php
            foreach ($equipos as $equipo) {
                if ($equipo->getCategoria() == $result->getCategoria()) {
            ?>
                    <option selected="true" value="<?php echo $equipo->getCategoria(); ?>"><?php echo $equipo->getCategoria(); ?></option>
                <?php
                } else {
                ?>
                    <option value="<?php echo $equipo->getCategoria(); ?>"><?php echo $equipo->getCategoria(); ?></option>
            <?php
                }
            }
            ?>
        </select>
        <br><br>
        Entrenador:
        <select required type="text" name="entrenador" id="entrenador">
            <option value=""></option>
            <?php
            foreach ($equipos as $equipo) {
                $entrenador = $entityManager->getRepository('Entrenador')->find($equipo->getDnientrenador());

                if ($equipo->getDnientrenador() == $result->getDnientrenador()) {
            ?>
                    <option selected="true" value="<?php echo $entrenador->getDnientrenador(); ?>"><?php echo $entrenador->getNombre(); ?></option>
                <?php
                } else {
                ?>
                    <option value="<?php echo $entrenador->getDnientrenador(); ?>"><?php echo $entrenador->getNombre(); ?></option>
            <?php
                }
            }
            ?>
        </select><br><br>
        <input type="submit" value="Guardar">
    </form>
</body>

</html>