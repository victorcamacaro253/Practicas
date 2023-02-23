<?php


/**
 * 
 */
class DB
{
	
	private $host;
	private $db;
	private $user;
	private $password;

	function __construct()
	{
		$this->host='localhost';
		$this->db='victor';
		$this->user='root';
        $this->password='';
	}

	public function connect(){

     try {
     	$connection="mysql:host=".$this->host.";dbname=".$this->db."";

     	$pdo=new PDO($connection,$this->user,$this->password);

     	return $pdo;
     	
     } catch (PDOException $e) {
     	print_r("Error connection ".$e->getMessage());
     	
     }

	}
}


?>