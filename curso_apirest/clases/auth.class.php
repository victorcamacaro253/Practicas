<?php


require_once('conexion/conexion.php');
require_once('respuesta.class.php');


class auth extends conexion
{
	
	public function login($json){

		$_respuestas=new respuesta;
		$datos=json_decode($json,true);
		if (!isset($datos['usuario']) || !isset($datos['password'])) {
			//error con los campos
			return $_respuestas->error_400();
		}else{
			$usuario=$datos['usuario'];
			$password=$datos['password'];
			$password=parent::encriptar($password);
			$datos=$this->obtenerDatosUsuario($usuario);

			if ($datos){
				//verificar si la contraseña es igual
				if($password==$datos[0]['password']){
					if($datos[0]['Estado']=="Activo"){
                     //crear token
						$verificar=$this->insertar_token($datos[0]['Usuarioid']);
						if ($verificar) {

							# si se guardo
							$result=$_respuesta->response;
							$result['result']=array(

                              "token"=> $verificar

							    
							     );
							return $result;

						}else{
                         //error al guardar
							return $_respuesta->error_500(['error interno']);

						}
					}else{
                     //el usuario esta inactivo
						return $_respuesta->error_200(['El usuario esta inactivo']);
					}

				}else{
					//la contraseña no esta en la base de datos
					return $_respuesta->error_200['el password es invalido'];
				}
            

			}else{
				//no existe el usuario
				return $_respuesta->error_200['el usuario $usuario no existe'];
			}

		}
	}


   private function obtenerDatosUsuario($correo){
   	$query="SELECT UsuarioId,Password,Estado from usuarios where Usuario='$correo'";
   	$datos=parent:: obtenerdatos($query);
   	if (isset($datos[0]["UsuarioId"])) {
   		return $datos;
   	}else{
   		return 0;
   	}
   }

   private function insertar_token($usuarioid){
   	$val=true;
   	$token=bin2hex(openssl_random_pseudo_bytes(16,$val));
   	$date=date("Y-m-d H:i");
   	$estado="Activo";
   	$query="INSERT INTO usuarios_token(UsuarioId,Token,Estado,Fecha) values ('$usuarioid','$token','$estado','$date')";
   	$verificar=parent::nonQuery($query);
   	if ($verificar) {
   		return $token;
   		
   	}else{
   		return false;
   	}
   }

}











 ?>