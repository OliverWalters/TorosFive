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
        
        if ($_FILES['img']['error'] === UPLOAD_ERR_OK) {
            // Obtener información del archivo cargado
            $nombre_temporal = $_FILES['img']['tmp_name'];
            $nombre_archivo = $_FILES['img']['name'];

            // Directorio donde se guardará la imagen (ajusta la ruta según tus necesidades)
            $directorio_destino = '/images/jugadores/';

            // Mover el archivo cargado al directorio de destino
            $ruta_destino = $directorio_destino . $nombre_archivo;
            if (move_uploaded_file($nombre_temporal, "..".$ruta_destino)) {
                $img = $ruta_destino;
            } else {
                throw new Exception;//controlar error
            }
        } else {
            throw new Exception;//controlar error
        }
        
        $nuevo = new Jugador();
        $nuevo->setDnijugador($_POST["dni"]);
        $nuevo->setImagen($img);
        $nuevo->setNombre($_POST["nombre"]);
        $nuevo->setPosicion($_POST["posicion"]);
        $nuevo->setNacimiento(new DateTime($_POST["nac"]));
        $entityManager->persist($nuevo);
        $entityManager->flush();
        
        header("location:jugadores.php");
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
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" enctype="multipart/form-data">
            DNI:
            <input required autocomplete="off" type="text" name="dni" id="dni" pattern="[0-9]{8}[A-Za-z]{1}"><br><br>
            Nombre:
            <input required autocomplete="off" type="text" name="nombre" id="nombre" ><br><br>
            Posición:
            <input required autocomplete="off" type="text" name="posicion" id="posicion" ><br><br>
            Nacimiento:
            <input required autocomplete="off" type="date" name="nac" id="nac" ><br><br>
            Imagen:
            <input required autocomplete="off" type="file" name="img" id="img" accept="image/*" ><br><br>
            
            <input type="submit" value="Guardar">
        </form>
    </body>
</html>