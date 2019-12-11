<?php $titre = "Mon compte"; ?>
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


if(isset($_POST['editcompte']))
{
  $email = strip_tags($_POST['email']);
  $pseudo = utf8_decode(strip_tags($_POST['pseudo']));
  $motdepasse = strip_tags($_POST['motdepasse']);
  if(isset($_POST['civilite'])){
  $civilite = strip_tags($_POST['civilite']);}
  $prenom = utf8_decode(strip_tags($_POST['prenom']));
  $nom = utf8_decode(strip_tags($_POST['nom']));
  $telephone = strip_tags($_POST['telephone']);
  $question = utf8_decode(strip_tags($_POST['question']));
  $reponse = utf8_decode(strip_tags($_POST['reponse']));
  $id_client = strip_tags($_POST['id_client']);

  if($_POST['nom']<>""){
    try  {  if($client->edit_client_nom($nom,$id_client)){ header('Location: compte.php?succes_compte=0'); }  } catch(PDOException $e) { echo $e->getMessage(); } }
  if($_POST['prenom']<>""){
    try  {  if($client->edit_client_prenom($prenom,$id_client)){ header('Location: compte.php?succes_compte=0'); }  } catch(PDOException $e) { echo $e->getMessage(); } }
  if($_POST['pseudo']<>""){
    try  {  if($client->edit_client_pseudo($pseudo,$id_client)){ header('Location: compte.php?succes_compte=0'); }  } catch(PDOException $e) { echo $e->getMessage(); } }
  if($_POST['email']<>""){
    try  {  if($client->edit_client_email($email,$id_client)){ header('Location: compte.php?succes_compte=0'); }  } catch(PDOException $e) { echo $e->getMessage(); } }
  if($_POST['motdepasse']<>"" && $_POST['mdprpt']<>""){
      if($_POST['mdprpt'] == $_POST['motdepasse'] || $_POST['motdepasse'] == $_POST['mdprpt']){
    try  {  if($client->edit_client_motdepasse($motdepasse,$id_client)){ header('Location: compte.php?succes_compte=0'); }  } catch(PDOException $e) { echo $e->getMessage(); } }}else{ $erreur[] = "Les mots de passes ne correspondent pas!";}
  if(isset($_POST['civilite'])){
    try  {  if($client->edit_client_civilite($civilite,$id_client)){ header('Location: compte.php?succes_compte=0'); }  } catch(PDOException $e) { echo $e->getMessage(); } }
  if($_POST['telephone']<>""){
    try  {  if($client->edit_client_telephone($telephone,$id_client)){ header('Location: compte.php?succes_compte=0'); }  } catch(PDOException $e) { echo $e->getMessage(); } }
  if($_POST['question']<>""){
    try  {  if($client->edit_client_question($question,$id_client)){ header('Location: compte.php?succes_compte=0'); }  } catch(PDOException $e) { echo $e->getMessage(); } }
  if($_POST['reponse']<>""){
    try  {  if($client->edit_client_reponse($reponse,$id_client)){ header('Location: compte.php?succes_compte=0'); }  } catch(PDOException $e) { echo $e->getMessage(); } }
  }


if (isset($_GET["delete"])) {
    $id_adresse = $_GET["delete"];
    if ($adresse->supprimer_adresse($id_adresse)) {
        header('Location: compte.php?del_success=1');
    }
}

if (isset($_GET["annuler"])) {
    $id_commande = $_GET["annuler"];
    $etat = utf8_decode(strip_tags("Annulée"));
    if ($commande->annuler_commande($etat,$id_commande)) {
        header('Location: compte.php?succes_annulation=1');
    }
}

