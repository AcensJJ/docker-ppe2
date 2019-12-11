<?php $titre = "Paiement"; ?>
<?php
require_once("class/Client.php");
require_once("class/Adresse.php");
$connexion = new CLIENT();
$adresse = new ADRESSE();
if(isset($_POST['btn-connexion']))
{
    session_start();
    $upseudo = strip_tags($_POST['mail_ou_pseudo']);
    $umail = strip_tags($_POST['mail_ou_pseudo']);
    $upass = strip_tags($_POST['pass']);

    if($connexion->connexion($upseudo,$umail,$upass))
    {
        $connexion->Redirection('paiement.php');
    }
    else
    {
        $erreur_co = "Mauvais identifiants !";
    }
}


?>
 <?php include("inc/header.php"); ?>
 <?php if($panier->count() == 0){
   header('Location: index.php');
 } ?>
 <?php
 if(isset($_POST["confirmer"])){
   if(isset($_POST['addr_fact_choix'])){ $addr_fact_choix = strip_tags($_POST['addr_fact_choix']); }
   if(isset($_POST['addr_fact_choix'])){ $addr_livraison_choix = strip_tags($_POST['addr_livraison_choix']);}
   $commentaire = utf8_decode(strip_tags($_POST['commentaire']));
   if(isset($_POST['accord'])){ $accord = strip_tags($_POST['accord']); }

   if(!isset($addr_fact_choix)){
     $erreur[] = "Veuillez sélectionner une adresse de facturation !";
   }else{
     $_SESSION["addr_fact_choix"] = $addr_fact_choix;
   }

   if(!isset($addr_livraison_choix)){
     $erreur[] = "Veuillez sélectionner une adresse de livraison !";
   }else{
     $_SESSION["addr_livraison_choix"] = $addr_livraison_choix;
   }

   if(isset($addr_livraison_choix)){
     $_SESSION["commentaire"] = $commentaire;
   }

   if(isset($accord) && $accord = '1'){
     $_SESSION["accord"] = $accord;
   }else{
     $erreur[] = "Veuillez accepter les conditions générales de ventes !";
   }
 } ?>
 <div class="breadcrumb-area">
             <div class="container">
                 <div class="row">
                     <div class="col-md-12">
                         <ul class="breadcrumb">
                             <li><a href="index.php"><i class="fa fa-home"></i></a></li>
                             <li><a href="panier.php">Panier</a></li>
                             <li><a href="#">Paiement</a></li>
                         </ul>
                     </div>
                 </div>
             </div>
         </div>
         <div class="checkout-area">
             <div class="container">
                 <div class="row">
                   <?php
                 if(isset($erreur))
                 {
                 foreach($erreur as $erreur)
                 {
                 ?>
                          <div class="alert alert-danger">
                             <i class="glyphicon glyphicon-warning-sign"></i> &nbsp; <?php echo $erreur; ?>
                          </div>
                          <?php
                 }
}else if(!isset($erreur) && isset($_POST["confirmer"])){


                 ?>

                 <div class="alert alert-success">
                    <i class="glyphicon glyphicon-warning-sign"></i> &nbsp; Informations validées! Vous pouvez maintenant passer au paiement !
                 </div>
               <?php }else if(isset($erreur_co) && isset($_POST["btn-connexion"])){?>
                 <div class="alert alert-danger">
                    <i class="glyphicon glyphicon-warning-sign"></i> &nbsp;  <?php echo $erreur_co; ?>
                 </div>
       <?php } ?>
                     <div class="col-md-12">
                         <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                           <?php if($connexion->isConnecte()!=""):?>
                             <div class="panel panel-default">
                                 <div class="panel-heading" role="tab" id="Etape1">
                                     <h4 class="panel-title">
                                         <a role="button" data-toggle="collapse" data-parent="#accordion" href="#connexion">Etape 1: Connexion <i class="fa fa-caret-down"></i></a>
                                     </h4>
                                 </div>
                               </div>
                               <div class="panel panel-default">
                                   <div class="panel-heading" role="tab" id="Etape2">
                                       <h4 class="panel-title">
                                           <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#addrfacturation">Etape 2: Adresse de facturation <i class="fa fa-caret-down"></i></a>
                                       </h4>
                                   </div>
                                   <div id="addrfacturation" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="Etape2">
                                     <form action="paiement.php" name="confirmer" method="post">
                                       <div class="panel-body">
                                               <div class="radio">
                                                   <label>
                                                       <input id="addr_facturation_existante" type="radio" checked="checked" value="exist_address" name="addresse_fact">Je veux utiliser une adresse existante</label>
                                               </div>
                                               <div id="addr_facturation_existante">
                                                   <select class="form-control" name="addr_fact_choix">
                                                       <?php $adresses = $DB->query('SELECT * FROM adresse WHERE IDClient = '.$infoClient["IDClient"].' AND TypeAdresse = "Facturation"'); ?>
                                                     <?php foreach ( $adresses as $adresse ):?>
                                                         <option name="addr_fact_choix" value="<?= $adresse->IDAdresse ?>"><?= $adresse->Nom; ?> <?= $adresse->Prenom; ?>  <?php echo '(' . $adresse->Societe . ')'; ?> - <?= $adresse->Adresse1; ?> <?= $adresse->Adresse2; ?>, <?= $adresse->CodePostal; ?> <?= $adresse->Ville; ?></option>
                                                     <?php endforeach; ?>

                                                   </select>
                                               </div>
                                               <div class="radio">
                                                   <label>
                                                       <input id="new_addr_facturation" type="radio" value="new_addr_facturation" name="addresse_fact"><a href="compte.php">Je souhaite créer une nouvelle adresse</a>
                                                   </label>
                                               </div>
                                       </div>
                                   </div>
                               </div>
                               <div class="panel panel-default">
                                   <div class="panel-heading" role="tab" id="Etape3">
                                       <h4 class="panel-title">
                                           <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#livraison">Etape 3: Adresse de livraison <i class="fa fa-caret-down"></i></a>
                                       </h4>
                                   </div>
                                   <div id="livraison" class="panel-collapse collapse" role="tabpanel" aria-labelledby="Etape3">
                                     <div class="panel-body">
                                             <div class="radio">
                                                 <label>
                                                     <input id="addr_livraison_existante" type="radio" checked="checked" value="exist_address" name="address_billing">Je veux utiliser une adresse existante</label>
                                             </div>
                                             <div id="addr_livraison_existante">
                                                 <select class="form-control" name="addr_livraison_choix">
                                                   <?php $adresses = $DB->query('SELECT * FROM adresse WHERE IDClient = '.$infoClient["IDClient"].' AND TypeAdresse = "Livraison"'); ?>
                                                 <?php foreach ( $adresses as $adresse ):?>
                                                     <option name="addr_livraison_choix" value="<?= $adresse->IDAdresse ?>"><?= $adresse->Nom; ?> <?= $adresse->Prenom; ?>  <?php echo '(' . $adresse->Societe . ')'; ?> - <?= $adresse->Adresse1; ?> <?= $adresse->Adresse2; ?>, <?= $adresse->CodePostal; ?> <?= $adresse->Ville; ?></option>
                                                 <?php endforeach; ?>
                                                 </select>
                                             </div>
                                             <div class="radio">
                                                 <label>
                                                     <input id="new_addr_livraison" type="radio" value="nouvelle_adresse"><a href="compte.php">Je souhaite créer une nouvelle adresse</a>
                                                 </label>
                                             </div>
                                     </div>
                                   </div>
                               </div>
                               <div class="panel panel-default">
                                   <div class="panel-heading" role="tab" id="Etape4">
                                       <h4 class="panel-title">
                                           <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#methode_livraison">Etape 4: Livraison <i class="fa fa-caret-down"></i></a>
                                       </h4>
                                   </div>
                                   <div id="methode_livraison" class="panel-collapse collapse" role="tabpanel" aria-labelledby="Etape4">
                                       <div class="panel-body">
                                           <p class="strong">Livraison basique</p>
                                           <div class="radio">
                                               <label>
                                                   <input type="radio" checked="checked">Livraison de 48H à 72H - 5.00€</label>
                                           </div>
                                           <p class="strong">Ajouter un commentaire pour la commande...</p>
                                           <textarea class="form-control" rows="8" name="commentaire"></textarea>
                                           <div class="buttons">
                                               <div class="pull-right"><a class="btn btn-primary" data-toggle="collapse" href="#methode_paiement">Suivant</a></div>
                                           </div>
                                       </div>
                                   </div>
                               </div>
                               <div class="panel panel-default">
                                   <div class="panel-heading" role="tab" id="Etape5">
                                       <h4 class="panel-title">
                                           <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#methode_paiement">Etape 5: Méthode de paiement <i class="fa fa-caret-down"></i></a>
                                       </h4>
                                   </div>
                                   <div id="methode_paiement" class="panel-collapse collapse" role="tabpanel" aria-labelledby="Etape5">
                                       <div class="panel-body">
                                           <p>Sélectionnez votre méthode de paiement</p>
                                           <div class="radio">
                                               <label>
                                                   <input type="radio" checked="checked">PayPal </label>
                                           </div>
                                           <div class="buttons">
                                               <div class="pull-right">
                                                   <span>J'ai lu et j'accepte les</span>
                                                   <a class="agree" href="#"><b>Conditions Générales de Ventes</b></a>
                                                   <input type="checkbox" value="1" name="accord"/>
                                                   <a class="btn btn-primary" data-toggle="collapse" href="#confirmation">Suivant</a>
                                               </div>
                                           </div>
                                       </div>
                                   </div>
                               </div>
                               <div class="panel panel-default">
                                   <div class="panel-heading" role="tab" id="Etape6">
                                       <h4 class="panel-title">
                                           <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#confirmation">Etape 6: Confirmation de la commande <i class="fa fa-caret-down"></i></a>
                                       </h4>
                                   </div>
                                   <div id="confirmation" class="panel-collapse collapse" role="tabpanel" aria-labelledby="Etape6">
                                       <div class="panel-body">
                                           <div class="table-responsive">
                                               <table class="table-content table-hover">
                                                   <thead>
                                                       <tr>
                                                           <td>Nom du produit</td>
                                                           <td>Quantité</td>
                                                           <td>Prix unitaire</td>
                                                           <td>Total</td>
                                                       </tr>
                                                   </thead>
                                                   <tbody>
                                                     <?php
               $ids = array_keys($_SESSION['panier']);
               if(empty($ids)){
                 $produits = array();
               }else{
                 $produits = $DB->query('SELECT * FROM produit WHERE IDProduit IN ('.implode(',',$ids).')');
               }
               foreach($produits as $produit):

               ?>
                                                       <tr>
                                                           <td><a href="produit.php?id=<?= $produit->IDProduit ?>"><?= $produit->LibelleProduit ?></a></td>
                                                           <td><?= $_SESSION['panier'][$produit->IDProduit]; ?></td>
                                                           <td><?= $produit->PrixUnitaireHT ?>€</td>
                                                           <td><?php echo $_SESSION['panier'][$produit->IDProduit] * $produit->PrixUnitaireHT ?>€</td>
                                                       </tr>
            <?php endforeach ?>
                                                   </tbody>
                                                   <tfoot>
                                                       <tr>
                                                           <td colspan="4"><strong>Sous-total:</strong></td>
                                                           <td><?= number_format($panier->total(),2,',',' '); ?>€</td>
                                                       </tr>
                                                       <tr>
                                                           <td colspan="4"><strong>TVA (20%):</strong></td>
                                                           <td><?= round($panier->total() / 100 * 20, 2) ?>€</td>
                                                       </tr>
                                                       <tr>
                                                           <td colspan="4"><strong>Livraison:</strong></td>
                                                           <td>5,00€</td>
                                                       </tr>
                                                       <tr>
                                                           <td colspan="4"><strong>Total:</strong></td>
                                                           <td><?= round($panier->total() * 1.20 + 5, 2) ?>€</td>
                                                       </tr>
                                                   </tfoot>
                                               </table>
                                           </div>
                                           <div class="buttons">
                                            <button type="submit" class="btn btn-primary" name="confirmer">Confirmer</button>
                                          </form>
                                           </div>
                                       </div>
                                   </div>
                               </div>
                               <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" target="_top">
