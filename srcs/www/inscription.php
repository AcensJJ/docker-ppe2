<?php
session_start();
require_once('class/Client.php');
$client = new CLIENT();

if($client->isConnecte()!="")
{
	$client->Redirection('index.php');
}

if(isset($_POST['btn-inscription']))
{
	$upseudo = utf8_decode(strip_tags($_POST['pseudo']));
	$umail = strip_tags($_POST['mail']);
	$upass = strip_tags($_POST['pass']);
	$ucivilite = strip_tags($_POST['civilite']);
	$uprenom = utf8_decode(strip_tags($_POST['prenom']));
	$unom = utf8_decode(strip_tags($_POST['nom']));
	$utelephone = strip_tags($_POST['telephone']);
	date_default_timezone_set('Europe/Paris');
	$datecreation = date_create('now')->format('Y-m-d H:i:s');

	if($upseudo=="")	{
		$erreur[] = "Merci de renseigner un pseudo !";
	}
	else if($umail=="")	{
		$erreur[] = "Merci de renseigner une adresse e-mail!";
	}
	else if(!filter_var($umail, FILTER_VALIDATE_EMAIL))	{
	    $erreur[] = 'Merci d\'entrer une adresse e-mail valide !';
	}
	else if($upass=="")	{
		$erreur[] = "Merci de renseigner un mot de passe !";
	}
	else if(strlen($upass) < 6){
		$erreur[] = "Le mot de passe doit faire plus de 6 caractères !";
	}
	else if($ucivilite=="")	{
		$erreur[] = "Merci de renseigner votre civilité !";
	}
	else if($uprenom=="")	{
		$erreur[] = "Merci de renseigner votre prénom !";
	}
	else if($unom=="")	{
		$erreur[] = "Merci de renseigner votre nom !";
	}
	else if($utelephone=="")	{
		$erreur[] = "Merci de renseigner votre numéro de téléphone !";
	}
	else
	{
		try
		{
			$stmt = $client->runQuery("SELECT Pseudo, Email FROM clients WHERE Pseudo=:upseudo OR Email=:umail");
			$stmt->execute(array(':upseudo'=>$upseudo, ':umail'=>$umail));
			$row=$stmt->fetch(PDO::FETCH_ASSOC);

			if($row['Pseudo']==$upseudo) {
				$erreur[] = "pseudo déjà utilisé !";
			}
			else if($row['Email']==$umail) {
				$erreur[] = "adresse e-mail déjà utilisée !";
			}
			else
			{
				if($client->inscription($upseudo,$umail,$upass,$ucivilite,$uprenom,$unom,$utelephone,$datecreation)){
					header('Location: inscription.php?succes');
				}
			}
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}
}

?>
<?php $titre = "Inscription"; ?>
<?php include("inc/header.php"); ?>
<!-- Chemin -->
<div class="breadcrumb-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <ul class="breadcrumb">
                    <li><a href="index.php"><i class="fa fa-home"></i></a></li>
                    <li><a href="#">Inscription</a></li>
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
                            <a data-toggle="tab" role="tab" aria-controls="description" href="#connexion" aria-expanded="true">Inscription</a>
                        </li>
                        <li role="presentation">
                            <a  href="connexion.php">Déjà inscrit ?</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-9 col-md-9 col-sm-9">
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
						}
						else if(isset($_GET['succes']))
						{
						?>
								 <div class="alert alert-success">
											<i class="glyphicon glyphicon-log-in"></i> &nbsp; Inscription réussie ! <a href='connexion.php'>Connectez vous</a> ici
								 </div>
								 <?php
						}
						?>
              <div class="connexion">
                    <div id="connexion">
                        <form action="inscription.php" method="post">
                            <h2>Inscription</h2>
                            <div class="row">
                              <div class="col-md-1"></div>
                            <div class="col-lg-3 col-md-3 col-sm-3">
                            <div class="form-group required">
                                <div class="form-name">
                                    <label class="control-label">Nom</label>
                                    <input type="text" class="form-control" id="input-name" value="" name="nom">
                                </div>
                            </div>
                          </div>
                          <div class="col-lg-3 col-md-3 col-sm-3">
                            <div class="form-group required">
                                <div class="form-name">
                                    <label class="control-label">Prénom</label>
                                    <input type="text" class="form-control" id="input-name" value="" name="prenom">
                                </div>
                            </div>
                          </div>
                          <div class="col-lg-4 col-md-4 col-sm-4">
                            <div class="form-group required">
                                <div class="form-name">
                                    <label class="control-label">Civilité</label>
                                    <select class="form-control" name="civilite" placeholder="Choisissez votre civilité">
													<option name="civilite">Femme</option>
													<option name="civilite">Homme</option>
												</select>
                                </div>
                            </div>
                          </div>
                          <div class="col-md-1"></div>
                          </div>
                          <div class="row">
                            <div class="col-md-1"></div>
                          <div class="col-lg-4 col-md-4 col-sm-4">
                          <div class="form-group required">
                              <div class="form-name">
                                  <label class="control-label">Pseudo</label>
                                  <input type="text" class="form-control" id="input-name" value="" name="pseudo">
                              </div>
                          </div>
                        </div>
                        <div class="col-lg-5 col-md-5 col-sm-5">
                          <div class="form-group required">
                              <div class="form-name">
                                  <label class="control-label">Mot de passe</label>
                                  <input type="password" class="form-control" id="input-name" value="" name="pass">
                              </div>
                          </div>
                        </div>
                        <div class="col-md-1"></div>
                        </div>
                        <div class="row">
                          <div class="col-md-1"></div>
                        <div class="col-lg-5 col-md-5 col-sm-5">
                        <div class="form-group required">
                            <div class="form-name">
                                <label class="control-label">Adresse e-mail</label>
                                <input type="text" class="form-control" id="input-name" value="" name="mail">
                            </div>
                        </div>
                      </div>
                      <div class="col-lg-4 col-md-4 col-sm-4">
                        <div class="form-group required">
                            <div class="form-name">
                                <label class="control-label">Téléphone</label>
                                <input type="text" class="form-control" id="input-name" value="" name="telephone">
                            </div>
                        </div>
                      </div>
                      <div class="col-md-1"></div>
                      </div>
                      <div class="row">
                          <div class="col-md-4"></div>
                        <div class="col-lg-3 col-md-3 col-sm-3">
                          <div class="buttons clearfix">
                              <button class="btn-connexion" name="btn-inscription" type="submit">Créer un compte</button>
                          </div>
                        </div>
                        <div class="col-md-4"></div>
                      </div>
                        </form>
                    </div>
                </div>
              </div>
            </div>
        </div>
    </div>
<?php include("inc/footer.php"); ?>
