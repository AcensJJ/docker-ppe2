<?php
require_once  $_SERVER['DOCUMENT_ROOT'].'/inc/bdd.php';

class ADRESSE
{

#region Fonctions SQL
	private $conn;

	public function __construct()
	{
		$database = new Bdd();
		$db = $database->dbConnection();
		$this->conn = $db;
    }

	public function runQueryAdresse($sql)
	{
		$stmt = $this->conn->prepare($sql);
		return $stmt;
	}
#endregion

#region Ajout d'une adresse de facturation

	public function ajouter_adresse_fact($nom_addr_fact,$prenom_addr_fact,$societe_addr_fact,$addr1_addr_fact,$addr2_addr_fact,$ville_addr_fact,$cp_addr_fact,$pays_addr_fact,$IDClient,$type_addr_fact)
	{
		try
		{
			$stmt = $this->conn->prepare("INSERT INTO adresse(IDClient,Nom,Prenom,Societe,Adresse1,Adresse2,CodePostal,Ville,Pays,TypeAdresse)
		                                               VALUES(:idclient,:nom,:prenom,:societe,:adresse1,:adresse2,:cp,:ville,:pays,:typeadresse)");

			$stmt->bindparam(":idclient", $IDClient);
      $stmt->bindparam(":nom", $nom_addr_fact);
			$stmt->bindparam(":prenom", $prenom_addr_fact);
			$stmt->bindparam(":societe", $societe_addr_fact);
			$stmt->bindparam(":adresse1", $addr1_addr_fact);
			$stmt->bindparam(":adresse2", $addr2_addr_fact);
      $stmt->bindparam(":cp", $cp_addr_fact);
      $stmt->bindparam(":ville", $ville_addr_fact);
      $stmt->bindparam(":pays", $pays_addr_fact);
      $stmt->bindparam(":typeadresse", $type_addr_fact);
			$stmt->execute();
			return $stmt;

		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}
#endregion

#region Ajout d'une adresse de livraison

	public function ajouter_adresse_livraison($nom_addr_livraison,$prenom_addr_livraison,$societe_addr_livraison,$addr1_addr_livraison,$addr2_addr_livraison,$ville_addr_livraison,$cp_addr_livraison,$pays_addr_livraison,$IDClient,$type_addr_livraison)
	{
		try
		{
			$stmt = $this->conn->prepare("INSERT INTO adresse(IDClient,Nom,Prenom,Societe,Adresse1,Adresse2,CodePostal,Ville,Pays,TypeAdresse)
		                                               VALUES(:idclient,:nom,:prenom,:societe,:adresse1,:adresse2,:cp,:ville,:pays,:typeadresse)");

			$stmt->bindparam(":idclient", $IDClient);
      $stmt->bindparam(":nom", $nom_addr_livraison);
			$stmt->bindparam(":prenom", $prenom_addr_livraison);
			$stmt->bindparam(":societe", $societe_addr_livraison);
			$stmt->bindparam(":adresse1", $addr1_addr_livraison);
			$stmt->bindparam(":adresse2", $addr2_addr_livraison);
      $stmt->bindparam(":cp", $cp_addr_livraison);
      $stmt->bindparam(":ville", $ville_addr_livraison);
      $stmt->bindparam(":pays", $pays_addr_livraison);
      $stmt->bindparam(":typeadresse", $type_addr_livraison);
			$stmt->execute();
			return $stmt;

		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}
#endregion

#region Suppression d'une adresse
	public function supprimer_adresse($id_adresse)
	{
    try
    {
      $stmt = $this->conn->prepare("DELETE FROM adresse WHERE IDAdresse = :idadresse");
      $stmt->bindparam(":idadresse", $id_adresse);
      $stmt->execute();
      return $stmt;
    }
    catch(PDOException $e)
    {
      echo $e->getMessage();
    }
	}
#endregion

#region Modification d'une adresse


	public function edit_adresse_nom($nom,$id_adresse,$IDClient)
	{
		try
		{
				$stmt = $this->conn->prepare("UPDATE adresse SET Nom = :nom WHERE IDClient = :idclient AND IDAdresse = :idadresse");
				$stmt->bindparam(":nom", $nom);
				$stmt->bindparam(":idclient", $IDClient);
        $stmt->bindparam(":idadresse", $id_adresse);
				$stmt->execute();
			return $stmt;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}

  public function edit_adresse_prenom($prenom,$id_adresse,$IDClient)
	{
		try
		{
				$stmt = $this->conn->prepare("UPDATE adresse SET Prenom = :prenom WHERE IDClient = :idclient AND IDAdresse = :idadresse");
				$stmt->bindparam(":prenom", $prenom);
				$stmt->bindparam(":idclient", $IDClient);
        $stmt->bindparam(":idadresse", $id_adresse);
				$stmt->execute();
			return $stmt;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}

  public function edit_adresse_societe($societe,$id_adresse,$IDClient)
	{
		try
		{
				$stmt = $this->conn->prepare("UPDATE adresse SET Societe = :societe WHERE IDClient = :idclient AND IDAdresse = :idadresse");
				$stmt->bindparam(":societe", $societe);
				$stmt->bindparam(":idclient", $IDClient);
        $stmt->bindparam(":idadresse", $id_adresse);
				$stmt->execute();
			return $stmt;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}

  public function edit_adresse_addr1($addr1,$id_adresse,$IDClient)
	{
		try
		{
				$stmt = $this->conn->prepare("UPDATE adresse SET Adresse1 = :adresse1 WHERE IDClient = :idclient AND IDAdresse = :idadresse");
				$stmt->bindparam(":adresse1", $addr1);
				$stmt->bindparam(":idclient", $IDClient);
        $stmt->bindparam(":idadresse", $id_adresse);
				$stmt->execute();
			return $stmt;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}

  public function edit_adresse_addr2($addr2,$id_adresse,$IDClient)
	{
		try
		{
				$stmt = $this->conn->prepare("UPDATE adresse SET Adresse2 = :adresse2 WHERE IDClient = :idclient AND IDAdresse = :idadresse");
				$stmt->bindparam(":adresse2", $addr2);
				$stmt->bindparam(":idclient", $IDClient);
        $stmt->bindparam(":idadresse", $id_adresse);
				$stmt->execute();
			return $stmt;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}

  public function edit_adresse_codepostal($codepostal,$id_adresse,$IDClient)
	{
		try
		{
				$stmt = $this->conn->prepare("UPDATE adresse SET CodePostal = :codepostal WHERE IDClient = :idclient AND IDAdresse = :idadresse");
				$stmt->bindparam(":codepostal", $codepostal);
				$stmt->bindparam(":idclient", $IDClient);
        $stmt->bindparam(":idadresse", $id_adresse);
				$stmt->execute();
			return $stmt;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}

  public function edit_adresse_ville($ville,$id_adresse,$IDClient)
	{
		try
		{
				$stmt = $this->conn->prepare("UPDATE adresse SET Ville = :ville WHERE IDClient = :idclient AND IDAdresse = :idadresse");
				$stmt->bindparam(":ville", $ville);
				$stmt->bindparam(":idclient", $IDClient);
        $stmt->bindparam(":idadresse", $id_adresse);
				$stmt->execute();
			return $stmt;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}

  public function edit_adresse_pays($pays,$id_adresse,$IDClient)
	{
		try
		{
				$stmt = $this->conn->prepare("UPDATE adresse SET Pays = :pays WHERE IDClient = :idclient AND IDAdresse = :idadresse");
				$stmt->bindparam(":pays", $pays);
				$stmt->bindparam(":idclient", $IDClient);
        $stmt->bindparam(":idadresse", $id_adresse);
				$stmt->execute();
			return $stmt;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}

  public function edit_adresse_type($type,$id_adresse,$IDClient)
	{
		try
		{
				$stmt = $this->conn->prepare("UPDATE adresse SET TypeAdresse = :type WHERE IDClient = :idclient AND IDAdresse = :idadresse");
				$stmt->bindparam(":type", $type);
				$stmt->bindparam(":idclient", $IDClient);
        $stmt->bindparam(":idadresse", $id_adresse);
				$stmt->execute();
			return $stmt;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}
#endregion

}

?>
