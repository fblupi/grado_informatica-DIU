function MostrarConsultaEmpresas(){
    var busqueda = $('#busqueda').val();
    var parametros = {
        search : busqueda
    };
    $.ajax({
            data:  parametros,
            url:   'scripts/mostrarEmpresas.php',
            type:  'GET',
            success:  function (response) {
                    $("#todasEmpresas").html(response);
            }
    });
}

function MostrarConsultaEventos(){
    var busqueda = $('#busqueda').val();
    var parametros = {
        search : busqueda
    };
    $.ajax({
            data:  parametros,
            url:   'scripts/mostrarEventos.php',
            type:  'GET',
            success:  function (response) {
                    $("#todosEventos").html(response);
            }
    });
}
