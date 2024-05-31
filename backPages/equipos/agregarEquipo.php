<?php
if(!defined("ROOT")){
        include '../../config.php';
    }
    include ROOT.'/compruebaSesion.php';
    require_once ROOT."/bootstrap.php";
    require_once ROOT.'/src/Entity/Equipo.php';
    require_once ROOT.'/src/Entity/Entrenador.php';
$entrenadores = $entityManager->getRepository('Entrenador')->findAll();
$result;


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    try {
        if($_POST["imgChange"]){
            if ($_FILES['img']['error'] === UPLOAD_ERR_OK) {
                // Obtener información del archivo cargado
                $nombre_temporal = $_FILES['img']['tmp_name'];
                $nombre_archivo = $_FILES['img']['name'];

                // Directorio donde se guardará la imagen (ajusta la ruta según tus necesidades)
                $directorio_destino = ROOT.'/images/equipos/';

                // Mover el archivo cargado al directorio de destino
                $ruta_destino = $directorio_destino . $nombre_archivo;
                if (move_uploaded_file($nombre_temporal, $ruta_destino)) {
                    $img = ROOT_PATH.'/images/equipos/'.$nombre_archivo;
                } else {
                    header("location:equipos.php?err=1");
                }
            } else {
                header("location:equipos.php?err=1");
            }
        }
        
        $nuevo = new Equipo();
        $nuevo->setNombre($_POST["nombre"]);
        if($_POST["imgChange"]){
            $result->setImagen($img);
        }
        $nuevo->setCategoria($_POST["categoria"]);
        $entrenador = $entityManager->getRepository('Entrenador')->find($_POST["entrenador"]);
        $nuevo->setDnientrenador($entrenador);
        $entityManager->persist($nuevo);
        $entityManager->flush();

        header("location:equipos.php?err=0");
    } catch (PDOException $e) {
        header("location:equipos.php?err=1");
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
    <link rel="stylesheet" href="<?php echo ROOT_PATH;?>/css/app.css">
    <link rel="stylesheet" href="<?php echo ROOT_PATH;?>/css/backCss/checkbox.css">
    <link rel="stylesheet" href="<?php echo ROOT_PATH;?>/css/backCss/forms.css"/>
    <script src="<?php echo ROOT_PATH;?>/backJs/enableImg.js"></script>
</head>

<body class="body--margin">
    <?php
    include '../gestionHeader.php';
    include ROOT.'/backPages/goBack.php';
    ?>
    <form class="form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
        <div class="form__title">Añadir equipo</div>
        <div class="form__group">
            <label for="nombre" class="form__label">Nombre:</label>
            <input placeholder="Nombre" required autocomplete="off" type="text" name="nombre" id="nombre" class="form__input"><br><br>
        </div>
        <div class="form__group"></div>
        <div class="form__group">
            <label for="categoria" class="form__label">Categoria:</label>
            <input placeholder="Categoria" required autocomplete="off" type="text" name="categoria" id="categoria" class="form__input"><br><br>
        </div>
        <div class="form__group">
            <label for="entrenador" class="form__label">Entrenador:</label>
            <select required type="text" name="entrenador" id="entrenador" class="form__input">
                <option value="" disabled selected hidden>Selecciona un entrenador</option>
                <?php
                foreach ($entrenadores as $entrenador) {
                ?>
                <option value="<?php echo $entrenador->getDnientrenador(); ?>">
                    <?php echo $entrenador->getNombre(); ?>
                </option>
                <?php
                }
                ?>
            </select><br><br>
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
            <input autocomplete="off" type="file" name="img" id="img" accept="image/*"
                class="form__input form__input--file">
        </div>
        <input class="form__submit" type="submit" value="Guardar">
    </form>
</body>

</html>