<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/app.css">
    <link rel="stylesheet" href="../css/equipos.css"/>
</head>

<body class="body--margin">
    <?php
    include '../header.html';
    require_once "../bootstrap.php";
    require_once '../src/Entity/Equipo.php';
    require_once '../src/Entity/Entrenador.php';
    $equipos = $entityManager->getRepository('Equipo')->findAll();
    ?>
    <div class="equipos">
    <?php
    foreach($equipos as $equipo){
        $numero_random = rand(1, 4);
        ?>
        <div class="equipo">
            <div class="equipo__fondo">
                <img src="../images/background/equipos/<?php echo $numero_random.".png"; ?>">
            </div>
            <img class="equipo__foto" src="<?php echo $equipo->getImagen(); ?>" alt="alt"/>
            <div class="equipo__info">
                <h1 class="equipo__info__titulo"><?php echo $equipo->getNombre(); ?></h1>
                <p class="equipo__info__txt"><?php echo $equipo->getCategoria(); ?></p>
            </div>
        </div>
        <?php
    }
    ?>
    </div>
</body>

<?php
    include './footer.html';
?>

</html>