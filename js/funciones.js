function compruebaContacto()
{

	var nombre = document.getElementById('nombre');
	var email = document.getElementById('email');
	var mensaje = document.getElementById('mensaje');

	if(nombre.value == "" || email.value == "" || mensaje.value == "")
	{
		alert('Los campos con asterisco son obligatorios.');
	}
	else document.contactoForm.submit();

}

function compruebaOracion()
{

	var mensaje = document.getElementById('mensaje');

	if(mensaje.value == "")
	{
		alert('Los campos con asterisco son obligatorios.');
		mensaje.focus();
	}
	else document.contactoForm.submit();

}

function compruebaComentario()
{

	var nombre = document.getElementById('nombre');
	var mensaje = document.getElementById('mensaje');

	if(nombre.value == "" || mensaje.value == "")
	{
		alert('Los campos con asterisco son obligatorios.');
	}
	else document.formComentario.submit();

}

function compruebaDonativo()
{
	var nombre = document.getElementById('nombre');
	var email = document.getElementById('email');
	var telefono = document.getElementById('telefono');
	var cuenta = document.getElementById('cuenta_bancaria');
	var donativo = document.getElementById('donativo');

	if(nombre.value == "" || email.value == "" || telefono.value == "" || cuenta.value == "" || donativo.value == "")
	{
		alert('Los campos con asterisco son obligatorios.');
	}
	else document.donativosForm.submit();

}

$().ready(function() {

	$(".redes a").click(function(event)
	{
		event.preventDefault();
		var link = $(this).attr('href');

		window.open(link,"Redes sociales","width=700,height=500,scrollbars=YES");

	})

});