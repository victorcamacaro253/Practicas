<?php



include("db.php");




class encuesta extends DB
{

	private $votosTotales;
	private $opcionSeleccionada;
	
	public function SetOpcionSeleccionada($opcion){
		$this->opcionSeleccionada=$opcion;
	  }

	  public function GetOpcionSeleccionada(){
	  	return $this->opcionSeleccionada;
	   }


   public function votar(){
      
      $query=$this->connect()->prepare('UPDATE lenguajes set votos=votos + 1 where opcion=:opcion');
      $query->execute([":opcion"=>$this->opcionSeleccionada]);
        
       }

       public function MostrarResultados(){
       	return $this->connect()->query("SELECT * FROM lenguajes");
       }

       public function ObtenerVotosTotales(){
       	$query=$this->connect()->query("SELECT SUM(votos) as votos_Totales from lenguajes");
       	$this->votosTotales=$query->fetch(PDO::FETCH_OBJ)->votos_Totales;

       	return $this->votosTotales;
       }


       public function VotosPorcentaje($votos){
       	$resultado=round(($votos/$this-> ObtenerVotosTotales())*(100),0);

       	return $resultado;
       }

       public function MostrarPorcentajeVotos(){

       	echo "Votos totales :".$this->ObtenerVotosTotales()."<br>";

       	$lenguajes=$this->MostrarResultados();

       	foreach ($lenguajes as $lenguaje) {
       		//echo $lenguaje['opcion'].": ";
       		 $porcentaje=$this->VotosPorcentaje($lenguaje['votos'])."";
       		 include("vista.php");
       		

       	}

       }




	
}





?>