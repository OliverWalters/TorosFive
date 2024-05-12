$(document).ready(function () {
    filterData();
    $('#form').submit(function (e) {
        e.preventDefault();
        filterData();
    });
});
function filterData() {
    var nombre = $('#nombre').val();
    var categoria = $('#categoria').val();
    var entrenador = $('#entrenador').val();
    console.log("hola")
    $.ajax({
        type: "POST",
        url: "../../backAjax/equiposSubmit.php",
        data: {
            nombre: nombre,
            categoria: categoria,
            entrenador: entrenador
        },
        success: function (response) {
            $('#table tbody').html(response);
        }
    });
}

function reset() {
    document.getElementById("form").reset();
    filterData();
}
