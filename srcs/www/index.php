  <?php $titre = "Accueil"; ?>
  <?php include  $_SERVER['DOCUMENT_ROOT']."/inc/header.php"; ?>
        <!-- Slider -->
        <div class="slider-area-home-one">
            <div class="container">
                <div class="row">

                    <div class="col-md-12">
                        <div class="preview-2">
                            <div id="nivoslider" class="slides">
                                <a href="#"><img src="img/slider/slider-1.jpeg" alt="" title="#slider-1-caption1"/></a>
                                <a href="#"><img src="img/slider/slider-2.jpeg" alt="" title="#slider-1-caption2"/></a>
                            </div>
                            <div id="slider-1-caption1" class="nivo-html-caption nivo-caption">
                                <div class="timeloading"></div>
                                <div class="banner-content slider-2  hidden-xs">
                                    <div class="text-content">
                                        <h1 class="title1"><span>NOS</span></h1>
                                        <h2 class="sub-title"><span>BONBONS</span></h2>
                                        <div class="slider-readmore">
                                            <a href="#" title="shopping now">Acheter dès maintenant</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="slider-1-caption2" class="nivo-html-caption nivo-caption">
                                <div class="timeloading"></div>
                                <div class="banner-content slider-1  hidden-xs">
                                    <div class="text-content">
                                        <h1 class="title1"><span>NOS BONBONS 2</span></h1>
                                        <div class="banner-readmore">
                                            <a href="#" title="shopping now">Achetez dès maintenant</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Fin du Slider-->
        <!-- Services -->
        <div class="service-area-home-one">
            <div class="container">
                <div class="row">

                    <div class="col-lg-4 col-md-4 col-sm-6">
                        <div class="single-service">
                            <div class="service-single-item">
                                <div class="service-icon icon-one"><span>service client</span></div>
                                <div class="service-text">
                                    <h2><span class="dark">support</span> <span class="color">24/7</span></h2>
                                    <div class="service-border-line">
                                        <p>Service client à votre disposition 24H/24 7J/7 !</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6">
                        <div class="single-service">
                            <div class="service-single-item">
                                <div class="service-icon icon-two"><span>support</span></div>
                                <div class="service-text">
                                    <h2><span class="color">Promo</span><span class="dark">tions</span></h2>
                                    <div class="service-border-line">
                                        <p>Des promotions & soldes régulièrement !</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 hidden-sm">
                        <div class="single-service">
                            <div class="service-single-item">
                                <div class="service-icon icon-three"><span>support</span></div>
                                <div class="service-text">
                                    <h2><span class="dark">Livraison</span> <span class="color">gratuite</span></h2>
                                    <div class="service-border-line">
                                        <p>La livraison est gratuite à partir de 25€ d'achats !</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Services-->
        <!-- Slider produits -->



        <div class="product-tab-carousel-area">
            <div class="container">
                <div class="row">
                  <div class="col-lg-12 col-md-12 col-sm-12">


                      <div class="products-tab">
                          <!-- Navigation -->
                          <ul class="nav nav-tabs" role="tablist">
                              <li role="presentation" class="active"><a href="#lesplusaimes" aria-controls="random" role="tab" data-toggle="tab">Les plus aimés</a></li>
                              <li role="presentation"><a href="#lesmoinschers" aria-controls="sale-products" role="tab" data-toggle="tab">Petits budgets</a></li>
                          </ul>
                      </div>
                  </div>
                  <div class="clearfix"></div>
                  <div class="tab-content" >

                      <div role="tabpanel" class="tab-pane active" id="lesplusaimes">


                          <div class="product-tab-carousel" >
                             <!--sort tout les produits de la bdd !-->
                          <?php $produits = $DB->query('SELECT * FROM produit ORDER BY RAND() LIMIT 10'); ?>
                             <!--appelle chaque produit individuellement !-->
                                <?php foreach ( $produits as $produit ):?>

                              <div class="col-md-4" >

                                  <div class="single-product"  >

                                      <div class="product-image">
                                          <a href="produit.php?id=<?= $produit->IDProduit; ?>">
                                            <?php $idproduit = $produit->IDProduit; ?>
                                            <?php $images_produits = $DB->query('SELECT * FROM images  WHERE IDProduit = "'. $idproduit .'" ORDER BY OrdreAffichage ASC LIMIT 1'); ?>
                                              <?php foreach ( $images_produits as $image_produit ):?>
                                              <img src="images_produits/<?= $image_produit->NomImage; ?>">
                                              <?php endforeach; ?>
                                          </a>
                                          <div class="rating"><img alt="" src="img/icon/star.png"></div>
                                      </div>
                                      <div class="product-text">




                                            <div class="p-name"><a href="produit.php?id=<?= $produit->IDProduit; ?>"> <?= $produit->LibelleProduit; ?></a></div>
                                          <div class="p-price">
                                            <!--formate les chiffres comme on veut donc la 2 chiffres après la virgule, seulement 2 ou 4 arguments !-->
                                            <a class="price"><?= number_format($produit->PrixUnitaireHT,2,',',' '); ?> €</a>
                                              <!--<span class="price-old">€1,00</span> <span class="price-new">0,50€</span> !-->
                                          </div>
                                          <div class="cart-links">
                                              <div class="add-to-cart">
                                                  <a class="addPanier" href="addpanier.php?id=<?= $produit->IDProduit; ?>"><button type="button"><i class="fa fa-shopping-cart"></i>Ajouter au panier</button></a>
                                              </div>
                                              <ul class="add-to-link">
                                                  <li><button type="button"><i class="fa fa-heart"></i></button></li>
                                              </ul>
                                          </div>

                                      </div>
                                  </div>

                              </div>
                            <!-- fin de l'appel individuel !-->
                                  <?php endforeach; ?>

