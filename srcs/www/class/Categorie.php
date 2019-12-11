<?php
require_once  $_SERVER['DOCUMENT_ROOT'].'/inc/bdd.php';

class CATEGORIE
{

#region Fonctions SQL
	private $conn;

	public function __construct()
	{
		$database = new Bdd();
		$db = $database->dbConnection();
		$this->conn = $db;
    }

	public function runQueryCategories($sql)
	{
		$stmt = $this->conn->prepare($sql);
		return $stmt;
	}
#endregion

#region Ajout d'une catégorie
public function ajouter_categorie($nom,$ordre)
{
	try
	{
		$stmt = $this->conn->prepare("INSERT INTO categorie(Libelle, OrdreAffichage)
																								 VALUES(:nom, :ordre)");
		$stmt->bindparam(":nom", $nom);
		$stmt->bindparam(":ordre", $ordre);
		$stmt->execute();
		return $stmt;
	}
	catch(PDOException $e)
	{
		echo $e->getMessage();
	}
}
#endregion

#region Suppression d'une catégorie
	public function supprimer_categorie($id_categorie)
	{
    try
    {
      $stmt = $this->conn->prepare("DELETE FROM categorie WHERE IDCategorie = :idcategorie");
      $stmt->bindparam(":idcategorie", $id_categorie);
      $stmt->execute();
      return $stmt;
    }
    catch(PDOException $e)
    {
      echo $e->getMessage();
    }
	}
#endregion

#region Modification d'une catégorie
	public function modifier_categorie($nom_categorie,$ordre_affichage,$id_categorie)
	{
		try
		{
				$stmt = $this->conn->prepare("UPDATE categorie SET Libelle = :libelle, OrdreAffichage = :ordre WHERE IDCategorie = :id");
        $stmt->bindparam(":libelle", $nom_categorie);
        $stmt->bindparam(":ordre", $ordre_affichage);
        $stmt->bindparam(":id", $id_categorie);
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
