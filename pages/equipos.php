<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/app.css">
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="../js/equiposFilters.js"></script>
</head>

<body class="body--margin">
    <?php
    include '../header.html';
    require_once "../bootstrap.php";
    require_once '../src/Entity/Equipo.php';
    require_once '../src/Entity/Entrenador.php';
    $equipos = $entityManager->getRepository('Equipo')->findAll();
    ?>
    <form id="form">
        Nombre:
        <input autocomplete="off" type="text" name="nombre" id="nombre"><br><br>
        Categoria:
        <select type="text" name="categoria" id="categoria">
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
        <select type="text" name="entrenador" id="entrenador">
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
        <input type="submit" value="Filtrar">

    </form><button id="reset" onclick="reset()">Reset</button>
    <table id="table">
        <thead>
            <tr>
                <td>Nombre</td>
                <td>Categoria</td>
                <td>Entrenador</td>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</body>

</html>