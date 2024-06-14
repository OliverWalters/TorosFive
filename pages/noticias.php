<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../images/icono.png" type="image/*">
    <title>Noticias - Toro's Five</title>
    <link rel="stylesheet" href="../css/app.css">
    <link rel="stylesheet" href="../css/noticias.css"/>
    <link rel="stylesheet" href="../css/heading.css"/>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    
    
</head>

<body class="body--margin">
    <?php
        include '../header.html';
        require_once "../bootstrap.php";
        require_once '../src/Entity/Noticia.php';

        $noticias = $entityManager->getRepository('Noticia')->findAll();
        
        function ordenarFecha($a, $b) {
            return strtotime($b->getFecha()->format('Y-m-d')) - strtotime($a->getFecha()->format('Y-m-d'));
        }
        // Ordenar el array usando usort, seegun establecido en mi funcion 
        usort($noticias, 'ordenarFecha');
    ?>
        <div class="heading">
            <h1 class="heading__txt">Noticias</h1>
        </div>
    <?php
        foreach($noticias as $noticia){
    ?>
    
    <div class="noticia">
        <div class="noticia__img__contenedor"> 
        <img src="<?php 
                    if($noticia->getImagen()==null){
                        echo "https://fikrirasyid.com/wp-content/uploads/2016/10/placeholder-portrait-3-4-56158_1080x675.jpg";
                    }
                    else{
                        echo $noticia->getImagen();
                    }
                    
                ?>" class="noticia__img">
        </div>
        <div class="noticia__contendor">
            <h3 class="noticia__titulo"><?php echo $noticia->getNombre(); ?></h3>
            <p class="noticia__fecha"><?php echo $noticia->getFecha()->format('Y-m-d'); ?></p>
            <p class="noticia__txt"><?php echo $noticia->getDescripcion(); ?></p>
        </div>
    </div>
    
    <?php
        }
    ?>
    <!-- 
    <div class="proximo">
        <h3 class="proximo__titulo">Proximamente</h3>
        <div class="evento evento--proximo">
            <img src="" class="evento__img">
            <div class="evento__contendor">
                <h3 class="evento__titulo"></h3>
                <p class="evento__fecha"></p>
                <p class="evento__txt"></p>
            </div>
        </div>
    </div>
    -->
<?php
    include './footer.html';
?>
</body>

</html>

