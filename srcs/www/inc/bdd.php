<?php
class Bdd
{
    private $hote = "localhost";
    private $base = "ppe2";
    private $utilisateur = "ppe2try";
    private $mdp = "adke144524@weda125a%da2.3";
    public $conn;

    public function dbConnection()
	{

	    $this->conn = null;
        try
		{
            $this->conn = new PDO("mysql:host=" . $this->hote . ";dbname=" . $this->base, $this->utilisateur, $this->mdp);
			$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
		catch(PDOException $exception)
		{
            echo "Erreur de connexion: " . $exception->getMessage();
        }

        return $this->conn;
    }
}


class DB{
	//connexion normale quoi
	private $host = 'localhost';
	private $username = 'ppe2try';
	private $password = 'adke144524@weda125a%da2.3';
	private $database = 'ppe2';
	private $db;


	public function __construct($host = null, $username = null, $password = null, $database = null){
		//si hôte n'est pas null alors on relance pour lui faire comprendre
		if($host != null){
			$this->host = $host;
			$this->username = $username;
			$this->password = $password;
			$this->database = $database;
		}

		try{
			//récupère les noms d'hôtes et tout grâce au $this
			$this->db = new PDO('mysql:host='.$this->host.';dbname='.$this->database, $this->username, $this->password, array(
				//interagit avec la base de données sans problème d'accents
					PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8',
					//définit les erreurs par des warnings qui font peurs
					PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING
				));
		}catch(PDOException $e){
			//message d'erreur de co à la bdd
			die('<h1>Impossible de se connecter à la base de donnee</h1>');
		}


	}

	public function query($sql, $data = array()){
		//prépare la requête paramétrée (select * from products)
		$req =$this->db->prepare($sql);
		$req->execute($data);
					//résultat sous forme d'objet
		return $req->fetchAll(PDO::FETCH_OBJ);
	}

}

?>
