<?php
include '../compruebaSesion.php';
require_once "../bootstrap.php";
require_once '../src/Entity/Equipo.php';
require_once '../src/Entity/Jugador.php';
require_once '../src/Entity/Entrenador.php';
require_once '../src/Entity/Equipojugador.php';
$jugadoras = $entityManager->getRepository('Jugador')->findAll();
$equipos = $entityManager->getRepository('Equipo')->findAll();


?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/app.css">
        <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
        <script src="../backJs/jugadoresFilters.js"></script>
    </head>
    <body class="body--margin">
        <?php
            include 'gestionHeader.html';
            if(isset($_GET["err"])){
                if($_GET["err"] == "1"){
                    print "<div class='error'><h3>ERROR AL EDITAR LOS DATOS</h3><p>Inténtelo de nuevo</p><br><br></div>";
                }
            }
            
        ?>
<form id="form">
    Nombre:
    <input autocomplete="off" type="text" name="nombre" id="nombre" onkeyup="filterData()"><br><br>
    Equipo:
    <select type="text" name="equipo" id="equipo" onchange="filterData()">
        <option value=""></option>
         <?php
            foreach($equipos as $equipo){
                //$nombreEquipo = $entityManager->getRepository('Equipo')->find($equipo->getIdequipo());
                 if(isset($_GET["team"])){
                     if($_GET["team"] == $equipo->getIdequipo()){
                        ?>
                           <option selected="true" value="<?php echo $equipo->getIdequipo(); ?>"><?php echo $equipo->getNombre();?> </option>
                        <?php
                    }else{
                        ?>
                            <option value="<?php echo $equipo->getIdequipo(); ?>"><?php echo $equipo->getNombre();?> </option>
                        <?php
                    }
                 }else{
                     ?>
                        <option value="<?php echo $equipo->getIdequipo(); ?>"><?php echo $equipo->getNombre();?> </option>
                    <?php
                 }
                
            }
     
        ?>
    </select>
    <br><br>
    Posición:
    <select type="text" name="posicion" id="posicion" onchange="filterData()">
        <option value=""></option>
        <?php
            foreach($jugadoras as $jugador){
                ?>
                <option value="<?php echo $jugador->getPosicion(); ?>"><?php echo $jugador->getPosicion();?></option>
                <?php
            }
        ?>
    </select><br><br>
</form>
<button id="reset" onclick="reset()">Reset</button>
<button onclick="window.location.href='agregarJugador.php';">Añadir jugador</button>
<table id="table">
    <thead>
        <tr><td>Nombre</td>
            <td>Posicion</td>
            <td>Editar</td>
            <td>Eliminar</td>
        </tr>
    </thead>
    <tbody></tbody>
</table>
</body>
</html>