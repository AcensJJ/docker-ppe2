<?php $titre = "Connexion"; ?>
<?php
session_start();
require_once("class/Client.php");
$connexion = new CLIENT();

if($connexion->isConnecte()!="")
{
    $connexion->Redirection('index.php');
}

if(isset($_POST['btn-connexion']))
{
    $upseudo = strip_tags($_POST['mail_ou_pseudo']);
    $umail = strip_tags($_POST['mail_ou_pseudo']);
    $upass = strip_tags($_POST['pass']);

    if($connexion->connexion($upseudo,$umail,$upass))
    {
        $connexion->Redirection('index.php');
    }
    else
    {
        $erreur = "Mauvais identifiants !";
    }
}
?>
<?php include("inc/header.php"); ?>
<!-- Chemin -->
<div class="breadcrumb-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <ul class="breadcrumb">
                    <li><a href="index.php"><i class="fa fa-home"></i></a></li>
                    <li><a href="#">Connexion</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!--Fin chemin-->

<div class="product-deails-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-3">
                <div class="product-details-tab">
                    <ul role="tablist" class="nav nav-tabs">
                        <li class="active" role="presentation">
                            <a data-toggle="tab" role="tab" aria-controls="description" href="#connexion" aria-expanded="true">Connexion</a>
                        </li>
                        <li role="presentation">
                            <a  href="inscription.php">Vous n'êtes pas inscrit ?</a>
                        </li>
                        <li role="presentation">
                            <a  href="oublie.php">Mot de passe oublié</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-9 col-md-9 col-sm-9">
              <?php if(isset($erreur)){
                echo '<div class="alert alert-danger">
                   <i class="glyphicon glyphicon-warning-sign"></i> &nbsp; '. $erreur .'
                </div>';
              }
              ?>
              <div class="connexion">
                    <div id="connexion">
                        <form action="connexion.php" method="post">
                            <h2>Connexion à votre compte</h2>
                            <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-4">
                            <div class="form-group required">
                                <div class="form-name">
                                    <label class="control-label">Adresse e-mail/pseudo</label>
                                    <input type="text" class="form-control" id="input-name" value="" name="mail_ou_pseudo">
                                </div>
                            </div>
                          </div>
                          <div class="col-lg-4 col-md-4 col-sm-4">
                            <div class="form-group required">
                                <div class="form-name">
                                    <label class="control-label">Mot de passe</label>
                                    <input type="password" class="form-control" id="input-name" value="" name="pass">
                                </div>
                            </div>
                          </div>
                          <div class="col-lg-2 col-md-2 col-sm-2">
                            <div class="buttons clearfix">
                                <button class="btn-connexion" name="btn-connexion" type="submit">Connexion</button>
                            </div>
                          </div>
                          </div>
                        </form>
                    </div>
                </div>
              </div>
            </div>
        </div>
    </div>
<?php include("inc/footer.php"); ?>