if (isset($_POST["btn-addr"])) {
    if ($_POST["type_addr"] == "Facturation") {
        $nom_addr_fact = utf8_decode(strip_tags($_POST['nom_addr']));
        $prenom_addr_fact = utf8_decode(strip_tags($_POST['prenom_addr']));
        $societe_addr_fact = utf8_decode(strip_tags($_POST['societe_addr']));
        $addr1_addr_fact = utf8_decode(strip_tags($_POST['addr1_addr']));
        $addr2_addr_fact = utf8_decode(strip_tags($_POST['addr2_addr']));
        $ville_addr_fact = utf8_decode(strip_tags($_POST['ville_addr']));
        $cp_addr_fact = utf8_decode(strip_tags($_POST['cp_addr']));
        $pays_addr_fact = utf8_decode(strip_tags($_POST['pays_addr']));
        $type_addr_fact = "Facturation";
        $IDClient = strip_tags($_POST['id_client']);
        if ($nom_addr_fact == "") {
            $erreur[] = "Merci de renseigner le nom lié à l'adresse de facturation!";
        } else if ($prenom_addr_fact == "") {
            $erreur[] = "Merci de renseigner le prénom lié à l'adresse de facturation!";
        } else if ($addr1_addr_fact == "") {
            $erreur[] = "Merci de renseigner l'adresse liée à l'adresse de facturation!!";
        } else if ($ville_addr_fact == "") {
            $erreur[] = "Merci de renseigner la ville liée à l'adresse de facturation! !";
        } else if ($cp_addr_fact == "") {
            $erreur[] = "Merci de renseigner le code postal lié à l'adresse de facturation! !";
        } else if ($pays_addr_fact == "") {
            $erreur[] = "Merci de renseigner le pays lié à l'adresse de facturation! !";
        } else {
            try {
                if ($adresse->ajouter_adresse_fact($nom_addr_fact, $prenom_addr_fact, $societe_addr_fact, $addr1_addr_fact, $addr2_addr_fact, $ville_addr_fact, $cp_addr_fact, $pays_addr_fact, $IDClient, $type_addr_fact)) {
                    header('Location: compte.php?succes');
                }
            }
            catch(PDOException $e) {
                echo $e->getMessage();
            }
        }
    } else if ($_POST["type_addr"] == "Livraison") {
        $nom_addr_livraison = utf8_decode(strip_tags($_POST['nom_addr']));
        $prenom_addr_livraison = utf8_decode(strip_tags($_POST['prenom_addr']));
        $societe_addr_livraison = utf8_decode(strip_tags($_POST['societe_addr']));
        $addr1_addr_livraison = utf8_decode(strip_tags($_POST['addr1_addr']));
        $addr2_addr_livraison = utf8_decode(strip_tags($_POST['addr2_addr']));
        $ville_addr_livraison = utf8_decode(strip_tags($_POST['ville_addr']));
        $cp_addr_livraison = utf8_decode(strip_tags($_POST['cp_addr']));
        $pays_addr_livraison = utf8_decode(strip_tags($_POST['pays_addr']));
        $type_addr_livraison = "Livraison";
        $IDClient = strip_tags($_POST['id_client']);
        if ($nom_addr_livraison == "") {
            $erreur[] = "Merci de renseigner le nom lié à l'adresse de livraison!";
        } else if ($prenom_addr_livraison == "") {
            $erreur[] = "Merci de renseigner le prénom lié à l'adresse de livraison!";
        } else if ($addr1_addr_livraison == "") {
            $erreur[] = "Merci de renseigner l'adresse liée à l'adresse de livraison!!";
        } else if ($ville_addr_livraison == "") {
            $erreur[] = "Merci de renseigner la ville liée à l'adresse de livraison! !";
        } else if ($cp_addr_livraison == "") {
            $erreur[] = "Merci de renseigner le code postal lié à l'adresse de livraison! !";
        } else if ($pays_addr_livraison == "") {
            $erreur[] = "Merci de renseigner le pays lié à l'adresse de livraison! !";
        } else {
            try {
                if ($adresse->ajouter_adresse_livraison($nom_addr_livraison, $prenom_addr_livraison, $societe_addr_livraison, $addr1_addr_livraison, $addr2_addr_livraison, $ville_addr_livraison, $cp_addr_livraison, $pays_addr_livraison, $IDClient, $type_addr_livraison)) {
                    header('Location: compte.php?succes');
                }
            }
            catch(PDOException $e) {
                echo $e->getMessage();
            }
        }
    }
}
?>
<?php include ("inc/header.php"); ?>
<?php $clients = $DB->query('SELECT * FROM clients WHERE IDClient = '. $infoClient['IDClient'] .''); ?>

