<?php
require_once  $_SERVER['DOCUMENT_ROOT'].'/inc/bdd.php';

class PRODUIT
{

#region Fonctions SQL
	private $conn;

	public function __construct()
	{
		$database = new Bdd();
		$db = $database->dbConnection();
		$this->conn = $db;
    }

	public function runQueryProduit($sql)
	{
		$stmt = $this->conn->prepare($sql);
		return $stmt;
	}
#endregion

#region Ajout d'un produit

	public function ajouter_produit($libelleproduit,$categorie,$description,$prix,$ordre,$reference,$nomImage)
	{
		try
		{
			$stmt = $this->conn->prepare("INSERT INTO produit(LibelleProduit,IDCategorie,Description,PrixUnitaireHT,OrdreAffichage,Reference)
		                                               VALUES(:libelleproduit, :categorie, :description, :prix, :ordre, :reference)");

			$stmt->bindparam(":libelleproduit", $libelleproduit);
      $stmt->bindparam(":categorie", $categorie);
			$stmt->bindparam(":description", $description);
			$stmt->bindparam(":prix", $prix);
			$stmt->bindparam(":ordre", $ordre);
			$stmt->bindparam(":reference", $reference);


			$stmt->execute();
			$id_produit = $this->conn->lastInsertId();


			$stmt = $this->conn->prepare("INSERT INTO images(NomImage,IDProduit)
		                                               VALUES(:nomimage, :idproduit)");

			$stmt->bindparam(":nomimage", $nomImage);
			$stmt->bindparam(":idproduit", $id_produit);
			$stmt->execute();


			return $stmt;

		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}
#endregion

#region Modification d'un produit

	#region Modification "Libelle" du produit
	public function edit_produit_libelle($libelleproduit,$id_produit)
	{
		try
		{
				$stmt = $this->conn->prepare("UPDATE produit SET LibelleProduit = :libelleproduit WHERE IDProduit = :id");
				$stmt->bindparam(":libelleproduit", $libelleproduit);
				$stmt->bindparam(":id", $id_produit);
				$stmt->execute();
			return $stmt;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}
	#endregion

	#region Modification "Categorie" du produit
	public function edit_produit_categorie($categorie,$id_produit)
	{
		try
		{
				$stmt = $this->conn->prepare("UPDATE produit SET IDCategorie = :categorie WHERE IDProduit = :id");
				$stmt->bindparam(":categorie", $categorie);
				$stmt->bindparam(":id", $id_produit);
				$stmt->execute();
			return $stmt;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}
	#endregion

	#region Modification "Description" du produit
 	public function edit_produit_description($description,$id_produit)
	{
		try
		{
				$stmt = $this->conn->prepare("UPDATE produit SET Description = :description WHERE IDProduit = :id");
				$stmt->bindparam(":description", $description);
				$stmt->bindparam(":id", $id_produit);
				$stmt->execute();
			return $stmt;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}
	#endregion

	#region Modification "Prix" du produit
	public function edit_produit_prix($prix,$id_produit)
	{
		try
		{
				$stmt = $this->conn->prepare("UPDATE produit SET PrixUnitaireHT = :prix WHERE IDProduit = :id");
				$stmt->bindparam(":prix", $prix);
				$stmt->bindparam(":id", $id_produit);
				$stmt->execute();
			return $stmt;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}
	#endregion

	#region Modification "Ordre" du produit
	public function edit_produit_ordre($ordre,$id_produit)
	{
		try
		{
				$stmt = $this->conn->prepare("UPDATE produit SET OrdreAffichage = :ordre WHERE IDProduit = :id");
				$stmt->bindparam(":ordre", $ordre);
				$stmt->bindparam(":id", $id_produit);
				$stmt->execute();
			return $stmt;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}
	#endregion

	#region Modification "Reference" du produit
	public function edit_produit_reference($reference,$id_produit)
	{
		try
		{
				$stmt = $this->conn->prepare("UPDATE produit SET Reference = :reference WHERE IDProduit = :id");
				$stmt->bindparam(":reference", $reference);
				$stmt->bindparam(":id", $id_produit);
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

#region Suppression d'un produit
	public function remove_produit($id_produit)
	{
		try
		{
			$stmt = $this->conn->prepare("DELETE FROM produit WHERE IDProduit = :idproduit");
			$stmt->bindparam(":idproduit", $id_produit);
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
