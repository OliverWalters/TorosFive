<?php
if (!defined('ROOT_PATH')) {
    include './config.php';
}
?>

<?php echo ROOT_PATH; ?>
<link rel="stylesheet" href="<?php echo ROOT_PATH; ?>/css/app.css">
<link rel="stylesheet" href="<?php echo ROOT_PATH; ?>/css/header.css">

    <header id="header" class="header header1">
        <ul class="header__menu">
            <li class="header__menu__item"><a href="<?php echo ROOT_PATH; ?>/pages/equipos.php">Equipos</a></li>
            <li class="header__menu__item"><a href="">Eventos</a></li>
        </ul>
        <a class="header__logo" href="<?php echo ROOT_PATH; ?>/index.html"><img id="logo" class="header__logo__img1" src="<?php echo ROOT_PATH; ?>/images/logo.png"></a>
        <ul class="header__menu">
            <li class="header__menu__item"><a href="">Noticias</a></li>
            <li class="header__menu__item"><a href="">Contacto</a></li>
        </ul>
    </header>