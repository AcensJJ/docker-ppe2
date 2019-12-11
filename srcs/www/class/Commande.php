<?php
require_once  $_SERVER['DOCUMENT_ROOT'].'/inc/bdd.php';
require_once  $_SERVER['DOCUMENT_ROOT'].'/inc/session.php';

class COMMANDE
{

#region Fonctions SQL
	private $conn;

	public function __construct()
	{
		$database = new Bdd();
		$db = $database->dbConnection();
		$this->conn = $db;
    }

	public function runQueryCommande($sql)
	{
		$stmt = $this->conn->prepare($sql);
		return $stmt;
	}
#endregion

#region Ajout d'une commande

	public function ajouter_commande($date,$heure,$etat,$totalttc,$totalht,$totaltva,$livraison,$commentaire,$id_client,$id_adresse_facturation,$id_adresse_livraison,$num_commande,$methode_reglement)
	{
		try
		{
			$stmt = $this->conn->prepare("INSERT INTO commande(DateCommande,HeureCommande,EtatCommande,TotalTTC,TotalHT,TotalTVA,FraisPortTTC,Commentaire,IDClient,IDAdresseFacturation,IDAdresseLivraison,NumCommande,MethodeReglement)
		                                               VALUES(:datecommande,:heure,:etat,:totalttc,:totalht,:totaltva,:livraison,:commentaire,:id_client,:id_adresse_facturation,:id_adresse_livraison,:num_commande,:methode_reglement)");

			$stmt->bindparam(":datecommande", $date);
      $stmt->bindparam(":heure", $heure);
			$stmt->bindparam(":etat", $etat);
			$stmt->bindparam(":totalttc", $totalttc);
			$stmt->bindparam(":totalht", $totalht);
			$stmt->bindparam(":totaltva", $totaltva);
			$stmt->bindparam(":livraison", $livraison);
			$stmt->bindparam(":commentaire", $commentaire);
			$stmt->bindparam(":id_client", $id_client);
			$stmt->bindparam(":id_adresse_facturation", $id_adresse_facturation);
			$stmt->bindparam(":id_adresse_livraison", $id_adresse_livraison);
			$stmt->bindparam(":num_commande", $num_commande);
			$stmt->bindparam(":methode_reglement", $methode_reglement);


			$stmt->execute();
			$id_commande = $this->conn->lastInsertId();
			$_SESSION["id_commande"] = $id_commande;
			return $stmt;

		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}
#endregion

#region Ajout d'un produit dans une commande

public function ajouter_produit_commande($id_produit,$id_commande,$quantite)
{
	try
	{
		$stmt = $this->conn->prepare("INSERT INTO commande_produits(IDProduit,IDCommande,Quantite)
																								 VALUES(:idproduit,:idcommande,:quantite)");

		$stmt->bindparam(":idproduit", $id_produit);
		$stmt->bindparam(":idcommande", $id_commande);
		$stmt->bindparam(":quantite", $quantite);


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

#region Suppression d'une commande
	public function supprimer_commande($id_commande)
	{
    try
    {
      $stmt = $this->conn->prepare("DELETE FROM commande WHERE IDCommande = :idcommande");
      $stmt->bindparam(":idcommande", $id_commande);
      $stmt->execute();

			$stmt = $this->conn->prepare("DELETE FROM commande_produits WHERE IDCommande = :idcommande");
			$stmt->bindparam(":idcommande", $id_commande);
			$stmt->execute();


      return $stmt;
    }
    catch(PDOException $e)
    {
      echo $e->getMessage();
    }
	}
#endregion

#region Modification d'une commande

public function edit_commande_etat($etat,$id_commande)
{
	try
	{
			$stmt = $this->conn->prepare("UPDATE commande SET EtatCommande = :etat WHERE IDCommande = :idcommande");
			$stmt->bindparam(":etat", $etat);
			$stmt->bindparam(":idcommande", $id_commande);
			$stmt->execute();
		return $stmt;
	}
	catch(PDOException $e)
	{
		echo $e->getMessage();
	}
}

public function edit_commande_commentaire($commentaire,$id_commande)
{
	try
	{
			$stmt = $this->conn->prepare("UPDATE commande SET Commentaire = :commentaire WHERE IDCommande = :idcommande");
			$stmt->bindparam(":commentaire", $commentaire);
			$stmt->bindparam(":idcommande", $id_commande);
			$stmt->execute();
		return $stmt;
	}
	catch(PDOException $e)
	{
		echo $e->getMessage();
	}
}

public function edit_commande_totalht($totalht,$id_commande)
{
	try
	{
			$stmt = $this->conn->prepare("UPDATE commande SET TotalHT = :totalht WHERE IDCommande = :idcommande");
			$stmt->bindparam(":totalht", $totalht);
			$stmt->bindparam(":idcommande", $id_commande);
			$stmt->execute();
		return $stmt;
	}
	catch(PDOException $e)
	{
		echo $e->getMessage();
	}
}

public function edit_commande_totalttc($totalttc,$id_commande)
{
	try
	{
			$stmt = $this->conn->prepare("UPDATE commande SET TotalTTC = :totalttc WHERE IDCommande = :idcommande");
			$stmt->bindparam(":totalttc", $totalttc);
			$stmt->bindparam(":idcommande", $id_commande);
			$stmt->execute();
		return $stmt;
	}
	catch(PDOException $e)
	{
		echo $e->getMessage();
	}
}

public function edit_commande_fraisdeport($fraisdeport,$id_commande)
{
	try
	{
			$stmt = $this->conn->prepare("UPDATE commande SET FraisPortTTC = :fraisporttc WHERE IDCommande = :idcommande");
			$stmt->bindparam(":fraisporttc", $fraisdeport);
			$stmt->bindparam(":idcommande", $id_commande);
			$stmt->execute();
		return $stmt;
	}
	catch(PDOException $e)
	{
		echo $e->getMessage();
	}
}

#endregion

#region Annulation d'une commande

public function annuler_commande($etat,$id_commande)
{
	try
	{
			$stmt = $this->conn->prepare("UPDATE commande SET EtatCommande = :etat WHERE IDCommande = :idcommande");
			$stmt->bindparam(":etat", $etat);
			$stmt->bindparam(":idcommande", $id_commande);
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
