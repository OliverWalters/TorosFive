<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../images/icono.png" type="image/*">
    <title>Contacto - Toro's Five</title>
    <script src="../js/map.js"></script>
    <link rel="stylesheet" href="../node_modules/leaflet/dist/leaflet.css" />
    <script src="../node_modules/leaflet/dist/leaflet.js"></script>
    <link rel="stylesheet" href="../css/app.css">
    <link rel="stylesheet" href="../css/contacto.css">
    <link rel="stylesheet" href="../css/heading.css"/>
</head>

<body class="body body--margin">
    <?php
    include '../header.html';
    require_once "../bootstrap.php";
    ?>
    <div class="heading">
        <h1 class="heading__txt">Contacto</h1>
    </div>
    <div class="container">
        <div class="container__fondo"></div>
        <div class="contacto">
            <h2 class="contacto__title">CONTACTA CON NOSOTROS</h2>
            <form action="email.php" class="contacto__form" method="POST">
                <label for="nombre" class="contacto__label">Nombre:</label>
                <input placeholder="Nombre" type="text" id="nombre" name="nombre" class="contacto__input" required autocomplete="off">
                
                <label for="email" class="contacto__label">Email:</label>
                <input placeholder="Correo" type="email" id="email" name="email" class="contacto__input" required autocomplete="off">
                
                <label for="tfn" class="contacto__label">Teléfono:</label>
                <input placeholder="Número de teléfono" type="tfn" id="tfn" name="tfn" class="contacto__input" required autocomplete="off">
                
                <label for="asunto" class="contacto__label">Asunto:</label>
                <input placeholder="Asunto" type="asunto" id="asunto" name="asunto" class="contacto__input" required autocomplete="off">
                
                <label for="mensaje" class="contacto__label">Mensaje:</label>
                <textarea placeholder="Escriba su mensaje" name="mensaje" id="mensaje" cols="30" rows="10" class="contacto__textarea" required autocomplete="off"></textarea>
                <button type="submit" class="contacto__button">Enviar</button>
            </form>
        </div>
        <div class="mapaYdatos mapaYdatos--theme">
            <div class="mapa">
                <h1 class="mapa__title">Nuestra ubicación</h1>
                <div id="map" class="mapa__map"></div>
            </div>
            <div class="info">
                <h1 class="info__title">Informacion adicional</h1>
                <p class="info__text">C/ Atalaya Nº5</p>
                <p class="info__text">Tlf: +34 628 385 555</p>
                <p class="info__social">
                    <a href="https://www.instagram.com/ojenvolley/" class="info__social-link"><i class="fab fa-instagram icono"></i></a>
                    <a href="https://www.tiktok.com/@ojenvolley?lang=es" class="info__social-link"><i class="fab fa-tiktok icono"></i></a>
                    <a href="#" class="info__social-link"><i class="fab fa-youtube icono"></i></a>
                </p>
            </div>
        </div>
    </div>
    <div class="relleno"></div>
<?php
    include './footer.html';
?>
</body>
</html>
