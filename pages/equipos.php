<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../images/icono.png" type="image/*">
    <title>Equipos - Toro's Five</title>
    <link rel="stylesheet" href="../css/app.css">
    <link rel="stylesheet" href="../css/equipos.css"/>
    <link rel="stylesheet" href="../css/heading.css"/>
</head>

<body class="body--margin">
    <?php
    include '../header.html';
    require_once "../bootstrap.php";
    require_once '../src/Entity/Equipo.php';
    require_once '../src/Entity/Entrenador.php';
    $equipos = $entityManager->getRepository('Equipo')->findAll();
    ?>
    <div class="heading">
        <h1 class="heading__txt">Equipos</h1>
    </div>
    <div class="equipos">
    <?php
    foreach($equipos as $equipo){
        $nombre = strtolower($equipo->getNombre());
        $img;
        if(stripos($nombre, "playa") == true){
            $img = "fondoPlaya.png";
        }else{
            $img = "fondoPista.png";
        }
        ?>
        <div class="equipo" onclick="window.location.href = './jugadores.php?team=<?php echo $equipo->getIdequipo(); ?>';">
            <div class="equipo__fondo">
                <img src="<?php echo ROOT_PATH; ?>/images/background/equipos/<?php echo $img; ?>">
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