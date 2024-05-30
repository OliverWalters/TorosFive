<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="../js/map.js"></script>
    <link rel="stylesheet" href="../node_modules/leaflet/dist/leaflet.css" />
    <script src="../node_modules/leaflet/dist/leaflet.js"></script>
    <link rel="stylesheet" href="../css/app.css">
    <link rel="stylesheet" href="../css/contacto.css">
</head>

<body class="body body--margin">
    <?php
    include '../header.html';
    require_once "../bootstrap.php";
    ?>
    <div class="container">
        <div class="container__fondo"></div>
        <div class="contacto">
            <h2 class="contacto__title">CONTACTA CON NOSOTROS</h2>
            <form action="" class="contacto__form">
                <label for="name" class="contacto__label">Nombre:</label>
                <input placeholder="Nombre" type="text" id="name" name="name" class="contacto__input" required>
                
                <label for="email" class="contacto__label">Email:</label>
                <input placeholder="Correo" type="email" id="email" name="email" class="contacto__input" required>
                
                <label for="tfn" class="contacto__label">Teléfono:</label>
                <input placeholder="Número de teléfono" type="tfn" id="tfn" name="tfn" class="contacto__input" required>
                
                <label for="message" class="contacto__label">Mensaje:</label>
                <textarea placeholder="Escriba su mensaje" name="message" id="message" cols="30" rows="10" class="contacto__textarea" required></textarea>
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
                <p class="info__text">C/ Torrente Ballester</p>
                <p class="info__text">Tlf: +34 626 044 659</p>
                <p class="info__social">
                    <a href="#" class="info__social-link"><i class="fab fa-instagram icono"></i></a>
                    <a href="#" class="info__social-link"><i class="fab fa-tiktok icono"></i></a>
                    <a href="#" class="info__social-link"><i class="fab fa-youtube icono"></i></a>
                </p>
            </div>
        </div>
    </div>

</body>
</html>
