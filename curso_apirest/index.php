<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<title>API pruebas</title>
	<link rel="stylesheet" type="text/css" href="estilo.css">
</head>
<body>
	<div class="container">
		<h1>Api prueba</h1>

		<div class="divbody">
			<h3>Auth-Login</h3>
			<code>
				POST/auth
				<br>
			    {
			    	<br>
			    	"usuario":"", ->REQUERIDO
			    	<br>
			    	"password":"", ->REQUERIDO
			    	<br>
			    }

			</code>
			
		</div>

		<div class="divbody">
			<h3>Pacientes</h3>
			<code>
				GET /paciente?page=$numeroPagina
				<br>
				GET /paciente?id=$idPaciente
			</code>

			<code>
				POST/ pacientes
				<br>
				{
					<br>
					"nombre":"", ->REQUERIDO
					<br>
					"dni": "", ->	REQUERIDO
					<br>
					"correo": "", ->REQUERIDO
					<br>
					"codigoPostal": " ", 
					<br>
					"genero" : " ",
					<br>
					"telefono": " ",
					<br>
					"fechaNacimiento" : " ",
					<br>
					"token" : " " ->REQUERIDO
					<br>
				}
			</code>

			<code>
				PUT / Pacientes
				<br>
				{
					<br>
					"nombre" : " ",
					<br>
					"dni" : " ",
					<br>
					"codigoPostal" : " ",
					<br>
					"genero" : " ",
					<br>
					"telefono" : " ",
					<br>
					"fechaNacimiento" : " ",
					<br>
					"token" : "", ->REQUERIDO
					<br>
					"pacienteId": " " ->REQUERIDO
					<br>

				}
			</code>

			<code>
				DELETE /Pacientes
				<br>
				{
					<br>
					"token" : " ", ->REQUERIDO
					<br>
					"pacienteId" : " " ->REQUERIDO
				}
			</code>
			
		</div>
		
	</div>

</body>
</html>