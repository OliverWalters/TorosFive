<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../images/icono.png" type="image/*">
    <title>Jugadores - Toro's Five</title>
    <link rel="stylesheet" href="../css/app.css">
    <link rel="stylesheet" href="../css/jugadores.css"/>
    <link rel="stylesheet" href="../css/heading.css"/>
</head>

<body class="body--margin">
    <?php
    if(!defined("ROOT")){
        include '../config.php';
    }
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
    
    // Ordenar el array
    function ordenarPorNombre($a, $b) {
        return strcmp($a->getPosicion(), $b->getPosicion());
    }
    usort($jugadores, 'ordenarPorNombre');
    ?>
    <div class="heading">
        <h1 class="heading__txt"><?php echo $equipo->getNombre(); ?></h1>
    </div>
    <div class="padre">
        <h1 class="titulo titulo--entrenador">Entrenador</h1>
        <div class="tarjeta__padre tarjeta--entrenador">
            <div class="tarjeta">
                <div class="tarjeta__img">
                    <img class="img" src="<?php if($entrenador->getImagen()!= null){echo $entrenador->getImagen();}else{ echo ROOT_PATH."/images/jugDef.png";} ?>">
                </div>
                <div class="tarjeta__info">
                    <h3><?php echo $entrenador->getNombre(); ?></h3>
                    <p><?php echo $equipo->getNombre(); ?></p>
                    <p><?php echo $entrenador->getNacimiento()->format("d-m-Y"); ?></p>
                </div>
            </div>
        </div>
        
        <h1 class="titulo">Jugadores</h1>
        <div class="contenedor">
        <?php
        foreach($jugadores as $jugador){
            $imagen = ROOT_PATH."/images/jugDef.png";
            if($jugador->getImagen() != null){
                $imagen = $jugador->getImagen();
            }
            ?>
            <div class="tarjeta__padre">
                <div class="tarjeta">
                    <div class="tarjeta__img">
                    <img class="img" src="<?php echo $imagen; ?>">
                    </div>
                    <div class="tarjeta__info">
                        <h3><?php echo $jugador->getNombre(); ?></h3>
                        <p><?php echo $jugador->getPosicion(); ?></p>
                        <p class="tarjeta__info__big"><?php echo $jugador->getNumero(); ?></p>
                    </div>
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