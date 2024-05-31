<?php
if(!defined("ROOT")){
    include '../../config.php';
}
include ROOT.'/compruebaSesion.php';
require_once ROOT."/bootstrap.php";
require_once ROOT.'/src/Entity/Equipo.php';
require_once ROOT.'/src/Entity/Jugador.php';
require_once ROOT.'/src/Entity/Equipojugador.php';
$result;
$img = "";
    
    
if($_SERVER["REQUEST_METHOD"] == "POST"){
    
    try {
        if($_POST["imgChange"]){
            if ($_FILES['img']['error'] === UPLOAD_ERR_OK) {
                // Obtener información del archivo cargado
                $nombre_temporal = $_FILES['img']['tmp_name'];
                $nombre_archivo = $_FILES['img']['name'];

                // Directorio donde se guardará la imagen (ajusta la ruta según tus necesidades)
                $directorio_destino = ROOT.'/images/jugadores/';

                // Mover el archivo cargado al directorio de destino
                $ruta_destino = $directorio_destino . $nombre_archivo;
                if (move_uploaded_file($nombre_temporal, $ruta_destino)) {
                    $img = ROOT_PATH.'/images/jugadores/'.$nombre_archivo;
                } else {
                    header("location:jugadores.php?err=1");
                }
            } else {
                header("location:jugadores.php?err=1");
            }
        }
        
        $nuevo = new Jugador();
        $nuevo->setDnijugador($_POST["dni"]);
        if($_POST["imgChange"]){
            $nuevo->setImagen($img);
        }
        $nuevo->setNombre($_POST["nombre"]);
        $nuevo->setPosicion($_POST["posicion"]);
        $nuevo->setNacimiento(new DateTime($_POST["nac"]));
        $entityManager->persist($nuevo);
        $entityManager->flush();
        
        header("location:jugadores.php?err=0");
    } catch (PDOException $e) {
        header("location:jugadores.php?err=1");
        //echo 'Error al conectar: ' . $e->getMessage();
    }
    
}
    
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../../css/app.css">
        <link rel="stylesheet" href="<?php echo ROOT_PATH;?>/css/backCss/forms.css"/>
        <link rel="stylesheet" href="<?php echo ROOT_PATH;?>/css/backCss/checkbox.css">
    </head>
    <body class="body--margin">
        <?php
            include '../gestionHeader.php';
            include ROOT.'/backPages/goBack.php';
        ?>
        <form class="form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post" enctype="multipart/form-data">
            <div class="form__title">Añadir jugadora</div>
            <div class="form__group">
                <label for="dni" class="form__label">DNI:</label>
                <input placeholder="DNI" required autocomplete="off" type="text" name="dni" id="dni" class="form__input"><br><br>
            </div>
            <div class="form__group">
                <label for="nombre" class="form__label">Nombre:</label>
                <input placeholder="Nombre" required autocomplete="off" type="text" name="nombre" id="nombre" class="form__input"><br><br>
            </div>
            <div class="form__group">
                <label for="posicion" class="form__label">Posición:</label>
                <input placeholder="Posicion" required autocomplete="off" type="text" name="posicion" id="posicion" class="form__input"><br><br>
            </div>
            <div class="form__group">
                <label for="nac" class="form__label">Nacimiento:</label>
                <input required autocomplete="off" type="date" name="nac" id="nac" class="form__input"><br><br>
            </div>
            <div class="form__group">
                <label class="form__label">Cambiar imagen:</label>
                <div class="checkbox-wrapper-59">
                    <label for="imgChange" class="switch">
                        <input type="checkbox" name="imgChange" id="imgChange">
                        <span class="slider"></span>
                    </label>
                </div><br><br>
            </div>
            <div class="form__group">
                <label for="img" class="form__label">Imagen:</label>

                <!--
                <div class="file-input-container">
                    <button class="custom-file-input-button">Seleccionar Archivo</button>
                    <input required autocomplete="off" type="file" name="img" id="img" accept="image/*" class="form__input form__input--file custom-file-input">
                </div>
                -->
                <input required autocomplete="off" type="file" name="img" id="img" accept="image/*" class="form__input form__input--file">

            </div>
            <input class="form__submit" type="submit" value="Guardar">
        </form>
    </body>
    <script src="<?php echo ROOT_PATH;?>/backJs/enableImg.js"></script>
</html>