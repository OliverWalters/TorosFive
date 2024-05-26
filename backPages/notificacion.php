<link rel="stylesheet" href="<?php echo ROOT_PATH;?>/css/backCss/notificacion.css">
<div class="notification">
    <div class="notification__item notification--acierto">
        <button class="notification__item__btn" onclick="quitar(0)"><i class="x fa-solid fa-xmark"></i></button>
        <div class="notification__item__title">ÉXITO</div>
        <div class="notification__item__txt">Se ha realizado la operacion con éxito.</div>
    </div>
</div>
<div class="notification">
    <div class="notification__item notification--error">
        <button class="notification__item__btn" onclick="quitar(1)"><i class="x fa-solid fa-xmark"></i></button>
        <div class="notification__item__title">ERROR</div>
        <div class="notification__item__txt">Intentelo de nuevo más tarde o compruebe que todo esta correcto.</div>
    </div>
</div>
<script>
    function quitar(num) {
        document.getElementsByClassName("notification")[num].classList.remove("saltar")
    }

    function mostrar(num) {
        if (document.getElementsByClassName("notification")[0] != null || document.getElementsByClassName("notification")[1] != null) {
            document.getElementsByClassName("notification")[0].classList.remove("saltar")
            document.getElementsByClassName("notification")[1].classList.remove("saltar")
        }
        document.getElementsByClassName("notification")[num].classList.add("saltar")
        setTimeout(() => {
            quitar(num);
        }, 5000);
    }
</script>
<style>
    .notification--error {
        background-image: url(<?php echo ROOT_PATH;?>/images/iconos/err.png) !important;
        background-color: #e7505a;
    }

    .notification--acierto {
        background-image: url(<?php echo ROOT_PATH;?>/images/iconos/tick.png) !important;
        background-color: #26c281;
    }
</style>

