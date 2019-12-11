 <?php $titre = "Détails du produit"; ?>
  <?php include("inc/header.php"); ?>
  <?php
    $id_produit = $_GET["id"];
    if(is_numeric($id_produit)){
    $produit = $DB->query('SELECT * FROM `produit` WHERE `IDProduit` = '.$id_produit.'');
}else{
  header("Location: produits.php");
}


  ?>
  <?php foreach ( $produit as $produit_affiche ):
?>
  <!-- petite nav-bar-->
  <div class="breadcrumb-area">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <ul class="breadcrumb">
                      <li><a href="index.php"><i class="fa fa-home"></i></a></li>
                      <?php $categories = $DB->query('SELECT * FROM categorie WHERE IDCategorie = '. $produit_affiche->IDCategorie .' LIMIT 1'); ?>

                      <?php foreach ($categories as $categorie): ?>
                        <li><a href="produits.php?cat=<?= $categorie->IDCategorie; ?>"><?= $categorie->Libelle; ?></a></li>
                      <li><a href="#"><?= $produit_affiche->LibelleProduit; ?></a></li>
                      <?php endforeach; ?>
                  </ul>
              </div>
          </div>
      </div>
  </div>
  <div class="product-deails-area">
      <div class="container">
          <div class="row">
              <div class="col-lg-9 col-md-9">
                  <div class="product-details-content row">
                      <div class="col-lg-6 col-md-6 col-sm-6">
                        <?php $photos = $DB->query('SELECT * FROM images WHERE IDProduit = '. $produit_affiche->IDProduit .' ORDER BY OrdreAffichage ASC LIMIT 1'); ?>
                        <?php foreach ($photos as $photo): ?>




 <div class="zoomWrapper">
     <div id="img-1" class="zoomWrapper single-zoom">
         <a href="#">
             <img id="zoom1" src="images_produits/<?= $photo->NomImage ?>" data-zoom-image="images_produits/<?= $photo->NomImage; ?>" alt="big-1">
         </a>
     </div>

 </div>





                          <?php endforeach; ?>
                          <div class="product-thumb row">
                              <ul class="p-details-slider" id="gallery_01">
                          <?php $autres_photos = $DB->query('SELECT * FROM images WHERE IDProduit = '. $produit_affiche->IDProduit .' ORDER BY OrdreAffichage ASC LIMIT 5'); ?>
                          <?php foreach ($autres_photos as $autre_photo): ?>


                                    <li class="col-md-4">
                                        <a class="fancybox elevatezoom-gallery" data-fancybox-group="group" href="images_produits/<?= $autre_photo->NomImage ?>" data-image="images_produits/<?= $autre_photo->NomImage ?>" data-zoom-image="images_produits/<?= $autre_photo->NomImage ?>"><img src="images_produits/<?= $autre_photo->NomImage ?>" alt=""></a>
                                    </li>



                            <?php endforeach; ?>
                          </ul>
                      </div>
                      </div>
                      <div class="col-lg-6 col-md-6 col-sm-6">
                          <div class="details-product-name"><h1><?= $produit_affiche->LibelleProduit; ?></h1></div>
                          <ul class="details-product-list">

                          </ul>
                          <div class="product-details-price">
                              <span class="price-new"><?= number_format($produit_affiche->PrixUnitaireHT,2,',',' '); ?>€</span>
                          </div>
                          <div class="form-group">
                              <form action="#" method="post">

                                  <div class="cart-links">
                                      <div class="add-to-cart">
                                            <a class="addPanier" href="addpanier.php?id=<?= $produit_affiche->IDProduit; ?>"><button type="button">Ajouter au panier</button></a>
                                      </div>
                                      <ul class="add-to-link">
                                          <li><button type="button"><i class="fa fa-heart"></i></button></li>
                                      </ul>
                                  </div>
                                  <div class="product-rating">
                                      <div class="rating-star">
                                          <i class="fa fa-star-o"></i>
                                          <i class="fa fa-star-o"></i>
                                          <i class="fa fa-star-o"></i>
                                          <i class="fa fa-star-o"></i>
                                          <i class="fa fa-star-o"></i>
                                      </div>
                                      <a href="#">0 avis</a>
                                      <span>/</span>
                                      <a href="#">Ajouter un avis</a>
                                  </div>
                                  <div class="social-share">
                                      <a class="fb-like">
                                          <div class="fb">
                                             <i></i>
                                              <span>Liker</span>
                                          </div>
                                      </a>
                                      <div class="like">
                                          <span>0</span>
                                      </div>
                                      <a class="tweet" href="#"><i class="fa fa-twitter"></i>Tweet</a>
                                  </div>
                              </form>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
          <div class="row">
              <div class="col-lg-3 col-md-3 col-sm-3">
                  <div class="product-details-tab">
                      <ul role="tablist" class="nav nav-tabs">
                          <li class="active" role="presentation">
                              <a data-toggle="tab" role="tab" aria-controls="description" href="#description" aria-expanded="true">Description</a>
                          </li>
                          <li role="presentation">
                              <a data-toggle="tab" role="tab" aria-controls="review" href="#avis" aria-expanded="false">Avis(0)</a>
                          </li>
                      </ul>
                  </div>
              </div>
              <div class="col-lg-9 col-md-9 col-sm-9">
                  <div class="tab-content">
                      <div id="description" class="tab-pane active" role="tabpanel">
                          <div class="product-description">
                            <p><?= $produit_affiche->Description; ?></p>
                          </div>
                      </div>
                      <div id="avis" class="tab-pane" role="tabpanel">
                          <form action="#" method="post">
                              <p>Il n'y a pas d'avis pour ce produit</p>
                              <h2>Ecrire un avis</h2>
                              <div class="form-group required">
                                  <div class="form-name">
                                      <label for="input-name" class="control-label">Votre nom</label>
                                      <input type="text" class="form-control" id="input-nom" value="" name="nom">
                                  </div>
                              </div>
                              <div class="form-group required">
                                  <div class="form-review">
                                      <label for="input-review" class="control-label">Votre avis</label>
                                      <textarea class="form-control" id="input-avis" rows="5" name="text"></textarea>
                                      <div class="help"><span class="text-danger">Note:</span> HTML non autorisé!</div>
                                  </div>
                              </div>
                              <div class="form-group required">
                                  <div class="form-rating">
                                      <label class="control-label">Note</label>
                                      <span class="bad">Mauvais</span>
                                          <input type="radio" value="1" name="rating">
                                          <input type="radio" value="2" name="rating">
                                          <input type="radio" value="3" name="rating">
                                          <input type="radio" value="4" name="rating">
                                          <input type="radio" value="5" name="rating">
                                      <span class="good">Bon</span>
                                  </div>
                              </div>
                              <div class="buttons clearfix">
                                  <button class="btn-review" type="button">Poster l'avis</button>
                              </div>
                          </form>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>

<?php endforeach; ?>









  <?php include("inc/footer.php"); ?>
