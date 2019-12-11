<?php
require_once  $_SERVER['DOCUMENT_ROOT'].'/inc/bdd.php';

class CONTACT
{

#region Fonctions SQL
	private $conn;

	public function __construct()
	{
		$database = new Bdd();
		$db = $database->dbConnection();
		$this->conn = $db;
    }

	public function runQueryContact($sql)
	{
		$stmt = $this->conn->prepare($sql);
		return $stmt;
	}
#endregion

#region Ajout d'un message
public function ajouter_message($idclient,$nomdemandeur,$mesdemandeur,$emaildemandeur)
{
	try
	{
		$stmt = $this->conn->prepare("INSERT INTO contact(IDClient, nomDemandeur, mesDemandeur, emailDemandeur)
																								 VALUES(:idclient, :nomdemandeur, :mesdemandeur, :emaildemandeur)");
		$stmt->bindparam(":idclient", $idclient);
		$stmt->bindparam(":nomdemandeur", $nomdemandeur);
    $stmt->bindparam(":mesdemandeur", $mesdemandeur);
		$stmt->bindparam(":emaildemandeur", $emaildemandeur);
		$stmt->execute();
		return $stmt;
	}
	catch(PDOException $e)
	{
		echo $e->getMessage();
	}
}
#endregion

#region Suppression d'une image
	public function supprimer_message($id_contact)
	{
    try
    {
      $stmt = $this->conn->prepare("DELETE FROM contact WHERE IDContact = :idcontact");
      $stmt->bindparam(":idcontact", $id_contact);
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