</div>
</div>







<div role="tabpanel" class="tab-pane" id="lesmoinschers">


  <div class="product-tab-carousel" >
     <!--sort tout les produits de la bdd !-->
  <?php $produits = $DB->query('SELECT * FROM produit ORDER BY PrixUnitaireHT ASC LIMIT 10'); ?>
     <!--appelle chaque produit individuellement !-->
        <?php foreach ( $produits as $produit ):?>

      <div class="col-md-4" >

          <div class="single-product"  >

              <div class="product-image">
                  <a href="produit.php?id=<?= $produit->IDProduit; ?>">
                    <?php $idproduit = $produit->IDProduit; ?>
                    <?php $images_produits = $DB->query('SELECT * FROM images  WHERE IDProduit = "'. $idproduit .'" ORDER BY OrdreAffichage ASC LIMIT 1'); ?>
                      <?php foreach ( $images_produits as $image_produit ):?>
                      <img src="images_produits/<?= $image_produit->NomImage; ?>">
                      <?php endforeach; ?>
                  </a>
                  <div class="rating"><img alt="" src="img/icon/star.png"></div>
              </div>
              <div class="product-text">




                    <div class="p-name"><a href="produit.php?id=<?= $produit->IDProduit; ?>"> <?= $produit->LibelleProduit; ?></a></div>
                  <div class="p-price">
                    <!--formate les chiffres comme on veut donc la 2 chiffres après la virgule, seulement 2 ou 4 arguments !-->
                    <a class="price"><?= number_format($produit->PrixUnitaireHT,2,',',' '); ?> €</a>
                      <!--<span class="price-old">€1,00</span> <span class="price-new">0,50€</span> !-->
                  </div>
                  <div class="cart-links">
                      <div class="add-to-cart">
                          <a class="addPanier" href="addpanier.php?id=<?= $produit->IDProduit; ?>"><button type="button"><i class="fa fa-shopping-cart"></i>Ajouter au panier</button></a>
                      </div>
                      <ul class="add-to-link">
                          <li><button type="button"><i class="fa fa-heart"></i></button></li>
                      </ul>
                  </div>

              </div>
          </div>

      </div>
    <!-- fin de l'appel individuel !-->
          <?php endforeach; ?>
</div>
</div>
<div class="top5">
                  <?php $produits = $DB->query('SELECT * FROM produit ORDER BY IDCategorie LIMIT 12'); ?>
                     <!--appelle chaque produit individuellement !-->
                        <?php foreach ( $produits as $produit ):?>

                      <div class="col-md-4" >

                          <div class="single-product">

                              <div class="product-image">
                                  <a href="produit.php?id=<?= $produit->IDProduit; ?>">
                                    <?php $idproduit = $produit->IDProduit; ?>
                                    <?php $images_produits = $DB->query('SELECT * FROM images  WHERE IDProduit = "'. $idproduit .'" ORDER BY OrdreAffichage ASC LIMIT 1'); ?>
                                      <?php foreach ( $images_produits as $image_produit ):?>
                                      <img src="images_produits/<?= $image_produit->NomImage; ?>">
                                      <?php endforeach; ?>
                                  </a>
                                  <div class="rating"><img alt="" src="img/icon/star.png"></div>
                              </div>
                              <div class="product-text">




                                    <div class="p-name"><a href="produit.php?id=<?= $produit->IDProduit; ?>"> <?= $produit->LibelleProduit; ?></a></div>
                                  <div class="p-price">
                                    <!--formate les chiffres comme on veut donc la 2 chiffres après la virgule, seulement 2 ou 4 arguments !-->
                                    <a class="price"><?= number_format($produit->PrixUnitaireHT,2,',',' '); ?> €</a>
                                      <!--<span class="price-old">€1,00</span> <span class="price-new">0,50€</span> !-->
                                  </div>
                                  <div class="cart-links">
                                      <div class="add-to-cart">
                                          <a class="addPanier" href="addpanier.php?id=<?= $produit->IDProduit; ?>"><button type="button"><i class="fa fa-shopping-cart"></i>Ajouter au panier</button></a>
                                      </div>
                                      <ul class="add-to-link">
                                          <li><button type="button"><i class="fa fa-heart"></i></button></li>
                                      </ul>
                                  </div>

                              </div>
                          </div>

                      </div>
                    <!-- fin de l'appel individuel !-->
                          <?php endforeach; ?>
</div>
</div>


</div>

</div>

  <?php include("inc/footer.php"); ?>
