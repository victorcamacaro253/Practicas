<?php

require_once 'clases/respuesta.class.php';
require_once 'clases/pacientes.class.php';

$_respuestas=new respuesta;
$_pacientes=new pacientes;


if ($_SERVER['REQUEST_METHOD']=="GET") {
	if (isset($_GET['page'])) {
		$pagina=$_GET['page'];
		$listarPacientes= $_pacientes->listarPacientes($pagina);
		header("Content-Type: application/json");
		echo json_encode($listarPacientes);
		http_response_code(200);
	}elseif(isset($_GET['id'])){
    
    $pacienteid=$_GET['id'];
    $datopaciente=$_pacientes->obtenerpaciente($pacienteid);
    header("Content-Type: application/json");
    echo json_encode($datopaciente);
    http_response_code(200);


	}
	
	

	
}elseif ($_SERVER['REQUEST_METHOD']=="POST") {
	//recibimos los datos enviados
	$postbody=file_get_contents("php/input");
	//enviamos los datos del manejador
	$resp=$_pacientes->post($postbody);


  //devolvemos una respuesta
	header("Content-Type: application/json");
	if (isset($datosArray['result']['error_id'])) {
		$responseCode=$datosArray['result']['error_id'];
		http_response_code($responseCode);
	}else{
		http_response_code(200);
	}

  echo json_encode($datosArray);



	
}elseif($_SERVER['REQUEST_METHOD']=="PUT"){
	//recibimos los datos

$postbody=file_get_contents("php/input");

//enviamos datos del manejador
$datosArray=$_pacientes->put($postbody);

//devolvimos una respuesta
header('Content-Type:application/json');
if (isset($datosArray['result']['error_id'])) {
	$responseCode=$datosArray['result']['error_id'];
	http_response_code($responseCode);
}else{
	http_response_code(200);
}
echo json_encode($datosArray);

}if ($_SERVER['REQUEST_METHOD']=="DELETE") {


    $headers=getallheaders();

   if(isset($headers['token']) && isset($headers['pacienteid'])){
    	//recibimos los datos enviados por el header
    	$send=[

          "token" => $headers["token"],
          "pacienteid" => $headers["pacienteid"]
    	       ];

    	   $postbody=json_encode($send);
    }else{
    	//recibimos los datos
	$postbody=file_get_contents("php/input");
    }


	

	//enviamos los datos al manejador
	$datosArray=$_pacientes->delete($postbody);

	//devolvimos una respuesta
	header("Content-Type: application/json");
	if (isset($datosArray['result']['error_id'])) {
		$responseCode=$datosArray['result']['error_id'];
		http_response_code($responseCode);
		# code...
	}else{
     http_response_code(200);
	}
	echo json_encode($datosArray);
	
}else{
	header('Content-Type: application/json');
	$datosArray=$_respuestas->error_400();
	echo json_encode($datosArray);
}




?>