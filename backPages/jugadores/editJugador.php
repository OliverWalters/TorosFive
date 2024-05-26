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
$result;
$img = "";

if($_SERVER["REQUEST_METHOD"] == "GET"){
    $result = $entityManager->getRepository('Jugador')->find($_GET["jug"]);
}
    
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $result = $entityManager->getRepository('Jugador')->find($_GET["jug"]);
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
                    $img = $ruta_destino;
                } else {
                    header("location:agregarJugador.php?err=1");
                }
            } else {
                header("location:agregarJugador.php?err=1");
            }
        }
        
        
        $result->setDnijugador($_POST["dni"]);
        if($_POST["imgChange"]){
            $result->setImagen($img);
        }
        $result->setNombre($_POST["nombre"]);
        $result->setPosicion($_POST["posicion"]);
        $result->setNacimiento(new DateTime($_POST["nac"]));
        $entityManager->persist($result);
        $entityManager->flush();
        
        header("location:jugadores.php?err=0");
    } catch (PDOException $e) {
        header("location:agregarJugador.php?err=1");
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
        <script src="<?php echo ROOT_PATH;?>/backJs/enableImg.js"></script>
    </head>
    <body class="body--margin">
        <?php
            include '../gestionHeader.php';
            if(isset($_GET["err"])){
                if($_GET["err"] == "1"){
                    print "<div class='error'><h3>ERROR AL AGREGAR UN EQUIPO</h3><p>Inténtelo de nuevo</p></div>";
                }
            }
            
        ?>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])."?jug=".$_GET["jug"];?>" method="post" enctype="multipart/form-data">
            DNI:
            <input required autocomplete="off" type="text" name="dni" id="dni" pattern="[0-9]{8}[A-Za-z]{1}" value="<?php echo $result->getDnijugador();?>"><br><br>
            Nombre:
            <input required autocomplete="off" type="text" name="nombre" id="nombre" value="<?php echo $result->getNombre();?>"><br><br>
            Posición:
            <input required autocomplete="off" type="text" name="posicion" id="posicion" value="<?php echo $result->getPosicion();?>"><br><br>
            Nacimiento:
            <input required autocomplete="off" type="date" name="nac" id="nac" value="<?php echo $result->getNacimiento()->format('Y-m-d');?>"><br><br>
            Cambiar imagen:
            <div class="checkbox-wrapper-59">
                <label class="switch" >
                    <input type="checkbox" name="imgChange" id="imgChange">
                    <span class="slider"></span>
                </label>
            </div><br><br>
            Imagen:<!-- TODO if checked disable -->
            <input autocomplete="off" type="file" name="img" id="img" accept="image/*" value="<?php echo "..".$result->getImagen();?>"><br><br>
            
            <input type="submit" value="Guardar">
        </form>
    </body>
</html>