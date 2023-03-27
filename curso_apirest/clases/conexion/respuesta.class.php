<?php


class respuesta
{
	
	public  $response=[
		'status'=>'ok',
	     'result'=>array()

	 ];

    
    public function error_405(){

    $this->response['status']="error";
    $this->response['result']=array(
       "error_id"=>"405",
       "error_msg"=>"metodo no permitido"
     );

     return $response;
     

    }

    public function error_200($valor="datos incorrectos"){

    $this->response['status']="error";
    $this->response['result']=array(
       "error_id"=>"200",
       "error_msg"=>$valor
     );

     return $response;
     

    }

    public function error_400(){

    $this->response['status']="error";
    $this->response['result']=array(
       "error_id"=>"400",
       "error_msg"=>"datos incorrectos o con fomato incorrecto";
     );

     return $response;
     

    }


   public function error_500($valor="error interno"){

    $this->response['status']="error";
    $this->response['result']=array(
       "error_id"=>"500",
       "error_msg"=>$valor
     );

     return $response;
     

    }





}



?>