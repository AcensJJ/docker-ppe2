<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/class/Produit.php';
$DB = new DB();
$produit = new PRODUIT();
$liste_categories = $DB->query("SELECT * FROM categorie");
if(isset($_POST["recherche"]) && is_string($_POST["recherche"])){
  $recherche = addslashes(htmlspecialchars($_POST["recherche"]));
  $id_categorie = $_POST["categorie"];
  $titre = 'Recherche: '. $recherche;
  $informations_categories = $DB->query("SELECT * FROM categorie WHERE IDCategorie = '$id_categorie'");
  $produit_recherche =  $DB->query("SELECT * FROM produit WHERE IDCategorie = '$id_categorie' AND LibelleProduit LIKE '%$recherche%' ORDER BY IDProduit DESC");
  $resultats = 0;
  foreach ( $produit_recherche as $produit ){
    $resultats++;
  }}elseif(isset($_GET["cat"])){
    $categorie_affichee = addslashes(htmlspecialchars($_GET["cat"]));
    $informations_categories = $DB->query("SELECT * FROM categorie WHERE IDCategorie = '$categorie_affichee'");
    foreach ( $informations_categories as $categorie ):
    $titre = 'Catégorie: '. $categorie->Libelle;
    $nom_categorie = $categorie->Libelle;
    $id_categorie = $categorie->IDCategorie;
    endforeach;
    if(is_null($id_categorie)){
      header("Location: produits.php");
    }
    $produit_recherche =  $DB->query("SELECT * FROM produit WHERE IDCategorie = '$categorie_affichee' ORDER BY IDProduit DESC");

}else{
  $titre = "Nos produits";
}

?>
<?php include("inc/header.php"); ?>
        <div class="breadcrumb-area">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <ul class="breadcrumb">
                            <li><a href="index.php"><i class="fa fa-home"></i></a></li>
                            <?php if(isset($_POST["recherche"])){
                              foreach ( $informations_categories as $categorie ):
                              echo  '<li><a href="produits.php?cat='. $categorie->IDCategorie. '">'. $categorie->Libelle. '</a></li>';
                              endforeach;
                              echo '<li><a href="#">'. $recherche .'</a></li>';
                            }else if(isset($_GET["cat"])){
                              echo  '<li><a href="produits.php?cat='. $id_categorie. '">'. $nom_categorie. '</a></li>';
                            }else
                            {
                              echo '<li><a href="#">Nos produits</a></li>';
                            } ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="sidebar-content-area">


            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <aside class="sidebar-column">
                            <div class="sidebar-heading">Catégories</div>
                            <div class="sidebar-widgets-container">
                                <div class="sidebar-single-widget">

                                    <ul class="widget-list">
                                      <?php foreach ( $liste_categories as $une_categorie ):?>
                                        <li><a href="produits.php?cat=<?= $une_categorie->IDCategorie; ?>"><?= $une_categorie->Libelle; ?></a></li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>

                            </div>
                        </aside>
                    </div>
                    <div class="col-md-9">
                        <h2 class="categories-title"><?php if(isset($_POST["recherche"])){
                          echo 'Résultats de la recherche pour: "' . $recherche . '"';

                        }else if(isset($_GET["cat"])){
                          echo $nom_categorie;
                        }else{

                          echo 'Nos produits';
                        } ?></h2>
                        <div class="clearfix"></div>
                        <div class="tab-content">
                            <div id="grid" class="tab-pane active" role="tabpanel">
                                <div class="row">
                                  <?php if(isset($_POST["recherche"])): ?>
                                    <?php foreach ( $produit_recherche as $produit ):?>
                                        <div class="col-lg-4 col-md-4 col-sm-6">
                                            <div class="single-product">
                                                <div class="product-image">
                                                    <a href="produit.php?id=<?= $produit->IDProduit; ?>">
                                                      <?php $images_produits = $DB->query('SELECT * FROM images  WHERE IDProduit = "'. $produit->IDProduit .'" ORDER BY OrdreAffichage ASC LIMIT 1'); ?>
                                                        <?php foreach ( $images_produits as $image_produit ):?>
                                                        <img src="images_produits/<?= $image_produit->NomImage; ?>">
                                                        <?php endforeach; ?>
                                                    </a>
                                                    <div class="rating"><img alt="" src="img/icon/star.png"></div>
                                                </div>
                                                <div class="product-text">
                                                    <div class="p-name"><a href="produit.php?id=<?= $produit->IDProduit; ?>"><?php echo $produit->LibelleProduit; ?> </a></div>
                                                    <div class="p-price">
                                                        <span class="price-new"><?= number_format($produit->PrixUnitaireHT,2,',',' '); ?> €</span>
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
                                    <?php endforeach; ?>
                                  <?php elseif(isset($_GET["cat"])): ?>
                                    <?php foreach ( $produit_recherche as $produit ):?>
                                        <div class="col-lg-4 col-md-4 col-sm-6">
                                            <div class="single-product">
                                                <div class="product-image">
                                                    <a href="produit.php?id=<?= $produit->IDProduit; ?>">
                                                      <?php $images_produits = $DB->query('SELECT * FROM images  WHERE IDProduit = "'. $produit->IDProduit .'" ORDER BY OrdreAffichage ASC LIMIT 1'); ?>
                                                        <?php foreach ( $images_produits as $image_produit ):?>
                                                        <img src="images_produits/<?= $image_produit->NomImage; ?>">
                                                        <?php endforeach; ?>
                                                    </a>
                                                    <div class="rating"><img alt="" src="img/icon/star.png"></div>
                                                </div>
                                                <div class="product-text">
                                                    <div class="p-name"><a href="produit.php?id=<?= $produit->IDProduit; ?>"><?php echo $produit->LibelleProduit; ?> </a></div>
                                                    <div class="p-price">
                                                        <span class="price-new"><?= number_format($produit->PrixUnitaireHT,2,',',' '); ?> €</span>
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
                                    <?php endforeach; ?>
                                  <?php else: ?>
                                  <?php endif; ?>

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="pagination-content">
                                    <p><?php if(isset($_POST["recherche"])){
                                      echo $resultats;
                                      echo ' produit(s) trouvé(s).';
                                    } ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
 <?php include("inc/footer.php"); ?>
