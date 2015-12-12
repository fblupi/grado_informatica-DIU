function MostrarConsultaEmpresas() {
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

function MostrarConsultaEventos() {
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

function MostrarConsultaSalas() {
	var busqueda = $('#busqueda').val();
	var capacidadMin = $('#capacidadMin').val();
	var capacidadMax = $('#capacidadMax').val();
	var fechaEntrada = $('#fechaEntrada').val();
	var fechaE = dateFormat(fechaEntrada, "yyyy-mm-dd");
	var horaEntrada = $('#horaEntrada').val();
	var fechaSalida = $('#fechaSalida').val();
	var horaSalida = $('#horaSalida').val();
	var fechaS = dateFormat(fechaSalida, "yyyy-mm-dd");
	var parametros = {
			search : busqueda,
			capacidadMin : capacidadMin,
			capacidadMax : capacidadMax,
			fechaEntrada : fechaE,
			horaEntrada : horaEntrada,
			fechaSalida : fechaS,
			horaSalida : horaSalida
	};
	$.ajax({
					data:  parametros,
					url:   'scripts/mostrarSalas.php',
					type:  'GET',
					success:  function (response) {
									$("#resultadosSalas").html(response);
					}
	});
}
