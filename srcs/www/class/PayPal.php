<?php

  require $_SERVER['DOCUMENT_ROOT']."/inc/session.php";
  require_once $_SERVER['DOCUMENT_ROOT'].'/class/Commande.php';
  include $_SERVER['DOCUMENT_ROOT'].'/inc/header.php';
  $commande = new COMMANDE();

	if ($_SERVER['REQUEST_METHOD'] != 'POST') {
		header('Location: ../index.php');
		exit();
	}

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, 'https://ipnpb.sandbox.paypal.com/cgi-bin/webscr');
	curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
  curl_setopt($ch, CURLOPT_POST, 1);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, "cmd=_notify-validate&" . http_build_query($_POST));
	curl_setopt($ch, CURLOPT_SSLVERSION, 6);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
  curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
	$info = curl_getinfo($ch);
	$http_code = $info['http_code'];
	curl_close($ch);



	if ($http_code != 200 || $info == 'VERIFIED') {
		$_SESSION["reponse"] = "VERIFIED";
		date_default_timezone_set('Europe/Paris');
		$date = date("Y/m/d");
		$heure = date('H:i');
		$etat = "En attente de pr&eacute;paration...";
		$totalttc = round($panier->total() * 1.20 + 5, 2);
		$totalht = round($panier->total(),2);
		$totaltva = round($panier->total() / 100 * 20, 2);
		$livraison = "5";
		$commentaire = $_SESSION["commentaire"];
		$id_client = $infoClient['IDClient'];
		$id_adresse_facturation = $_SESSION["addr_fact_choix"];
		$id_adresse_livraison = $_SESSION["addr_livraison_choix"];
		$num_commande = "LDR-" . date("md") . "-" . rand(1,100000);
		$methode_reglement = "PayPal";
		$ids = array_keys($_SESSION['panier']);
		if($commande->ajouter_commande($date,$heure,$etat,$totalttc,$totalht,$totaltva,$livraison,$commentaire,$id_client,$id_adresse_facturation,$id_adresse_livraison,$num_commande,$methode_reglement)){}
			if(empty($ids)){
				$produits = array();
			}else{
				$produits = $DB->query('SELECT * FROM produit WHERE IDProduit IN ('.implode(',',$ids).')');
			}
		foreach($produits as $produit){
			$id_produit = $produit->IDProduit;
			$id_commande = $_SESSION["id_commande"];
			$quantite = $_SESSION['panier'][$produit->IDProduit];
			if($commande->ajouter_produit_commande($id_produit,$id_commande,$quantite)){}
		}
		unset($_SESSION['panier']);
		unset($_SESSION['id_commande']);
}
?>
