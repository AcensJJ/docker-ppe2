<?php $titre = "Confirmation de la commande"; ?>
<?php
session_start();
require_once ("class/Client.php");
require_once ("class/Adresse.php");
require_once ("class/Commande.php");
$client = new CLIENT();
$adresse = new ADRESSE();
$commande = new COMMANDE();

if ($client->isConnecte() == "") {
    $client->Redirection('connexion.php');
}
?>
<?php include ("inc/header.php"); ?>
<?php

$_SESSION["reponse"] = "VERIFIED";
date_default_timezone_set('Europe/Paris');
$date = date("Y/m/d");
$heure = date('H:i');
$etat = utf8_decode("En attente de préparation...");
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
?>


<div class="breadcrumb-area">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <ul class="breadcrumb">
                            <li><a href="index.php"><i class="fa fa-home"></i></a></li>
                            <li><a href="#">Paiement</a></li>
                            <li><a href="#">Confirmation de la commande</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="account-area">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h1>Merci d'avoir choisi Les Délices de Rachida !</h1>
                        <p>Votre commande a bien été enregistrée, rendez-vous dans votre espace client pour suivre la préparation de votre commande !</p>
                    </div>
                    <div class="col-md-12">
                        <div class="button-back">
                            <a class="btn btn-default" href="compte.php"><span>Mes commandes</span></a>
                            <a class="btn btn-default" href="index.php"><span>Retourner sur le site...</span></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<?php include ("inc/footer.php"); ?>