<div class="breadcrumb-area">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <ul class="breadcrumb">
                            <li><a href="index.php"><i class="fa fa-home"></i></a></li>
                            <li><a href="#">Mon compte</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="account-area">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">

                        <div class="account-link-list">
                            <h1>Mon compte</h1>
                            <?php
if (isset($erreur)) {
    foreach ($erreur as $erreur) {
?>
                                   <div class="alert alert-danger">
                                      <i class="glyphicon glyphicon-warning-sign"></i> &nbsp; <?php echo $erreur; ?>
                                   </div>
                                   <?php
    }
} else if (isset($_GET['succes'])) {
?>
                               <div class="alert alert-success">
                                    <i class="glyphicon glyphicon-log-in"></i> &nbsp; Adresse ajoutée !
                               </div>
                               <?php
} else if (isset($_GET['del_success'])) {
?>

                            <div class="alert alert-success">
                                 <i class="glyphicon glyphicon-log-in"></i> &nbsp; Adresse supprimée !
                            </div>

                            <?php
} else if (isset($_GET['succes_annulation'])) {
?>

                         <div class="alert alert-success">
                              <i class="glyphicon glyphicon-log-in"></i> &nbsp; Commande annulée !
                         </div>

<?php
} else if (isset($_GET['succes_compte'])) {
?>

<div class="alert alert-success">
  <i class="glyphicon glyphicon-log-in"></i> &nbsp; Informations personnelles modifiées !
</div>
<?php
} ?>
                            <p class="account-info">Bienvenue sur votre espace membre, <strong><?php echo $infoClient["Prenom"]; ?></strong> ! </p><p>Vous pouvez depuis celui-ci accéder à vos commandes, modifier vos informations personnelles...</p>
                            <div class="panel-group" id="accordion listecommande" role="tablist" aria-multiselectable="true">
                                <div class="panel panel-default">
                                    <div class="panel-heading" role="tab" id="Tab1">
                                        <h4 class="panel-title">
                                            <a role="button" data-toggle="collapse" data-parent="#accordion" href="#commandes">
                                                <i class="fa fa-list-ol"></i><span>Historique de commandes</span>
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="commandes" class="panel-collapse collapse" role="tabpanel" aria-labelledby="Tab1">
                                        <div class="panel-body">
                                      <?php $commandes = $DB->query('SELECT * FROM commande WHERE IDClient = ' . $infoClient["IDClient"] . ' ORDER BY IDCommande DESC'); ?>

                                      <?php foreach ($commandes as $commande): ?>
                                          <div class="row">
                                        <div class="col-sm-8 col-md-offset-2 text-center">
                                        <ul class="address-information">
                                            <li><h3>Commande numéro: <?=$commande->NumCommande ?>  <p>Passée le: <?=$commande->DateCommande ?> à <?=$commande->HeureCommande ?></p></h3></li>
                                                <p><strong>Etat de la commande</strong>:  <span><?php if($commande->EtatCommande == "En attente de préparation..."): ?>
                                                    <span class="label label-warning">En attente de préparation...</span>
                                                  <?php elseif($commande->EtatCommande == "En cours de préparation..."): ?>
                                                    <span class="label label-warning">En cours de préparation...</span>
                                                  <?php elseif($commande->EtatCommande == "Préparée"): ?>
                                                    <span class="label label-success">Préparée</span>
                                                  <?php elseif($commande->EtatCommande == "En cours de livraison..."): ?>
                                                    <span class="label label-info">En cours de livraison...</span>
                                                  <?php elseif($commande->EtatCommande == "Livrée"): ?>
                                                    <span class="label label-success">Livrée</span>
                                                  <?php elseif($commande->EtatCommande == "Annulée"): ?>
                                                    <span class="label label-danger">Annulée</span>
                                                  <?php endif ?></span></p>
                                                <p><strong>Articles commandés</strong>:
                                                  <ul>
                                                <?php $produits = $DB->query('SELECT IDProduit, Quantite FROM commande_produits WHERE IDCommande  = ' . $commande->IDCommande  . ''); ?>
                                                <?php foreach ($produits as $produit): ?>
                                                    <?php $get_produits = $DB->query('SELECT * FROM produit WHERE IDProduit = ' . $produit->IDProduit  . ''); ?>
                                                    <?php foreach ($get_produits as $get_produit): ?>
                                                      <li>    - <?= $get_produit->LibelleProduit ?> x <?= $produit->Quantite ?> (<?= $get_produit->PrixUnitaireHT * $produit->Quantite ?>€)</li>
                                                      <?php endforeach; ?>
                                                  <?php endforeach; ?>
                                                </ul>
                                                <p><strong>Frais de livraison<strong>: <span><?=$commande->FraisPortTTC ?>,00€</span></p>
                                                <p><strong>Total HT</strong>: <span><?=$commande->TotalHT + $commande->FraisPortTTC ?>€</span></p>
                                                <p><strong>Total TTC</strong>: <span><?=$commande->TotalTTC ?>€</span></p>
                                                <li class="btn-compte address-update">
                                                <?php if($commande->EtatCommande == "En attente de préparation..."): ?>

                                                    <a href="compte.php?annuler=<?=$commande->IDCommande ?>" class="btn btn-default delete"><span>Annuler</span></a>

                                              <?php endif ?>
                                              <a href="facture.php?id=<?=$commande->IDCommande ?>" class="btn btn-default primary"><span>Facture</span></a>
                                                </li>

                                        </ul>
                                      </div></div>
                                      <?php endforeach ?>


                                </div>

                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading" role="tab" id="Tab2">
                                        <h4 class="panel-title">
                                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#adresses">
                                                <i class="fa fa-building"></i><span>Mes adresses</span>
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="adresses" class="panel-collapse collapse" role="tabpanel" aria-labelledby="Tab2">
                                        <div class="panel-body">
                                            <p>Vous pouvez ici ajouter et configurer vos adresses de facturation ainsi que de livraison</p>
                                            <p class="panel-title">Vos adresses sont listées ci-dessous. </p>

                                              <?php $adresses = $DB->query('SELECT * FROM adresse WHERE IDClient = ' . $infoClient["IDClient"] . ''); ?>
                                            <div class="row">
                                            <?php foreach ($adresses as $adresse): ?>
                                              <div class="col-md-6">
                                              <ul class="address-information">
                                                  <li><h3>Adresse de <?=$adresse->TypeAdresse ?></h3></li>
                                                  <li>
                                                      <span><?=$adresse->Nom ?></span>
                                                      <span><?=$adresse->Prenom ?></span>
                                                  </li>
                                                  <li>
                                                      <span><?=$adresse->Societe ?></span>
                                                  </li>
                                                  <li>
                                                      <span><?=$adresse->Adresse1 ?></span>
                                                  </li>
                                                  <li>
                                                      <span><?=$adresse->Adresse2 ?></span>
                                                  </li>
                                                  <li>
                                                      <span><?=$adresse->CodePostal ?></span>
                                                  </li>
                                                  </li>
                                                  <li>
                                                      <span><?=$adresse->Ville ?></span>
                                                  </li>
                                                  <li>
                                                      <span><?=$adresse->Pays ?></span>
                                                  </li>

                                                  <li class="address-update">
                                                      <a href="modifier-adresse.php?id=<?=$adresse->IDAdresse ?>" class="btn btn-default"><span>Modifier</span></a>
                                                      <a href="compte.php?delete=<?=$adresse->IDAdresse ?>" class="btn btn-default delete"><span>Supprimer</span></a>
                                                  </li>
                                              </ul>
                                            </div>
                                            <?php endforeach; ?>
                                          </div>
                                          <div class="row">
                                            <div class="col-lg-6 col-md-8 col-sm-10 address">



                                                    <p href="#" id="shipping-box" class="btn btn-default"><span>Ajouter une nouvelle adresse</span></p>
                                                    <div class="clearfix"></div>
                                                    <div id="shipping-box-info">
                                                        <p class="panel-title">Pour ajouter une nouvelle adresse, merci de remplir le formulaire ci-dessous.</p>
                                                        <div class="row">
                                                        <form action="compte.php" method="post">
                                                          <div class="form-group required">
                                                              <label class="col-md-2 col-sm-3 control-label"> Type </label>
                                                              <div class="col-md-10 col-sm-9">
                                                                  <select class="form-control" name="type_addr">
                                                                      <option value="Livraison">Livraison</option>
                                                                      <option value="Facturation">Facturation</option>
                                                                  </select>
                                                              </div>
                                                          </div>
                                                          <div class="form-group required">
                                                              <label class="col-md-2 col-sm-3 control-label">Nom</label>
                                                              <div class="col-md-10 col-sm-9">
                                                                  <input type="text" class="form-control" placeholder="Saisissez votre nom..." value="" name="nom_addr">
                                                              </div>
                                                          </div>
                                                          <div class="form-group required">
                                                              <label class="col-md-2 col-sm-3 control-label">Prénom</label>
                                                              <div class="col-md-10 col-sm-9">
                                                                  <input type="text" class="form-control" placeholder="Saisissez votre prénom" value="" name="prenom_addr">
                                                              </div>
                                                          </div>
                                                          <div class="form-group">
                                                              <label class="col-md-2 col-sm-3 control-label">Société</label>
                                                              <div class="col-md-10 col-sm-9">
                                                                  <input type="text" class="form-control" placeholder="Saisissez votre société (facultatif)" value="" name="societe_addr">
                                                              </div>
                                                          </div>
                                                          <div class="form-group required">
                                                              <label class="col-md-2 col-sm-3 control-label">Adresse 1</label>
                                                              <div class="col-md-10 col-sm-9">
                                                                  <input type="text" class="form-control" placeholder="Saisissez votre adresse..." value="" name="addr1_addr">
                                                              </div>
                                                          </div>
                                                          <div class="form-group">
                                                              <label class="col-md-2 col-sm-3 control-label">Adresse 2</label>
                                                              <div class="col-md-10 col-sm-9">
                                                                  <input type="text" class="form-control" value="" name="addr2_addr">
                                                              </div>
                                                          </div>
                                                          <div class="form-group required">
                                                              <label class="col-md-2 col-sm-3 control-label">Ville</label>
                                                              <div class="col-md-10 col-sm-9">
                                                                  <input type="text" class="form-control" placeholder="Saisissez votre ville..." value="" name="ville_addr">
                                                              </div>
                                                          </div>
                                                          <div class="form-group required">
                                                              <label class="col-md-2 col-sm-3 control-label">CP</label>
                                                              <div class="col-md-10 col-sm-9">
                                                                  <input type="text" class="form-control" placeholder="Saisissez votre code postal..." value="" name="cp_addr">
                                                              </div>
                                                          </div>
                                                          <div class="form-group required">
                                                              <label class="col-md-2 col-sm-3 control-label"> Pays </label>
                                                              <div class="col-md-10 col-sm-9">
                                                                  <select class="form-control" name="pays_addr">
                                                                      <option value=""> --- Sélectionnez votre pays --- </option>
                                                                      <option value="Aaland Islands">Aaland Islands</option>
                                                                      <option value="Afghanistan">Afghanistan</option>
                                                                      <option value="Algeria">Algeria</option>
                                                                      <option value="American Samoa">American Samoa</option>
                                                                      <option value="Andorra">Andorra</option>
                                                                      <option value="Angola">Angola</option>
                                                                      <option value="Antigua and Barbuda">Antigua and Barbuda</option>
                                                                      <option value="Ascension Island (British)">Ascension Island (British)</option>
                                                                      <option value="Australia">Australia</option>
                                                                      <option value="Bangladesh">Bangladesh</option>
                                                                      <option value="Barbados">Barbados</option>
                                                                      <option value="Canada">Canada</option>
                                                                      <option value="Chad">Chad</option>
                                                                      <option value="Chile">Chile</option>
                                                                      <option value="China">China</option>
                                                                      <option value="Colombia">Colombia</option>
                                                                      <option value="Denmark">Denmark</option>
                                                                      <option value="Egypt">Egypt</option>
                                                                      <option value="Ethiopia">Ethiopia</option>
                                                                      <option value="France">France</option>
                                                                      <option value="Germany">Germany</option>
                                                                      <option value="Hong Kong">Hong Kong</option>
                                                                      <option value="Lesotho">Lesotho</option>
                                                                      <option value="Liberia">Liberia</option>
                                                                      <option value="Luxembourg">Luxembourg</option>
                                                                      <option value="Malawi">Malawi</option>
                                                                      <option value="Malaysia">Malaysia</option>
                                                                      <option value="Maldives">Maldives</option>
                                                                      <option value="Mongolia">Mongolia</option>
                                                                      <option value="Montenegro">Montenegro</option>
                                                                      <option value="Montserrat">Montserrat</option>
                                                                      <option value="Morocco">Morocco</option>
                                                                      <option value="Panama">Panama</option>
                                                                      <option value="Papua New Guinea">Papua New Guinea</option>
                                                                      <option value="Paraguay">Paraguay</option>
                                                                      <option value="Peru">Peru</option>
                                                                      <option value="Philippines">Philippines</option>
                                                                      <option value="Puerto Rico">Puerto Rico</option>
                                                                      <option value="Qatar">Qatar</option>
                                                                      <option value="Zambia">Zambia</option>
                                                                      <option value="Zimbabwe">Zimbabwe</option>
                                                                  </select>
                                                              </div>
                                                          </div>
                                                            <div class="col-md-12">
                                                                <div class="buttons">
                                                                    <input type="hidden" name="id_client" value="<?php echo $infoClient["IDClient"]; ?>">
                                                                    <button type="submit" class="btn btn-primary" name="btn-addr">Créer une nouvelle adresse</button>
                                                                </div>
                                                            </div>
                                                          <form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading" role="tab" id="Tab3">
                                        <h4 class="panel-title">
                                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#informations">
                                                <i class="fa fa-user"></i><span>Mes informations personnelles</span>
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="informations" class="panel-collapse collapse" role="tabpanel" aria-labelledby="Tab3">
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="personal-info col-lg-6 col-md-8 col-sm-10">
                                                    <p class="panel-title">Merci de mettre à jour vos informations fréquemment (si changemement.) </p>
                                                    <div id="informations">
                                                      <form action="#" method="post">
                                                        <div class="row">
                                                          <?php foreach ( $clients as $client ):?>
                                                            <div class="form-group fix">
                                                                <label class="col-md-3 col-sm-12 control-label">Civilité</label>
                                                                <div class="col-md-9 col-sm-12">
                                                                    <div class="radio">
                                                                        <label>
                                                                            <span class="social_title">
                                                                                <input type="radio" name="civilite" value="Homme">Homme
                                                                            </span>
                                                                            <span class="social_title">
                                                                                <input type="radio" name="civilite" value="Femme">Femme
                                                                            </span>
                                                                        </label>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="col-md-3 col-sm-12 control-label">Pseudo</label>
                                                                <div class="col-md-9 col-sm-12">
                                                                    <input type="text" class="form-control" placeholder="<?= $client->Pseudo ?>" value="" name="pseudo">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="col-md-3 col-sm-12 control-label">Nom</label>
                                                                <div class="col-md-9 col-sm-12">
                                                                    <input type="text" class="form-control" placeholder="<?= $client->Nom ?>" value="" name="nom">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="col-md-3 col-sm-12 control-label">Prénom</label>
                                                                <div class="col-md-9 col-sm-12">
                                                                    <input type="text" class="form-control" placeholder="<?= $client->Prenom ?>" value="" name="prenom">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="col-md-3 col-sm-12 control-label">Email</label>
                                                                <div class="col-md-9 col-sm-12">
                                                                    <input type="text" class="form-control" placeholder="<?= $client->Email ?>" value="" name="email">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="col-md-3 col-sm-12 control-label">Téléphone</label>
                                                                <div class="col-md-9 col-sm-12">
                                                                    <input type="text" class="form-control" placeholder="<?= $client->Telephone ?>" value="" name="telephone">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="col-md-3 col-sm-12 control-label">Question secrète</label>
                                                                <div class="col-md-9 col-sm-12">
                                                                    <input type="text" class="form-control" placeholder="<?= $client->Question ?>" value="" name="question">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="col-md-3 col-sm-12 control-label">Réponse secrète</label>
                                                                <div class="col-md-9 col-sm-12">
                                                                    <input type="text" class="form-control" placeholder="" value="" name="reponse">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="col-md-3 col-sm-12 control-label"> Mot de passe</label>
                                                                <div class="col-md-9 col-sm-12">
                                                                    <input type="password" name="motdepasse" class="form-control psw">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="col-md-3 col-sm-12 control-label"> Répetez </label>
                                                                <div class="col-md-9 col-sm-12">
                                                                    <input type="password" name="mdprpt" class="form-control psw">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="check-box">
                                                                    <label>
                                                                        <div id="newsletter">
                                                                            <span><input type="checkbox" value="1" name="newsletter" id="newsletter"></span>
                                                                            <span>S'inscrire à notre newsletter</span>
                                                                        </div>
                                                                    </label>
                                                                </div>
                                                                <div class="button-save">
                                                                    <input type="hidden" name="id_client" value="<?= $client->IDClient ?>">
                                                                    <button type="submit" class="btn btn-default" name="editcompte" href="#"><span>Sauvegarder</span></a>
                                                                </div>
                                                              <?php endforeach ?>
                                                            </div>
                                                              </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-default" id="listeSouhait">
                                    <div class="panel-heading" role="tab" id="Tab5">
                                        <h4 class="panel-title">
                                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#listedesouhaits">
                                                <i class="fa fa-heart"></i><span>Ma liste de souhaits (1)</span>
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="listedesouhaits" class="panel-collapse collapse" role="tabpanel" aria-labelledby="Tab5">
                                        <div class="panel-body">
                                            <div class="row">
                                              <div class="col-md-4" >

                                                  <div class="single-product"  >

                                                      <div class="product-image">
                                                          <a href="">

                                                              <img src="">

                                                          </a>
                                                          <div class="rating"><img alt="" src="img/icon/star.png"></div>
                                                      </div>
                                                      <div class="product-text">




                                                            <div class="p-name"><a href=""> NomProduit</a></div>
                                                          <div class="p-price">
                                                            <!--formate les chiffres comme on veut donc la 2 chiffres après la virgule, seulement 2 ou 4 arguments !-->
                                                            <a class="price">Prix €</a>
                                                              <!--<span class="price-old">€1,00</span> <span class="price-new">0,50€</span> !-->
                                                          </div>
                                                          <div class="cart-links">
                                                              <div class="add-to-cart">
                                                                  <a class="addPanier" href="addpanier.php?id="><button type="button"><i class="fa fa-shopping-cart"></i>Ajouter au panier</button></a>
                                                              </div>
                                                              <ul class="add-to-link">
                                                                  <li><button type="button"><i class="fa fa-heart"></i></button></li>
                                                              </ul>
                                                          </div>

                                                      </div>
                                                  </div>

                                              </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="button-back">
                            <a class="btn btn-default" href="index.php"><span>Retourner sur le site...</span></a>
                        </div>
                        <div class="button-home">
                            <a class="btn btn-default" href="panier.php"><span>Panier</span></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<?php include ("inc/footer.php"); ?>
