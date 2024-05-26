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
$jugadoras = $entityManager->getRepository('Jugador')->findAll();
$equipos = $entityManager->getRepository('Equipo')->findAll();


?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="<?php echo ROOT_PATH;?>/css/app.css">
        <link rel="stylesheet" href="<?php echo ROOT_PATH;?>/css/backCss/tablas/tablaJugadores.css">
        <link rel="stylesheet" href="<?php echo ROOT_PATH;?>/css/backCss/tabla.css">
        <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
        <script src="<?php echo ROOT_PATH;?>/backJs/jugadoresFilters.js"></script>
    </head>
    <body class="body--margin">
        <?php
            include '../gestionHeader.php';
            if(isset($_GET["err"])){
                if($_GET["err"] == "1"){
                    print "<div class='error'><h3>ERROR AL EDITAR LOS DATOS</h3><p>Inténtelo de nuevo</p><br><br></div>";
                }
            }
            
        ?>
    

<div class="tbl">
    <h2 class="tbl__title">Gestión de jugadores<small class="tbl__subtitle"></small></h2>
    <form id="form" class="tbl__form">
      <div class="tbl__form__group">
        <label for="nombre">Nombre:</label>
        <input autocomplete="off" type="text" name="nombre" id="nombre" onkeyup="filterData()">
      </div>
      <div class="tbl__form__group">
        <label for="equipo">Equipo:</label>
        <select name="equipo" id="equipo" onchange="filterData()">
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
      </div>
      <div class="tbl__form__group">
        <label for="posicion">Posición:</label>
        <select name="posicion" id="posicion" onchange="filterData()">
          <option value=""></option>
          <?php
            foreach($jugadoras as $jugador){
                ?>
                <option value="<?php echo $jugador->getPosicion(); ?>"><?php echo $jugador->getPosicion();?></option>
                <?php
            }
        ?>
        </select>
      </div>
    </form>
    <button id="reset" onclick="reset()">Reset <i class="fa-solid fa-arrows-rotate"></i></button>
    <button class="tbl__btn__add" onclick="window.location.href='agregarJugador.php';">Añadir jugador <i class="fa-solid fa-user-plus"></i> </button>
    <ul class="tbl__list" id="table">
    </ul>
</div>
</body>
</html>