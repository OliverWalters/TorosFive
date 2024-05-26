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
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo ROOT_PATH;?>/css/app.css">
    <link rel="stylesheet" href="<?php echo ROOT_PATH;?>/css/backCss/tablas/tablaEquipos.css">
    <link rel="stylesheet" href="<?php echo ROOT_PATH;?>/css/backCss/tabla.css">
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="<?php echo ROOT_PATH;?>/backJs/equiposFilters.js"></script>
</head>

<body class="body--margin">
    <?php
    include '../gestionHeader.php';
    include '../mensajeConfirmar.php';
    $equipos = $entityManager->getRepository('Equipo')->findAll();
    if (isset($_GET["err"])) {
        if ($_GET["err"] == "1") {
            print "<div class='error'><h3>HA HABIDO UN ERROR AL BORRAR</h3><p>Inténtelo de nuevo</p><br><br></div>";
        }
    }
    ?>

    
    <div class="tbl">
    <h2 class="tbl__title">Gestión de equipos <small class="tbl__subtitle"></small></h2>
    <form id="form" class="tbl__form">
      <div class="tbl__form__group">
        <label for="nombre">Nombre:</label>
        <input autocomplete="off" type="text" name="nombre" id="nombre" onkeyup="filterData()">
      </div>
      <div class="tbl__form__group">
        <label for="categoria">Categoria:</label>
        <select name="categoria" id="categoria"  onchange="filterData()">
          <option value=""></option>
          <?php
            foreach ($equipos as $equipo) {
            ?>
                <option value="<?php echo $equipo->getCategoria(); ?>"><?php echo $equipo->getCategoria(); ?></option>
            <?php
            }
            ?>
        </select>
      </div>
      <div class="tbl__form__group">
        <label for="entrenador">Entrenador:</label>
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
        </select>
      </div>
    </form>
    <button id="reset" onclick="reset()">Reset <i class="fa-solid fa-arrows-rotate"></i></button>
    <button class="tbl__btn__add" onclick="window.location.href='agregarEquipo.php';">Añadir equipo <i class="fa-solid fa-user-plus"></i> </button>
    
    <ul class="tbl__list" id="table">
    </ul>
</div>
</body>

</html>