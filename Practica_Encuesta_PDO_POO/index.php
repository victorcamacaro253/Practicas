<?php

include_once("encuesta.php");

$encuesta=new encuesta();

if (isset($_POST['votar'])) {

	if (isset($_POST['lenguaje'])) {
		$lenguaje=$_POST['lenguaje'];
		$encuesta->SetOpcionSeleccionada($lenguaje);
		$encuesta->votar();
		
	}

	 $encuesta->MostrarPorcentajeVotos();	
}

 ?>




<!DOCTYPE html>
<html>
<head>
	<title>Encuesta</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" type="text/css" href="main.css">
	<link rel="stylesheet" type="text/css" href="bootstrap.min.css">
	<style type="text/css">
		form{
			margin: 150px 150px;
			background-color: rgb(151,196,236);
			width: 50%;
			border-radius: 2px;
			margin: 0 auto;
			margin-top: 10px;

		}

		.opcion{
			padding: 5px 0;
		}

		.barra{
			background-color: rgb(151,196,236);
			border-radius: 4px;
			padding: 10px;

		}

		.seleccionado{
			background-color: blue;
			border-radius: 4px;
			color: white;
			padding: 10px;
		}

		input{
			margin-left: 5px;
		}

		.btn{
			margin-bottom: 5px;
		}
		.btn:hover{
			color: black;
			background-color: #fff;
			
		}

	</style>
</head>
<body>


	<?php if (!isset($_POST['votar'])){   ?>
	<form action="#" method="POST">

		<h2>¿Cual es tu lenguaje de programacion?</h2>
		<input type="radio" name="lenguaje" id="" value="c">C<br>
		<input type="radio" name="lenguaje" id="" value="c++">C++<br>
		<input type="radio" name="lenguaje" id="" value="java">Java<br>
		<input type="radio" name="lenguaje" id="" value="swift">Swift<br>
		<input type="radio" name="lenguaje" id="" value="python">Python<br>
		<br>

		<input type="submit" name="votar" class="btn btn-primary">

		
	</form>

<?php } ?>


</body>
</html>