<?php
require_once  $_SERVER['DOCUMENT_ROOT'].'/inc/bdd.php';

class IMAGE
{

#region Fonctions SQL
	private $conn;

	public function __construct()
	{
		$database = new Bdd();
		$db = $database->dbConnection();
		$this->conn = $db;
    }

	public function runQueryImages($sql)
	{
		$stmt = $this->conn->prepare($sql);
		return $stmt;
	}
#endregion

#region Ajout d'une image
public function ajouter_image($nom,$produit,$ordre,$nomImage)
{
	try
	{
		$stmt = $this->conn->prepare("INSERT INTO images(NomImage, IDProduit, OrdreAffichage)
																								 VALUES(:nom, :produit, :ordre)");
		$stmt->bindparam(":nom", $nomImage);
		$stmt->bindparam(":produit", $produit);
		$stmt->bindparam(":ordre", $ordre);
		$stmt->execute();
		$id_produit = $this->conn->lastInsertId();
		return $stmt;
	}
	catch(PDOException $e)
	{
		echo $e->getMessage();
	}
}
#endregion

#region Suppression d'une image
	public function supprimer_image($id_image)
	{
    try
    {
      $stmt = $this->conn->prepare("DELETE FROM images WHERE IDImage = :idimage");
      $stmt->bindparam(":idimage", $id_image);
      $stmt->execute();
      return $stmt;
    }
    catch(PDOException $e)
    {
      echo $e->getMessage();
    }
	}
#endregion

#region Modification d'une image
	public function modifier_image($produit_associe,$ordre_affichage,$id_image)
	{
		try
		{
				$stmt = $this->conn->prepare("UPDATE images SET IDProduit = :idproduit, OrdreAffichage = :ordre WHERE IDImage = :id");
        $stmt->bindparam(":ordre", $ordre_affichage);
				$stmt->bindparam(":id", $id_image);
        $stmt->bindparam(":idproduit", $produit_associe);
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
