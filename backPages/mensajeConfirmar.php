<?php
if(!defined("ROOT")){
    include '../config.php';
}
?>
<link rel="stylesheet" href="<?php echo ROOT_PATH.'/css/backCss/confirmar.css';?>">
<div class="exterior ocultar">
    <div class="alerta">
        <div class="alerta__formato">
            <div class="alerta__titulo">CONFIRMAR</div>
            <hr>
            <div class="alerta__txt">¿Seguro que quieres borrar? Estos datos no se podrán recuperar.</div>
            <div class="alerta__btn">
                <button class="btn btn--neutro">Cancelar</button>
                <button class="btn btn--red">Borrar</button>
            </div>
        </div>
    </div>
</div>
<script>
    const btns = document.querySelectorAll('.btn');
    const exterior = document.querySelector('.exterior');
    const alerta = document.querySelector('.alerta');
    const cancelar = btns[0];
    const borrar = btns[1];
    let url = "";
    function mensajeConfirmar(borrar) {
        url = borrar;
        exterior.classList.remove('ocultar');

        setTimeout(() => {
            alerta.classList.add('aparecer');
        }, 100);
    }


    cancelar.addEventListener('click', () => {
        alerta.classList.remove('aparecer');
        setTimeout(() => {
            exterior.classList.add('ocultar');
        }, 300);

    });

    borrar.addEventListener('click', () => {
        alerta.classList.remove('aparecer');
        setTimeout(() => {
            exterior.classList.add('ocultar');
        }, 300);
        window.location.href=url;
    });
    
</script>

