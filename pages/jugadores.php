<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/app.css">
    <link rel="stylesheet" href="../css/jugadores.css"/>
</head>

<body class="body--margin">
    <?php
    include '../header.html';
    require_once "../bootstrap.php";
    require_once '../src/Entity/Equipo.php';
    require_once '../src/Entity/Equipojugador.php';
    require_once '../src/Entity/Entrenador.php';
    require_once '../src/Entity/Jugador.php';
    $idequipo = $_GET["team"];
    $equipo = $entityManager->getRepository('Equipo')->find($idequipo);
    $entrenador = $entityManager->getRepository('Entrenador')->find($equipo->getDnientrenador());
    
    $query = $entityManager->createQuery(
        'SELECT j 
             FROM Jugador j
             JOIN Equipojugador ej WITH j.dnijugador = ej.dnijugador
             AND ej.idequipo = :idequipo'
        )->setParameters([
            'idequipo' =>  $idequipo
        ]);
    $jugadores = $query->getResult();
    ?>
    <div class="padre">
        <h1 class="titulo titulo--entrenador">Entrenador</h1>
        <div class="tarjeta tarjeta--entrenador">
            <div class="tarjeta__img">
                <img class="img" src="<?php if($entrenador->getImagen()!= null){echo $entrenador->getImagen();}else{ echo "https://via.placeholder.com/768x1024/eee?text=4:3";} ?>">
            </div>
            <div class="tarjeta__info">
                <h3><?php echo $entrenador->getNombre(); ?></h3>
                <p><b><?php echo $equipo->getNombre(); ?></b></p>
                <p><?php echo $entrenador->getNacimiento()->format("d-m-Y"); ?></p>
            </div>
        </div>

        <h1 class="titulo">Jugadores</h1>
        <div class="contenedor">
        <?php
        foreach($jugadores as $jugador){
            $imagen = "https://via.placeholder.com/768x1024/eee?text=4:3";
            if($jugador->getImagen() != null){
                $imagen = $jugador->getImagen();
            }
            ?>
            <div class="tarjeta">
                <div class="tarjeta__img">
                <img class="img" src="<?php echo $imagen; ?>">
            </div>
            <div class="tarjeta__info">
                <h3><?php echo $jugador->getNombre(); ?></h3>
                <p><b><?php echo $jugador->getPosicion(); ?></b></p>
                <p><?php echo $jugador->getNacimiento()->format("d-m-Y"); ?></p>
            </div>
            </div>
            <?php
        }
        ?>
        </div>
    </div>
</body>

<?php
    include './footer.html';
?>

</html>