<?php
if(!defined("ROOT")){
    include '../../config.php';
}
include ROOT.'/compruebaSesion.php';
require_once ROOT."/bootstrap.php";
require_once ROOT.'/src/Entity/Entrenador.php';
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
                $directorio_destino = ROOT.'/images/entrenadores/';

                // Mover el archivo cargado al directorio de destino
                $ruta_destino = $directorio_destino . $nombre_archivo;
                if (move_uploaded_file($nombre_temporal, $ruta_destino)) {
                    $img = ROOT_PATH.'/images/entrenadores/'.$nombre_archivo;
                } else {
                    header("location:entrenadores.php?err=1");
                }
            } else {
                header("location:entrenadores.php?err=1");
            }
        }
        
        $nuevo = new Entrenador();
        $nuevo->setDnientrenador($_POST["dni"]);
        if($_POST["imgChange"]){
            $nuevo->setImagen($img);
        }
        $nuevo->setNombre($_POST["nombre"]);
        $nuevo->setUsuario($_POST["usuario"]);
        $nuevo->setClave($_POST["clave"]); 
        $nuevo->setNacimiento(new DateTime($_POST["nac"]));
        $entityManager->persist($nuevo);
        if($_POST["clave"] != $_POST["repe"]){
            header("location:entrenadores.php?err=1");
        }
        else{
            $entityManager->flush();
            header("location:entrenadores.php?err=0");
        }
    } catch (PDOException $e) {
        header("location:entrenadores.php?err=1");
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
        <link rel="stylesheet" href="<?php echo ROOT_PATH;?>/css/backCss/checkbox.css">
    </head>
    <body class="body--margin">
        <?php
            include '../gestionHeader.php';
            
        ?>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" enctype="multipart/form-data">
            DNI:
            <input required autocomplete="off" type="text" name="dni" id="dni"><br><br>
            Nombre:
            <input required autocomplete="off" type="text" name="nombre" id="nombre" ><br><br>
            Usuario:
            <input required autocomplete="off" type="text" name="usuario" id="usuario" ><br><br>
            Clave:
            <input required autocomplete="off" type="password" name="clave" id="clave" ><br><br>
            Repita clave:
            <input required autocomplete="off" type="password" name="repe" id="repe" ><br><br>
            Nacimiento:
            <input required autocomplete="off" type="date" name="nac" id="nac" ><br><br>
            Cambiar imagen:
            <div class="checkbox-wrapper-59">
                <label for="imgChange" class="switch" >
                    <input type="checkbox" name="imgChange" id="imgChange">
                    <span class="slider"></span>
                </label>
            </div><br><br>
            <label for="img">Imagen:
            <input required autocomplete="off" type="file" name="img" id="img" accept="image/*" ><br><br>
            </label>
            <input type="submit" value="Guardar">
        </form>
    </body>
    <script src="<?php echo ROOT_PATH;?>/backJs/enableImg.js"></script>
</html>