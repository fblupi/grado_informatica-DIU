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
	var horaEntrada = $('#horaEntrada').val();
	var fechaSalida = $('#fechaSalida').val();
	var horaSalida = $('#horaSalida').val();
	var parametros = {
			search : busqueda,
			capacidadMin : capacidadMin,
			capacidadMax : capacidadMax,
			fechaEntrada : fechaEntrada,
			horaEntrada : horaEntrada,
			fechaSalida : fechaSalida,
			horaSalida : horaSalida
	};
	$.ajax({
					data:  parametros,
					url:   'scripts/mostrarSalas.php',
					type:  'GET',
					success:  function (response) {
									$("#resultadosSalas").html(response);
                  $('table').stacktable();
					}
	});
}

function MostrarSalasDisponiblesEmpresas(id) {
  if(document.getElementById("resultadoEscondido"+id).className==""){
    document.getElementById("resultadoEscondido"+id).className="resultadoEscondido"
  }else{
    document.getElementById("resultadoEscondido"+id).className="";
    var idEmpresa = id;
    var parametros = {
  			idEmpresa : idEmpresa
  	};
  	$.ajax({
  					data:  parametros,
  					url:   'scripts/asignarSalaEmpresa.php',
  					type:  'GET',
  					success:  function (response) {
  									$("#resultado"+idEmpresa).html(response);
                    $('table').stacktable();
  					}
  	});
  }
}

function AsignarSala(idSala, idEmpresa) {
  var parametros = {
      idSala : idSala,
      idEmpresa : idEmpresa
  };
  $.ajax({
          data:  parametros,
          url:   'scripts/asignarSala.php',
          type:  'GET',
          success:  function (response) {
              document.getElementById("resultadoEscondido"+idEmpresa).className="resultadoEscondido";
              $("#resultado").html(response);
          }
  });
}
