<?php
class DB {
	private $host="localhost";
	private $user="groupeS";
	private $password="bie5Ooqu";
	private $database="groupeS";
	private $db;

	public function __construct($host=null, $user=null, $password=null, $database=null){
		if($host != null){
			$this->host = $host;
			$this->user = $user;
			$this->password = $password;
			$this->database = $database;
		}
		try{
			$this->db = new PDO('mysql:host='.$this->host.';dbname='.$this->database,$this->user,$this->password, 
				array(
				PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8'
				));
		}catch(PDOException $e){
			die("Echec lors de la connexion");
		}
	}

	public function query($sql, $data = array()){
		$req=$this->db->prepare($sql);
		$req->execute($data);
		return $req->fetchAll(PDO::FETCH_OBJ);
	}

	public function emptyquery($sql, $data = array()){
		$req=$this->db->prepare($sql);
		$req->execute($data);
	}
}
?>