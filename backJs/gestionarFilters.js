function listarJugadores(num) {
    var nombre = $('#nombreJug').val();
    var excepto = num;

    $.ajax({
        type: "POST",
        url: `../../backAjax/gestionSubmit.php?team=${num}`,
        data: {
            nombre: nombre,
            excepto: excepto
        },
        success: function (response) {
            $('#tblJug').html(response);
        }
    });
}

function listarEquipo(num) {
    var nombre = $('#nombreJugEq').val();
    var equipo = num;
    
    $.ajax({
        type: "POST",
        url: `../../backAjax/gestionSubmit.php?team=${num}`,
        data: {
            nombre: nombre,
            equipo: equipo
        },
        success: function (response) {
            $('#tblJugEq').html(response);
        }
    });
}

