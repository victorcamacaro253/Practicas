<?php

require_once 'conexion/conexion.php';
require_once 'respuesta.class.php';




class pacientes extends conexion
{
	private $table='pacientes';
	private $PacienteId="";
	private $dni="";
	private $nombre="";
	private $direccion="";
	private $codigopostal="";
	private $genero="";
	private $telefono="";
	private $fechaNacimineto="000-00-00";
	private $correo="";
	private $token="";
	
	public function listarPacientes($pagina=1)
	{
		$inicio=0;
		$cantidad=10;
		if ($pagina > 1) {
			$inicio= ($cantidad* ($pagina - 1)) + 1;
			$cantidad=$cantidad*$pagina;
		}
		
		$query="SELECT  PacienteId,DNI,Nombre,Correo FROM " .$this->table." LIMIT $inicio,$cantidad ";
		$datos=parent::obtenerdatos($query);
		return ($datos);
	}


	public function obtenerpaciente($id){
		$query="SELECT * FROM  ". $this->table. " WHERE PacienteId='$id'";
		return parent::obtenerdatos($query);
	}


	public function post($json){
		$_respuestas=new respuesta;
		$datos=json_decode($json,true);

		if (!isset($datos["token"])) {
			return $_respuestas->error_401();
		}else{
          $this->token= $datos["token"];
          $arrayToken=$this->buscarToken();

          if ($arrayToken) {

          	   if (!isset($datos['Nombre']) || !isset($datos['DNI']) || !isset($datos['Correo'])) {
      	return $_respuestas->error_400();
      	
      }else{
      	$this->nombre=$datos['nombre'];
      	$this->dni=$datos['DNI'];
      	$this->correo=$datos['Correo'];
      	if (isset($datos['Telefono'])) {  $this->telefono= $datos['Telefono']; }
      	if (isset($datos['Direccion'])) {  $this->direccion=$datos['Direccion']; }
      	if (isset($datos['CodigoPostal'])) { $this->codigopostal['CodigoPostal']; }
      	if (isset($datos['Genero'])) { $this->genero['Genero']; }
      	if (isset($datos['FechaNacimineto'])) { $this->fechaNacimineto['FechaNacimineto']; }
      		$resp= $this->insertarPaciente();
      	if ($resp) {
      		$respuesta=$_respuestas->response;
      		$respuesta["result"]=array(

      		   "pacienteId"=>$resp );
      		return $respuesta;
      	}else{
      		return $_respuestas->error_500();
      	}

      }

          
          }else{
          	return $_respuestas->error_401("El token que envio es invalido o ha caducado");

          }


		}
      
      
   

	}

	private function insertarPaciente(){
		$query="INSERT INTO ".$this->table."(DNI,Nombre,Direccion,CodigoPostal,Telefono,Genero,FechaNacimineto,Correo) values ('".$this->dni."','".$this->nombre."','".$this->direccion."','".$this->codigopostal."','".$this->genero."','".$this->fechaNacimineto."','".$this->correo."')";
		$resp=parent::nonQueryId($query);

		if ($resp) {
			return $resp;
		}else{
			return 0;
		}
	}


   public function put($json){
		$_respuestas=new respuesta;
      
      $datos=json_decode($json,true);

      if (!isset($datos['token'])) {
      	return $_respuestas->error_401();
      }else{
      	$this->token=$datos['token'];
      	$arrayToken=$this->buscarToken();
      	if($arrayToken){

      		 if (!isset($datos['pacienteId']))  {
      	return $_respuestas->error_400();
      	
      }else{
      	$this->PacienteId= $datos['PacienteId'];
      	if (isset($datos['nombre'])) { $this->nombre = $datos['nombre']; }
      	if (isset($datos['DNI'])) {  $this->dni= $datos['DNI']; }
      	if (isset($datos['Correo'])) {  $this->correo= $datos['Correo']; }
      	if (isset($datos['Telefono'])) {  $this->telefono= $datos['Telefono']; }
      	if (isset($datos['Direccion'])) {  $this->direccion=$datos['Direccion']; }
      	if (isset($datos['CodigoPostal'])) { $this->codigopostal['CodigoPostal']; }
      	if (isset($datos['Genero'])) { $this->genero['Genero']; }
      	if (isset($datos['FechaNacimineto'])) { $this->fechaNacimineto['FechaNacimineto']; }
      		$resp= $this-> modificarPaciente();
      	if ($resp) {
      		$respuesta=$_respuestas->response;
      		$respuesta["result"]=array(

      		   "pacienteId"=>$this->pacienteId);
      		return $respuesta;
      	}else{
      		return $_respuestas->error_500();
      	}

      }




      	}else{
      		return $_respuestas->error_401("El token que envio es invalido o ha aducado");

      	}
      }


     

	}


	private function modificarPaciente(){
		$query="UPDATE  ".$this->table." SET nombre='".$this->nombre."',Direccion='".$this->direccion."',DNI='".$this->dni."',CodigoPostal='".$this->codigopostal."',Telefono='".$this->telefono."',Genero='".$this->genero."',FechaNacimineto='".$this->fechaNacimineto."',Correo='".$this->correo."' WHERE PacienteId='".$this->pacienteId."'";
		$resp=parent::nonQuery($query);

		if ($resp >=1) {
			return $resp;
		}else{
			return 0;
		}
	}


    public function delete($json){
    	$_respuestas=new respuesta;
    	$datos=json_decode($json,true);

    	if (!isset($datos['token'])) {
    		return $_respuestas->error_401();
    	}else{
    		$this->token=$datos['token'];
    		$arrayToken=$this->buscarToken();

    		if ($arrayToken) {

    			if (!isset($datos['pacienteId'])) {
    		return $_respuestas->error_400();
    	}else{
    		$this->pacienteId=$datos['pacienteId'];
    		$resp=$this->eliminarpaciente();
    		if($resp){
    			$respuesta=$_respuestas->response;
    			$respuesta['result']=array(

               "pacienteId" => $this->pacienteId
  
    			);
    			return $respuesta;
    		}else{
    			return $_respuestas->error_500();
    		}
    	}
    			
    		}else{
    			return $_respuestas->error_401("El Token que envio es invalido o ha caducado");
    		}
    	}


     


    	

    }

    private function eliminarpaciente(){
    	$query="DELETE FROM ".$this->table."WHERE PacienteId='".$this->pacienteId."'";
    	$resp=parent::nonQuery($query);
    	if ($resp>=1) {
    		return $resp;
    		
    	}else{
    		return 0;
    	}

    }


    private function buscarToken(){
    	$query="SELECT tokenId,UsuarioId,estado from usuarios_token where Token='".$this->token."' and Estado='Activo'";
    	$resp=parent::obtenerdatos($query);

    	if ($resp) {
    		return $resp;
    	}else{
    		return 0;
    	}
    }

    private function actualizarToken($tokenid){
    	$date=date("Y-m-d H:i");
    	$query="UPDATE usuarios_token SET Fecha='$date' where Tokenid='$tokenid'";
    	$resp=parent::nonQuery($query);

    	if ($resp>=1) {
    		return $resp;
    	}else{
    		return 0;
    	}
    }


}



?>