<?php $titre = "Mon panier"; ?>
 <?php include("inc/header.php"); ?>
 <div class="breadcrumb-area">
             <div class="container">
                 <div class="row">
                     <div class="col-md-12">
                         <ul class="breadcrumb">
                             <li><a href="index.php"><i class="fa fa-home"></i></a></li>
                             <li><a href="#">Panier</a></li>
                         </ul>
                     </div>
                 </div>
             </div>
         </div>
         <div class="cart-main-area">
             <div class="container">
                 <div class="row">
                     <div class="col-md-12">
                       <?php if(isset($_GET["delPanier"])): ?>
                         <div class="alert alert-success">
                            <i class="glyphicon glyphicon-log-in"></i>  Le produit a bien été supprimé !
                         </div>
                       <?php endif ?>
                         <h1>Mon panier - <?= $panier->count(); ?> produit(s)</h1>
                     </div>
                     <div class="col-md-12 col-sm-12 col-xs-12">
                         <form action="#" method="post">
                             <div class="table-content table-responsive">
                                 <table>
                                     <thead>
                                         <tr>
                                             <td>Image</td>
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
   $images_produits = $DB->query("SELECT * FROM images WHERE IDProduit = $produit->IDProduit ORDER BY OrdreAffichage DESC LIMIT 1 ");
 ?>
                                         <tr>
                                           	<td class="product-thumbnail">
                                           <?php foreach($images_produits as $image_produit): ?>
               													<a href="produit.php?id=<?= $produit->IDProduit ?>"><img class="image-panier" src="images_produits/<?= $image_produit->NomImage ?>" alt="" /></a>
               													<?php endforeach; ?>
                                        </td>
                                             <td class="product-name"><a href="produit.php?id=<?= $produit->IDProduit ?>"><?= $produit->LibelleProduit ?></a></td>
                                             <td class="product-quantity">
                                              <form method="post" action="panier.php">
                                                 <div class="input-group btn-block">
                                                     <input type="text" class="form-control" size="1" name="panier[quantity][<?= $produit->IDProduit; ?>]" value="<?= $_SESSION['panier'][$produit->IDProduit]; ?>">
                                                     <span class="input-btn">
                                                         <button class="btn-primary" title="" data-toggle="tooltip" type="submit" data-original-title="Mettre à jour"><i class="fa fa-refresh"></i></button>
                                                         <a href="panier.php?delPanier=<?= $produit->IDProduit ?>"><button class="btn-danger" title="" data-toggle="tooltip" type="button" data-original-title="Supprimer"><i class="fa fa-times-circle"></i></button></a>
                                                     </span>
                                                 </div>
                                               </form>
                                             </td>
                                             <td class="product-price"><span class="amount"><?= $produit->PrixUnitaireHT ?></span>€</td>
                                             <td class="product-subtotal"><?php echo $_SESSION['panier'][$produit->IDProduit] * $produit->PrixUnitaireHT ?>€</td>
                                         </tr>
                                         <?php endforeach; ?>
                                     </tbody>
                                 </table>
                             </div>
                         </form>
                     </div>
                 </div>
                 <div class="row">
                     <div class="col-sm-4 col-sm-offset-8">
                         <table class="table table-bordered">
                             <tbody>
                                 <tr>
                                     <td class="text-right"><strong>Sous-total:</strong></td>
                                     <td class="text-right"><?= number_format($panier->total(),2,',',' '); ?>€</td>
                                 </tr>
                                 <tr>
                                     <td class="text-right"><strong>TVA (20%):</strong></td>
                                     <td class="text-right"><?= round($panier->total() / 100 * 20, 2) ?>€</td>
                                 </tr>
                                 <tr>
                                     <td class="text-right"><strong>Total:</strong></td>
                                     <td class="text-right"><?= round($panier->total() * 1.20, 2) ?>€</td>
                                 </tr>
                             </tbody>
                         </table>
                     </div>
                 </div>
                 <div class="row">
                     <div class="col-md-12">
                         <div class="buttons">
                             <div class="pull-left"><a class="btn btn-default" href="index.php">Continuer vos achats</a></div>
                             <div class="pull-right"><a class="btn btn-primary" href="paiement.php">Paiement</a></div>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
         <!--cart main area end -->

 <?php include("inc/footer.php"); ?>
