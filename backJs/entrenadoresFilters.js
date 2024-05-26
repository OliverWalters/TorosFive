$(document).ready(function () {
    filterData();
    /*$('#form').submit(function(e) {
        e.preventDefault();
        filterData();
    });*/
});
function filterData(num) {
    var nombre = $('#nombre').val();
    var usuario = $('#usuario').val();

    $.ajax({
        type: "POST",
        url: "../../backAjax/entrenadoresSubmit.php",
        data: {
            nombre: nombre,
            usuario: usuario
        },
        success: function (response) {
            $('#table').html(response);
        }
    });
}

function reset() {
    var currentUrl = window.location.href;
    if (currentUrl.includes("?entr=")) {
        window.location.href = "entrenadores.php"
    }
    document.getElementById("form").reset();
    filterData();
}


