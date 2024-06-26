<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Toro´s Five</title>
    <link rel="icon" href="./images/icono.png" type="image/*">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/app.css">
    <link rel="stylesheet" href="./css/header.css">
    <link rel="stylesheet" href="./css/index.css">
    <link rel="stylesheet" href="./css/footer.css">
</head>

<body>
    <?php
        if(!defined("ROOT")){
            include './config.php';
        }
        include ROOT.'/backPages/notificacion.php';
        if(isset($_GET["err"])){
            if($_GET["err"] == "1"){
                print "<script>setTimeout(() => { mostrar(1); }, 50);</script>";
            }
        }
    ?>
    <header id="header" class="header header2">
        <div class="hamburger">
            <div></div>
            <div></div>
            <div></div>
        </div>
        <ul class="header__menu">
            <li class="header__menu__item"><a href="./pages/equipos.php">Equipos</a></li>
            <li class="header__menu__item"><a href="./pages/eventos.php">Eventos</a></li>
        </ul>
        <a class="header__logo"><img id="logo" class="header__logo__img2" src="./images/logoFondo.png"></a>
        <ul class="header__menu">
            <li class="header__menu__item"><a href="./pages/noticias.php">Noticias</a></li>
            <li class="header__menu__item"><a href="./pages/contacto.php">Contacto</a></li>
        </ul>
        <ul class="header__menu--hamburger">
            <li class="header__menu__item"><a href="./pages/equipos.php">Equipos</a></li>
            <li class="header__menu__item"><a href="./pages/eventos.php">Eventos</a></li>
            <li class="header__menu__item"><a href="./pages/noticias.php">Noticias</a></li>
            <li class="header__menu__item"><a href="./pages/contacto.php">Contacto</a></li>
        </ul>
    </header>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        var hamburger = document.querySelector('.hamburger');
        var header = document.querySelector('.header');
        
        hamburger.addEventListener('click', function() {
            header.classList.toggle('active');
        });
    });
</script>
    <script src="./js/header.js"></script>
    <div style="overflow: hidden;">
        <img class="img" src="./images/background/fondoInicio.png">
    </div>
    <section class="info">
        <div class="info__titulo">
            <h5>Toro´s Five</h5>
        </div>
        <p class="info__txt">El modelo que perseguimos como club está claramente detallado en 4 aspectos fundamentales
            contemplados en la necesidad de fomentar valores así como la búsqueda de la calidad total.</p>
    </section>
    
    
    <section class="misionVision">
        <div class="misionVision__contenedor texto1">
            <h1 class="misionVision__titulo gradient-underline">Misión</h1>
            <p class="misionVision__txt">El propósito de la existencia de nuestro club de voleibol y voley playa en
                Ojén es
                brindar la enseñanza y práctica de un deporte específico entre la sociedad activa deportivamente.
            </p>
        </div>

        <img class="misionVision__img imagen1" src="./images/background/fondoIndex.png">
        <img class="misionVision__img imagen2" src="./images/background/fondoJoan.png">
        <div class="misionVision__contenedor texto2">
            <h1 class="misionVision__titulo">Visión</h1>
            <p class="misionVision__txt">Esperamos que con nuestro aporte a la sociedad mediante la práctica de una
                disciplina deportiva ayude a crear ciudadanos de bien con clara conciencia de coexistir y
                correlacionarse
                con su entorno social y deportivo.
            </p>
        </div>
    </section>

    <section class="valores">
        <div class="valores__img">
            <img src="./images/background/ojen.png">
        </div>
        <div class="valores__content">
            <h1 class="valores__title misionVision__titulo">Valores</h1>
            <p class="valores__txt">En el proceso de aprendizaje, desarrollo y especialización de nuestro deporte
                voleibol
                y voley playa. Las jugadoras crean y fortalecen unos valores que traen consigo en la mayoría de las
                ocasiones de otros entornos (familiares, educativos,etc) tales como son la pertenencia a un grupo, ética
                deportiva y social, respeto por sus compañeros y rivales, disciplina deportiva y mental, entre otros
                muchos no menos importantes en el sano desarrollo de las personas.</p>
        </div>
    </section>

    <section class="objetivos">
        <div class="objetivos__content">
            <h1 class="objetivos__title misionVision__titulo">Objetivos</h1>
            <p class="objetivos__txt">Para acariciar someramente este aspecto ya que es bastante extenso nos basta decir
                que
                basamos nuestros objetivos en la búsqueda del desarrollo máximo de las capacidades deportivas de cada
                individuo, entendiendo que son procesos no generalizables. También buscamos alcanzar la cohesión de
                grupo a través del entrenamiento personalizado y grupal dejando siempre en segundo plano los conceptos
                de victoria o derrota pues entendemos que nuestro potencial no puede estar limitado ni definido por
                resultados deportivos.</p>
        </div>
    </section>
    
    <footer class="footer">
    <p class="footer__item">&copy; 2024 Toro´s Five. Todos los derechos reservados.</p>
    <div class="footer__item footer__item--collapse">
        <p class="footer__item"><a href="./pages/privacidad.php">Política de privacidad</a></p>
        <p class="footer__item"><a href="./pages/cookies.php">Política de cookies</a></p>
        <p class="footer__item"><a href="./pages/terminosServicio.php">Términos de servicio</a></p>
    </div>
    <p class="footer__item"><a href="./pages/contacto.php">Contacto</a></p>
    <div class="footer__item footer__item--redes">
        <a href="https://www.instagram.com/ojenvolley/" target="_blank"><i class="fa-brands fa-instagram footer__item__red"></i></a>
        <a href="https://www.tiktok.com/@ojenvolley?lang=es" target="_blank"><i class="fa-brands fa-tiktok footer__item__red"></i></a>
        <a href="https://www.youtube.com/@voleibolojen" target="_blank"><i class="fa-brands fa-youtube footer__item__red"></i></a>
    </div>
</footer>
</body>

</html>