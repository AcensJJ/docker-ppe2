<?php $titre = "Confirmation de la commande"; ?>
<?php
ob_start();
session_start();

require_once ("class/Client.php");
require_once ("lib/fpdf17/fpdf.php");
$client = new CLIENT();
if ($client->isConnecte() == "") {
    $client->Redirection('connexion.php');
}
?>
<?php include ("inc/header.php"); ?>

<?php
ob_end_clean();


if(isset($_GET["id"])){
  $id_commande = $_GET["id"];
  $commandes = $DB->query('SELECT * FROM commande WHERE IDCommande = '. $id_commande .'');
  if(!$commandes == null){
    foreach($commandes as $commande){
      if($commande->IDClient <> $infoClient["IDClient"]){
          header("Location: index.php");
      }
    }
  }else{
  header("Location: index.php");
}
}else{
  header("Location: index.php");
}


foreach($commandes as $commande){
  $date = $commande->DateCommande;
  $num_commande = $commande->NumCommande;
  $id_client = $commande->IDClient;
  $clients = $DB->query('SELECT * FROM clients WHERE IDClient = '. $id_client .'');
  foreach($clients as $client){
    $chaine_facturee = utf8_decode("Facturée à: " . $client->Nom . " " . $client->Prenom);
  }
  $id_adresse = $commande->IDAdresseLivraison;
  $adresses = $DB->query('SELECT * FROM adresse WHERE IDAdresse = '. $id_adresse .'');
  foreach($adresses as $adresse){
    $chaine_adresse_1 = utf8_decode($adresse->Adresse1);
    $chaine_adresse_2 = utf8_decode($adresse->Adresse2);
    $chaine_cp = utf8_decode($adresse->CodePostal);
    $chaine_ville = utf8_decode($adresse->Ville);
    $chaine_pays = utf8_decode($adresse->Pays);
  }
$pdf = new FPDF('P','mm','A4');
$pdf->AddPage();

$pdf->SetFont('Arial','B',14);

$nom_entreprise = utf8_decode("Les Délices de Rachida");
$pdf->Cell(130 ,5,$nom_entreprise,0,0);
$pdf->Cell(59 ,5,'FACTURE',0,1);

$pdf->SetFont('Arial','',12);

$pdf->Cell(130 ,5,'45 Rue du Segment',0,0);
$pdf->Cell(59 ,5,'',0,1);

$pdf->Cell(130 ,5,'75015, Paris',0,0);
$pdf->Cell(25 ,5,'Date',0,0);
$pdf->Cell(34 ,5,$date,0,1);

$pdf->Cell(130 ,5,'Telephone: 04.65.69.62.61',0,0);
$pdf->Cell(25 ,5,'Commande ',0,0);
$pdf->Cell(34 ,5,$num_commande,0,1);


$pdf->Cell(189 ,10,'',0,1);

$pdf->Cell(100 ,5,$chaine_facturee,0,1);

$pdf->Cell(10 ,5,'',0,0);
$pdf->Cell(90 ,5,'Livraison:',0,1);

$pdf->Cell(10 ,5,'',0,0);
$pdf->Cell(90 ,5,$chaine_adresse_1,0,1);

$pdf->Cell(10 ,5,'',0,0);
$pdf->Cell(90 ,5,$chaine_adresse_2,0,1);

$pdf->Cell(10 ,5,'',0,0);
$pdf->Cell(90 ,5,$chaine_cp,0,1);

$pdf->Cell(10 ,5,'',0,0);
$pdf->Cell(90 ,5,$chaine_ville,0,1);

$pdf->Cell(10 ,5,'',0,0);
$pdf->Cell(90 ,5,$chaine_pays,0,1);
$pdf->Cell(189 ,10,'',0,1);

$pdf->SetFont('Arial','B',12);

$pdf->Cell(130 ,5,'Description',1,0);
$pdf->Cell(25 ,5,'Quantite',1,0);
$pdf->Cell(34 ,5,'Prix',1,1);

$pdf->SetFont('Arial','',12);


 $produits = $DB->query('SELECT IDProduit, Quantite FROM commande_produits WHERE IDCommande  = ' . $id_commande  . '');
foreach ($produits as $produit){
$get_produits = $DB->query('SELECT * FROM produit WHERE IDProduit = ' . $produit->IDProduit  . '');
 foreach ($get_produits as $get_produit){
   $nom_produit = utf8_decode($get_produit->LibelleProduit);
   $prix_produit = utf8_decode($produit->Quantite . " x " . $get_produit->PrixUnitaireHT . " euro(s)");
   $pdf->Cell(130 ,5,$nom_produit,1,0);
   $pdf->Cell(25 ,5,$produit->Quantite,1,0);
   $pdf->Cell(34 ,5,$prix_produit,1,1,'R');
}
}

$total_ht = utf8_decode($commande->TotalHT);
$total_tva = utf8_decode($commande->TotalTVA);
$livraison = utf8_decode($commande->FraisPortTTC);
$total_ttc = utf8_decode($commande->TotalTTC);
define('EURO',chr(128));

$pdf->Cell(130 ,5,'',0,0);
$pdf->Cell(25 ,5,'Total HT',0,0);
$pdf->Cell(4 ,5,EURO,1,0);
$pdf->Cell(30 ,5,$total_ht,1,1,'R');

$pdf->Cell(130 ,5,'',0,0);
$pdf->Cell(25 ,5,'Total TVA',0,0);
$pdf->Cell(4 ,5,EURO,1,0);
$pdf->Cell(30 ,5,$total_tva,1,1,'R');

$pdf->Cell(130 ,5,'',0,0);
$pdf->Cell(25 ,5,'Livraison',0,0);
$pdf->Cell(4 ,5,EURO,1,0);
$pdf->Cell(30 ,5,$livraison,1,1,'R');

$pdf->Cell(130 ,5,'',0,0);
$pdf->Cell(25 ,5,'Total TTC',0,0);
$pdf->Cell(4 ,5,EURO,1,0);
$pdf->Cell(30 ,5,$total_ttc,1,1,'R');



if(isset($_GET["id"])){
  $id_commande = $_GET["id"];
  $commandes = $DB->query('SELECT * FROM commande WHERE IDCommande = '. $id_commande .'');
  if(!$commandes == null){
    $nom_pdf = 'facture-' . $id_commande . '.pdf';
    $pdf->Output($nom_pdf,"D");
  }else{
  header("Location: index.php");
}
}
}



?>
<?php include ("inc/footer.php"); ?>
