$(document).ready(function () {
    filterData();
    /*$('#form').submit(function(e) {
        e.preventDefault();
        filterData();
    });*/
});
function filterData(num) {
    var nombre = $('#nombre').val();
    var equipo = $('#equipo').val();
    var posicion = $('#posicion').val();
    var fecha = $('#fecha').val();

    $.ajax({
        type: "POST",
        url: "../../backAjax/jugadoresSubmit.php",
        data: {
            nombre: nombre,
            equipo: equipo,
            posicion: posicion,
            fecha: fecha
        },
        success: function (response) {
            $('#table').html(response);
        }
    });
}

function reset() {
    var currentUrl = window.location.href;
    if (currentUrl.includes("?team=")) {
        window.location.href = "jugadores.php"
    }
    document.getElementById("form").reset();
    filterData();
}


