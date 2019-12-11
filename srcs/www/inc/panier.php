

<!-- Polices Google
============================================ -->
<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,700,600' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Roboto+Condensed:400,300,700' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Old+Standard+TT:400,400italic,700' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Roboto:400,900,700,500,300' rel='stylesheet' type='text/css'>

<!-- CSS Bootstrap
============================================ -->
<link rel="stylesheet" href="../css/bootstrap.min.css">

<!-- CSS Fontawesome
============================================ -->
<link rel="stylesheet" href="../css/font-awesome.min.css">

<!-- CSS owl.carousel
============================================ -->
<link rel="stylesheet" href="../css/owl.carousel.css">
<link rel="stylesheet" href="../css/owl.theme.css">
<link rel="stylesheet" href="../css/owl.transitions.css">

<!-- CSS jquery-ui
============================================ -->
<link rel="stylesheet" href="../css/jquery-ui.css">

<!-- CSS meanmenu
============================================ -->
<link rel="stylesheet" href="../css/meanmenu.min.css">

<!-- CSS animate
============================================ -->
<link rel="stylesheet" href="../css/animate.css">

<!-- CSS nivo slider
============================================ -->
<link rel="stylesheet" href="../lib/nivo-slider/css/nivo-slider.css" type="text/css" />
<link rel="stylesheet" href="../lib/nivo-slider/css/preview.css" type="text/css" media="screen" />

<!-- CSS normalize
============================================ -->
<link rel="stylesheet" href="../css/normalize.css">

<!-- CSS main
============================================ -->
<link rel="stylesheet" href="../css/main.css">

<!-- CSS style
============================================ -->
<link rel="stylesheet" href="../style.css">

<!-- CSS responsive
============================================ -->
<link rel="stylesheet" href="../css/responsive.css">

<!-- JS modernizr
============================================ -->
<script src="../js/vendor/modernizr-2.8.3.min.js"></script>
<?php
require_once  $_SERVER['DOCUMENT_ROOT']."/inc/session.php";
require_once  $_SERVER['DOCUMENT_ROOT']."/class/Client.php";
require_once  $_SERVER['DOCUMENT_ROOT']."/class/Panier.php";
$DB = new DB();
$panier = new panier($DB);
$utilisateurConnecte = new CLIENT();
?>

<ul class="header-r-cart">
<li><a class="cart" href="panier.php"><span id="count"><?= $panier->count(); ?></span> produit(s) - <span id="total"><?= number_format($panier->total(),2,',',' '); ?></span>€</a>
<div class="mini-cart-content">
<div class="cart-products-list">
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
<div class="cart-products">
<div class="cart-image">
    <?php foreach($images_produits as $image_produit): ?>
    <a href="../produit.php?id=<?= $produit->IDProduit; ?>"><img src="./images_produits/<?= $image_produit->NomImage; ?>" alt=""></a>
  <?php endforeach; ?>
</div>
<div class="cart-product-info">
    <a href="produit.php?id=<?= $produit->IDProduit; ?>" class="product-name"><?= $_SESSION['panier'][$produit->IDProduit]; ?> x <?= $produit->LibelleProduit ?></a>
    <span class="p-price"><?php echo $_SESSION['panier'][$produit->IDProduit] * $produit->PrixUnitaireHT; ?> €</span>
    <?php if($_SERVER['REQUEST_URI'] == "/inc/panier.php"): ?>
    <a class="remove-product" href="../panier.php?delPanier=<?= $produit->IDProduit; ?>"><i class="fa fa-times-circle"></i></a>
  <?php else: ?>
    <a class="remove-product" href="<?php echo strtok($_SERVER['REQUEST_URI'],'?'); ?>?delPanier=<?= $produit->IDProduit; ?>"><i class="fa fa-times-circle"></i></a>
  <?php endif ?>
</div>

</div>
<?php endforeach; ?>
</div>
<div class="cart-price-list">
<p class="price-amount">Total HTC : <span id="total2"><?= number_format($panier->total(),2,',',' '); ?></span>€ </p>
<div class="cart-buttons">
<a href="panier.php"><i class="fa fa-shopping-cart"></i> Panier</a>
<a href="paiement.php"><i class="fa fa-sign-in"></i> Paiement</a>
</div>
</div>
</div>
</li>
</ul>