<input type="hidden" name="cmd" value="_xclick">
<input type="hidden" name="business" value="LZ9G6Z74Y95PE">
<input type="hidden" name="lc" value="FR">
<input type="hidden" name="item_name" value="Les Delices de Rachida">
<input type="hidden" name="amount" value="<?= round($panier->total() * 1.20 + 5, 2) ?>">
<input type="hidden" name="currency_code" value="EUR">
<input type="hidden" name="button_subtype" value="services">
<input type="hidden" name="no_note" value="0">
<input type="hidden" name="cn" value="Ajouter des instructions particulières pour le vendeur :">
<input type="hidden" name="no_shipping" value="2">
<input type="hidden" name="rm" value="1">
<input type="hidden" name="return" value="https://<?php echo $_SERVER['HTTP_HOST']; ?>/confirmation.php">
<input type="hidden" name="cancel_return" value="https://<?php echo $_SERVER['HTTP_HOST']; ?>">
<input type="hidden" name="bn" value="PP-BuyNowBF:btn_buynowCC_LG.gif:NonHosted">
<input type="hidden" name="notify_url" value="https://<?php echo $_SERVER['HTTP_HOST']; ?>/class/PayPal.php">



                                <?php if(!isset($erreur) && isset($_POST["confirmer"])){ ?>

                                <button type="submit" class="paiement btn btn-primary" name="submit">Procéder au paiement</button>



                                </form>
								<a href="confirmation.php"><button class="paiement btn btn-primary">Simulation (localhost)</button></a>
								<?php }else{ ?>
								</form>
								<?php } ?>

                           <?php else: ?>
                             <div class="panel panel-default">
                                 <div class="panel-heading" role="tab" id="Etape1">
                                     <h4 class="panel-title">
                                         <a role="button" data-toggle="collapse" data-parent="#accordion" href="#connexion">Etape 1: Connexion <i class="fa fa-caret-down"></i></a>
                                     </h4>
                                 </div>
                                 <div id="connexion" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="Etape1">
                                     <div class="panel-body">
                                         <div class="account-area row">
                                             <div class="col-md-6">
                                                 <div class="account-section">
                                                     <h2>Vous n'êtes pas inscrit ?</h2>
                                                     <p>Créez un compte afin de pouvoir commander plus facilement, suivre vos commandes, payer par PayPal sur notre site Internet.</p>
                                                     <a class="btn btn-primary login-register" href="inscription.php">S'inscrire</a>
                                                 </div>
                                             </div>
                                             <div class="col-md-6">
                                               <?php if(isset($erreur)){
                                                 echo '<div class="alert alert-danger">
                                                    <i class="glyphicon glyphicon-warning-sign"></i> &nbsp; '. $erreur .'
                                                 </div>';
                                               }
                                               ?>
                                                 <div class="account-section right-side">
                                                     <h2>Déjà inscrit ?</h2>
                                                     <form  method="post" action="paiement.php">
                                                         <div class="form-group">
                                                             <label class="control-label">Adresse e-mail/pseudo</label>
                                                             <input type="text" class="form-control" id="input-email" placeholder="Saisissez votre adresse e-mail..." value="" name="mail_ou_pseudo">
                                                         </div>
                                                         <div class="form-group">
                                                             <label class="control-label">Mot de passe</label>
                                                             <input type="password" class="form-control" id="input-password" placeholder="Saisissez votre mot de passe..." value="" name="pass">
                                                         </div>
                                                         <input type="submit" class="btn btn-primary" name="btn-connexion" value="Connexion">
                                                     </form>
                                                 </div>
                                             </div>
                                         </div>
                                     </div>
                                 </div>
                             </div>
                          <?php endif ?>
                         </div>
                     </div>
                 </div>
             </div>
         </div>

 <?php include("inc/footer.php"); ?>
