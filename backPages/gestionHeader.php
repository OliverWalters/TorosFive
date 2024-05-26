<?php 
if(!defined("ROOT")){
    include '../config.php';
}

?>
<link rel="stylesheet" href="<?php echo ROOT_PATH.'/css/backCss/gestionHeader.css';?>"/>
<header class="header">
    <div class="header__container">
        <div class="logo">
            <a href="<?php echo ROOT_PATH.'/backPages/listaGestion.php';?>"><img src="<?php echo ROOT_PATH.'/images/Logo.png';?>" alt="Logo" class="logo__image"></a>
        </div>
        <div class="controls">
            <div class="menu">
                <button class="menu__button">
                    <i class="fa-solid fa-bars menu__icon" style="color: #ffffff;"></i>
                </button>
                <ul class="dropdown-menu menu__dropdown">
                    <li><a href="<?php echo ROOT_PATH.'/backPages/equipos/equipos.php';?>" class="menu__item">Equipos</a></li>
                    <li><a href="<?php echo ROOT_PATH.'/backPages/jugadores/jugadores.php';?>" class="menu__item">Jugadoras</a></li>
                    <li><a href="#" class="menu__item">Eventos</a></li>
                    <li><a href="#" class="menu__item">Noticias</a></li>
                    <li><a href="#" class="menu__item">Entrenadores</a></li>
                </ul>
            </div>
            <div class="user">
                <button class="user__button" onclick="window.location.href='<?php echo ROOT_PATH.'/backPages/cerrarSesion.php';?>'">
                    <img src="<?php echo ROOT_PATH.'/';?>" alt="User" class="user__button__image">
                    <h5 class="user__button__txt">Cerrar sessión</h5>
                </button>
            </div>
        </div>
    </div>
</header>


