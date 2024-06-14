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
        <link rel="stylesheet" href="<?php echo ROOT_PATH;?>/css/backCss/tabla.css">
        <link rel="stylesheet" href="<?php echo ROOT_PATH;?>/css/backCss/tablas/tablaJugadores.css">
        <link rel="icon" href="<?php echo ROOT_PATH;?>/images/icono.png" type="image/*">
        <title>Gestión Jugadores - Toro's Five</title>
        <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
        <script src="<?php echo ROOT_PATH;?>/backJs/jugadoresFilters.js"></script>
    </head>
    <body class="body--margin">
        <?php
            include '../gestionHeader.php';
            include '../mensajeConfirmar.php';
            include '../notificacion.php';
            if(isset($_GET["err"])){
                if($_GET["err"] == "0"){
                    print "<script>setTimeout(() => { mostrar(0); }, 50);</script>";
                }
                if($_GET["err"] == "1"){
                    print "<script>setTimeout(() => { mostrar(1); }, 50);</script>";
                }
            }
            
        ?>
    

<div class="tbl">
    <h2 class="tbl__title">Gestión de jugadores<small class="tbl__subtitle"></small></h2>
    <form id="form" class="tbl__form">
      <div class="tbl__form__group">
        <input placeholder="Nombre" autocomplete="off" type="text" name="nombre" id="nombre" onkeyup="filterData()" class="tbl__form__input">
      </div>
      <div class="tbl__form__group">
        <select placeholder="Equipo" name="equipo" id="equipo" onchange="filterData()" class="tbl__form__input">
          <option value="" disabled selected hidden>Selecciona un equipo</option>
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
        <input placeholder="Posición" autocomplete="off" type="text" name="posicion" id="posicion" onkeyup="filterData()" class="tbl__form__input">
      </div>
        <div class="tbl__form__group">
            <input placeholder="Fecha" name="fecha" type="text" id="fecha" onkeyup="filterData()" class="tbl__form__input">
        </div>
    </form>
    <button id="reset" onclick="reset()" class="tbl__btn--reset tbl__btn"><i class="fa-solid fa-arrows-rotate"></i> Reset</button>
    <button class="tbl__btn--add tbl__btn" onclick="window.location.href='agregarJugador.php';"><i class="fa-solid fa-user-plus" style="margin-right:5px;"></i>  Añadir</button>
    <ul class="tbl__list" id="table">
    </ul>
</div>
</body>
</html>