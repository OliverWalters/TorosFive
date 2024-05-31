$(document).ready(function () {
    filterData();
    /*$('#form').submit(function(e) {
        e.preventDefault();
        filterData();
    });*/
});
function filterData(num) {
    var nombre = $('#nombre').val();
    var fecha = $('#fecha').val();

    $.ajax({
        type: "POST",
        url: "../../backAjax/noticiasSubmit.php",
        data: {
            nombre: nombre,
            fecha: fecha
        },
        success: function (response) {
            $('#table').html(response);
        }
    });
}

function reset() {
    var currentUrl = window.location.href;
    if (currentUrl.includes("?not=")) {
        window.location.href = "noticias.php"
    }
    document.getElementById("form").reset();
    filterData();
}


