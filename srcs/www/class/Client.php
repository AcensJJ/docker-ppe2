<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/inc/bdd.php';

class CLIENT
{

#region Fonctions SQL
	private $conn;

	public function __construct()
	{
		$database = new Bdd();
		$db = $database->dbConnection();
		$this->conn = $db;
    }

	public function runQuery($sql)
	{
		$stmt = $this->conn->prepare($sql);
		return $stmt;
	}
	#endregion

#region Inscription d'un client
	public function inscription($upseudo,$umail,$upass,$ucivilite,$uprenom,$unom,$utelephone,$datecreation)
	{
		try
		{
			$mdp_hache = password_hash($upass, PASSWORD_DEFAULT);

			$stmt = $this->conn->prepare("INSERT INTO clients(Email,Pseudo,MotDePasse,Civilite,Prenom,Nom,Telephone,DateCreation)
		                                               VALUES(:umail, :upseudo, :upass, :ucivilite, :uprenom, :unom, :utelephone, :datecreation)");

			$stmt->bindparam(":upseudo", $upseudo);
			$stmt->bindparam(":umail", $umail);
			$stmt->bindparam(":ucivilite", $ucivilite);
			$stmt->bindparam(":uprenom", $uprenom);
			$stmt->bindparam(":unom", $unom);
			$stmt->bindparam(":utelephone", $utelephone);
			$stmt->bindparam(":datecreation", $datecreation);
			$stmt->bindparam(":upass", $mdp_hache);

			$stmt->execute();


			return $stmt;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}
#endregion

#region Connexion d'un client
	public function connexion($upseudo,$umail,$upass)
	{
		try
		{
			$stmt = $this->conn->prepare("SELECT IDClient, Pseudo, Email, MotDePasse FROM clients WHERE Pseudo=:upseudo OR Email=:umail ");
			$stmt->execute(array(':upseudo'=>$upseudo, ':umail'=>$umail));
			$infoClient=$stmt->fetch(PDO::FETCH_ASSOC);
			if($stmt->rowCount() == 1)
			{
				if(password_verify($upass, $infoClient['MotDePasse']))
				{
					$_SESSION['session_client'] = $infoClient['IDClient'];
					return true;
				}
				else
				{
					return false;
				}
			}
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}
#endregion

#region Modification d'un client

	#region Modification "Nom" du client
	public function edit_client_nom($nom,$id_client)
	{
		try
		{
				$stmt = $this->conn->prepare("UPDATE clients SET Nom = :nom WHERE IDClient = :id");
				$stmt->bindparam(":nom", $nom);
				$stmt->bindparam(":id", $id_client);
				$stmt->execute();
			return $stmt;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}
	#endregion

	#region Modification "Prenom" du client
	public function edit_client_prenom($prenom,$id_client)
	{
		try
		{
				$stmt = $this->conn->prepare("UPDATE clients SET Prenom = :prenom WHERE IDClient = :id");
				$stmt->bindparam(":prenom", $prenom);
				$stmt->bindparam(":id", $id_client);
				$stmt->execute();
			return $stmt;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}
	#endregion

	#region Modification "Pseudo" du client
	public function edit_client_pseudo($pseudo,$id_client)
	{
		try
		{
				$stmt = $this->conn->prepare("UPDATE clients SET Pseudo = :pseudo WHERE IDClient = :id");
				$stmt->bindparam(":pseudo", $pseudo);
				$stmt->bindparam(":id", $id_client);
				$stmt->execute();
			return $stmt;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}
	#endregion

	#region Modification "Email" du client
	public function edit_client_email($email,$id_client)
	{
		try
		{
				$stmt = $this->conn->prepare("UPDATE clients SET Email = :email WHERE IDClient = :id");
				$stmt->bindparam(":email", $email);
				$stmt->bindparam(":id", $id_client);
				$stmt->execute();
			return $stmt;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}
	#endregion

	#region Modification "Motdepasse" du client
	public function edit_client_motdepasse($motdepasse,$id_client)
	{
		try
		{
				$mdp_hache = password_hash($motdepasse, PASSWORD_DEFAULT);

				$stmt = $this->conn->prepare("UPDATE clients SET MotDePasse = :motdepasse WHERE IDClient = :id");
				$stmt->bindparam(":motdepasse", $mdp_hache);
				$stmt->bindparam(":id", $id_client);
				$stmt->execute();
			return $stmt;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}
	#endregion

	#region Modification "Civilite" du client
	public function edit_client_civilite($civilite,$id_client)
	{
		try
		{
				$stmt = $this->conn->prepare("UPDATE clients SET Civilite = :civilite WHERE IDClient = :id");
				$stmt->bindparam(":civilite", $civilite);
				$stmt->bindparam(":id", $id_client);
				$stmt->execute();
			return $stmt;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}
	#endregion

	#region Modification "Telephone" du client
	public function edit_client_telephone($telephone,$id_client)
	{
		try
		{
				$stmt = $this->conn->prepare("UPDATE clients SET Telephone = :telephone WHERE IDClient = :id");
				$stmt->bindparam(":telephone", $telephone);
				$stmt->bindparam(":id", $id_client);
				$stmt->execute();
			return $stmt;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}
	#endregion

	#region Modification "Question" du client
	public function edit_client_question($question,$id_client)
	{
		try
		{
				$stmt = $this->conn->prepare("UPDATE clients SET Question = :question WHERE IDClient = :id");
				$stmt->bindparam(":question", $question);
				$stmt->bindparam(":id", $id_client);
				$stmt->execute();
			return $stmt;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}
	#endregion

	#region Modification "Reponse" du client
	public function edit_client_reponse($reponse,$id_client)
	{
		try
		{
				$stmt = $this->conn->prepare("UPDATE clients SET Reponse = :reponse WHERE IDClient = :id");
				$stmt->bindparam(":reponse", $reponse);
				$stmt->bindparam(":id", $id_client);
				$stmt->execute();
			return $stmt;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}
	#endregion

	#region Modification "Grade" du client
	public function edit_client_grade($grade,$id_client)
	{
		try
		{
				$stmt = $this->conn->prepare("UPDATE clients SET Grade = :grade WHERE IDClient = :id");
				$stmt->bindparam(":grade", $grade);
				$stmt->bindparam(":id", $id_client);
				$stmt->execute();
			return $stmt;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}
	#endregion

#endregion

#region Suppression d'un client
	public function remove_client($id_client)
	{
		try
		{
			$stmt = $this->conn->prepare("DELETE FROM clients WHERE IDClient = :idclient");
			$stmt->bindparam(":idclient", $id_client);
			$stmt->execute();


			return $stmt;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}
#endregion

#region Méthodes

	#region Fonction: "isConnecte" pour vérifier si le client est connecté
	public function isConnecte()
	{
		if(isset($_SESSION['session_client']))
		{
			return true;
		}else{
			return false;
		}
	}
	#endregion

	#region Fonction: "isAdministrateur" pour vérifier si l'utilisateur est isAdministrateur

	public function isAdministrateur()
	{
		if($_SESSION["grade"] == 1)
		{
			return true;
		}else{
			return false;
		}
	}

	#endregion

	#region Fonction "Redirection" permettant tout types de redirections
	public function Redirection($url)
	{
		header("Location: $url");
	}
	#endregion

	#region Fontion "Deconnexion" pour unset la session actuelle du client
	public function Deconnexion()
	{
		session_destroy();
		unset($_SESSION['session_client']);
		return true;
	}
	#endregion

#endregion


}
?>
