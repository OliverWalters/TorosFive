<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/app.css">
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="../backJs/equiposFilters.js"></script>
</head>

<body class="body--margin">
    <?php
    include '../compruebaSesion.php';
    include 'gestionHeader.html';
    require_once "../bootstrap.php";
    require_once '../src/Entity/Equipo.php';
    require_once '../src/Entity/Entrenador.php';
    $equipos = $entityManager->getRepository('Equipo')->findAll();
    if (isset($_GET["err"])) {
        if ($_GET["err"] == "1") {
            print "<div class='error'><h3>HA HABIDO UN ERROR AL BORRAR</h3><p>Inténtelo de nuevo</p><br><br></div>";
        }
    }
    ?>

    <form id="form">
        Nombre:
        <input autocomplete="off" type="text" name="nombre" id="nombre" onkeyup="filterData()"><br><br>
        Categoria:
        <select type="text" name="categoria" id="categoria" onchange="filterData()">
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
        <select type="text" name="entrenador" id="entrenador" onchange="filterData()">
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
    </form>
    <button id="reset" onclick="reset()">Reset</button>
    <button onclick="window.location.href='agregarEquipo.php';">Añadir equipo</button>
    <table id="table">
        <thead>
            <tr>
                <td>Nombre</td>
                <td>Categoria</td>
                <td>Entrenador</td>
                <td>Gestionar</td>
                <td>Eliminar</td>
                <td>Acceder</td>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</body>

</html>