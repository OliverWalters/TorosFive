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


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    try {
        $nuevo = new Equipo();
        $nuevo->setNombre($_POST["nombre"]);
        $nuevo->setCategoria($_POST["categoria"]);
        $entrenador = $entityManager->getRepository('Entrenador')->find($_POST["entrenador"]);
        $nuevo->setDnientrenador($entrenador);
        $entityManager->persist($nuevo);
        $entityManager->flush();

        header("location:equipos.php?err=0");
    } catch (PDOException $e) {
        header("location:agregarEquipo.php?err=1");
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
    include '../gestionHeader.php';
    if (isset($_GET["err"])) {
        if ($_GET["err"] == "1") {
            print "<div class='error'><h3>ERROR AL AGREGAR UN EQUIPO</h3><p>Inténtelo de nuevo</p></div>";
        }
    }

    ?>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        Nombre:
        <input required autocomplete="off" type="text" name="nombre" id="nombre"><br><br>
        Categoria:
        <select required type="text" name="categoria" id="categoria">
            <option value=""></option>
            <?php
            foreach ($equipos as $equipo) {
            ?>
                <option value="<?php echo $equipo->getCategoria(); ?>"><?php echo $equipo->getCategoria(); ?></option>
            <?php
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
            ?>
                <option value="<?php echo $entrenador->getDnientrenador(); ?>"><?php echo $entrenador->getNombre(); ?></option>
            <?php
            }
            ?>
        </select><br><br>
        <input type="submit" value="Guardar">
    </form>
</body>

</html>