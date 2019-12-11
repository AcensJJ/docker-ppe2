<?php
	require_once  $_SERVER['DOCUMENT_ROOT']."/inc/session.php";
	require_once  $_SERVER['DOCUMENT_ROOT']."/class/Client.php";
	require_once  $_SERVER['DOCUMENT_ROOT']."/class/Panier.php";
  $DB = new DB();
	$panier = new panier($DB);
	$utilisateurConnecte = new CLIENT();

if(isset($_SESSION['session_client'])){
		$user_id = $_SESSION['session_client'];
}else{
	$user_id = '';
}
	$sql = "SELECT * FROM clients WHERE IDClient=:user_id";
	$stmt = $utilisateurConnecte->runQuery($sql);
	$stmt->execute(array(":user_id"=>$user_id));
	$infoClient=$stmt->fetch(PDO::FETCH_ASSOC);
	$_SESSION["grade"] = $infoClient["Grade"];
?>
<!doctype html>
<html class="no-js" lang="">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Les Délices de Rachida - <?php echo $titre; ?></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

		<!-- favicon
		============================================ -->
        <link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">

		<!-- Polices Google
		============================================ -->
       <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,700,600' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Roboto+Condensed:400,300,700' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Old+Standard+TT:400,400italic,700' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Roboto:400,900,700,500,300' rel='stylesheet' type='text/css'>

		<!-- CSS Bootstrap
		============================================ -->
        <link rel="stylesheet" href="css/bootstrap.min.css">

		<!-- CSS Fontawesome
		============================================ -->
        <link rel="stylesheet" href="css/font-awesome.min.css">

		<!-- CSS owl.carousel
		============================================ -->
        <link rel="stylesheet" href="css/owl.carousel.css">
        <link rel="stylesheet" href="css/owl.theme.css">
        <link rel="stylesheet" href="css/owl.transitions.css">

		<!-- CSS jquery-ui
		============================================ -->
        <link rel="stylesheet" href="css/jquery-ui.css">

		<!-- CSS meanmenu
		============================================ -->
        <link rel="stylesheet" href="css/meanmenu.min.css">

		<!-- CSS animate
		============================================ -->
        <link rel="stylesheet" href="css/animate.css">

        <!-- CSS nivo slider
		============================================ -->
		<link rel="stylesheet" href="lib/nivo-slider/css/nivo-slider.css" type="text/css" />
		<link rel="stylesheet" href="lib/nivo-slider/css/preview.css" type="text/css" media="screen" />

		<!-- CSS normalize
		============================================ -->
        <link rel="stylesheet" href="css/normalize.css">

		<!-- CSS main
		============================================ -->
        <link rel="stylesheet" href="css/main.css">

		<!-- CSS style
		============================================ -->
        <link rel="stylesheet" href="style.css">

		<!-- CSS responsive
		============================================ -->
        <link rel="stylesheet" href="css/responsive.css">

		<!-- JS modernizr
		============================================ -->
        <script src="js/vendor/modernizr-2.8.3.min.js"></script>
    </head>
    <body>
        <!--[if lt IE 8]>
            <p class="browserupgrade">Vous utilisez un navigateur <strong>obsolète</strong>. Merci <a href="http://browsehappy.com/">de mettre à jour votre navigateur</a> pour améliorer votre expérience.</p>
        <![endif]-->

        <!--Header-->
        <header>
            <!--Header (Haut)-->
            <div class="header-top">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-7 col-md-7 col-sm-6 col-xs-12">
                            <div class="header-top-info">
                                <div class="header-email">
                                    <p><i class="fa fa-envelope">&nbsp;</i>Email: <span>contact@les-delices-de-rachida.com</span></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5 col-md-5 col-sm-6 col-xs-12">
                            <div class="header-top-menu">
                                <ul class="header-links">
                                  <?php
                                      if($session->isConnecte()): ?>

                                        <li class="dropdown"><a data-toggle="dropdown" class="dropdown-toggle" title="Mon compte" href="compte.php"><span>Mon compte</span><i class="fa fa-angle-down"></i></a>
                                            <ul class="dropdown-menu dropdown-menu-right">
                                                <li><a title="Liste de souhaits (0)" id="wishlist-total" href="souhaits.php"><span>Liste de souhaits (0)</span></a></li>
																								<li><a title="Mon compte" class="item-cart" href="compte.php"><span>Mon compte</span></a></li>

																		<?php if($session->isAdministrateur()): ?>
																			<li><a title="Administration" class="item-cart" href="admin"><span>Administration</span></a></li>
																	<?php endif ?>
																		<li class="last"><a title="Déconnexion" href="deconnexion.php"><span>Déconnexion</span></a></li>
																	<?php else: ?>
                                        <li class="dropdown"><a data-toggle="dropdown" class="dropdown-toggle" title="Mon compte" href="compte.php"><span>Mon compte</span><i class="fa fa-angle-down"></i></a>
                                            <ul class="dropdown-menu dropdown-menu-right">
                                                <li><a href="inscription.php">Inscription</a></li>
                                                <li><a href="connexion.php">Connexion</a></li>
                                  <?php endif ?>

																</ul>
														</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Fin du header (haut) -->
            <div class="header">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-12">
                            <div id="logo">
                                <a href="index.php"><img class="img-responsive" alt="Les Délices de Rachida" src="img/logo/logo.png"></a>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div id="search-category" class="input-group">
                                <form class="search-box" action="produits.php" method="post">
                                    <div class="search-categories">
                                        <div class="search-cat">
                                            <select class="category-items" name="categorie">
                                                <?php $categories = $DB->query('SELECT * FROM categorie'); ?>
                                              <?php foreach ( $categories as $categorie ):?>
                                                  <option value="<?= $categorie->IDCategorie ?>"><?= $categorie->Libelle; ?></option>
                                              <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <input type="search" class="form-control" placeholder="Rechercher..." id="text-search" name="recherche">
                                    <button id="btn-search-category" type="submit">
                                        <i class="icon-search"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
									<div id="panier" class="col-lg-3 col-md-3 col-sm-6">
									<?php include('inc/panier.php'); ?>

                    </div>
                </div>
								</div>
                <!-- Menu principal -->
                <div class="mainmenu-area">
                    <div id="sticker">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 hidden-sm">
                                    <div class="mainmenu">
                                        <nav>
                                            <ul id="nav">
                                                <li class="current"><a href="index.php"><i class="fa fa-home"></i></a>
                                                </li>
                                                <li><a href="">NOS DELICES</a>
                                                          <!--sort tout les produits de la bdd !-->

                                                  <div class="megamenu">


                                                      <div class="megamenu-list clearfix">
                                                        <?php $categories = $DB->query('SELECT * FROM categorie'); ?>
                                                           <!--appelle chaque produit individuellement !-->
                                                              <?php foreach ( $categories as $categorie ):?>
                                                          <span>
                                                              <a href="produits.php?cat=<?= $categorie->IDCategorie; ?>" class="mega-title"><?= $categorie->Libelle; ?></a>
                                                              <?php $produits_categorie = $DB->query('SELECT * FROM produit WHERE IDCategorie = '.$categorie->IDCategorie.' LIMIT 5'); ?>
                                                              <?php foreach ( $produits_categorie as $produit_categorie ):?>
                                                              <a href="produit.php?id=<?= $produit_categorie->IDProduit; ?>"><?= $produit_categorie->LibelleProduit; ?></a>

                                                              <?php endforeach; ?>
                                                             </span>

                                             <!-- fin de l'appel individuel  !-->
                                  <?php endforeach; ?>
                                </div>
                            </div>
                        </li>
                                                          <li><a href="contact.php">Contactez-nous</a></li>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </nav>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--Fin du menu principal-->
            </div>
            <!-- Menu mobile -->
            <div class="mobile-menu-area">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="mobile-menu">
                                <nav id="dropdown">
                                    <ul>
                                        <li><a href="index.php">ACCUEIL</a>
                                        </li>
                                        <li><a href="#">NOS PRODUITS</a>
                                            <ul>
																							<?php $categories = $DB->query('SELECT * FROM categorie'); ?>
																						<?php foreach ( $categories as $categorie ):?>
																								<li><a href="produits.php?cat=<?= $categorie->IDCategorie; ?>"><?= $categorie->Libelle; ?></a></li>
																						<?php endforeach; ?>
                                            </ul>
                                        </li>
																				<li><a href="#">MON COMPTE</a>
																					<ul>
																				<?php  if($session->isConnecte()): ?>
																					<li><a href="souhaits.php">Liste de souhaits (0)</a></li>
																									<li><a href="compte.php">Mon compte</a></li>
																								<?php	if($session->isAdministrateur()): ?>
																									<li><a href="admin">Administration</a></li>
																								<?php endif ?>
																					<li><a href="deconnexion.php">Déconnexion</a></li>
																			<?php else: ?>
																				<li><a href="connexion.php">Connexion</a></li>
																				<li><a href="inscription.php">Inscription</a></li>
																			<?php endif ?>
                                            </ul>
                                        </li>
                                        <li><a href="contact.php">CONTACT</a></li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Fin du menu mobile -->
            </header>
            <!-- Fin du header -->
