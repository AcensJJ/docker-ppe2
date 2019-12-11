<?php $titre = "Contact"; ?>
<?php
session_start();
ob_start();
require_once("class/Client.php");
require_once("class/Contact.php");
$contact = new CONTACT();
?>
<?php include("inc/header.php"); ?>
<?php
if(isset($_POST['addmessage']))
{
  if($utilisateurConnecte->isConnecte()!=""){
    $idclient = utf8_decode(strip_tags($_POST['id_client']));
  }
  $nomdemandeur = utf8_decode(strip_tags($_POST['nom']));
  $mesdemandeur = strip_tags($_POST['message']);
  $emaildemandeur = utf8_decode(strip_tags($_POST['email']));

  if($nomdemandeur=="")	{
    $erreur[] = "Merci de renseigner votre nom !";
  }
  else if($emaildemandeur=="")	{
    $erreur[] = "Merci de renseigner votre adresse e-mail !";
  }
  else if($mesdemandeur=="")	{
    $erreur[] = "Merci de renseigner votre message !";
  }
  else if(!filter_var($emaildemandeur, FILTER_VALIDATE_EMAIL))	{
    $erreur[] = "Merci de renseigner une adresse e-mail correcte !";
  }
  else
  {
    try
    {
      if($contact->ajouter_message($idclient,$nomdemandeur,$mesdemandeur,$emaildemandeur)){
        header('Location: contact.php?succes');
      }
    }
    catch(PDOException $e)
    {
      echo $e->getMessage();
    }
  }
}
?>
<!--Chemin -->
        <div class="breadcrumb-area">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <ul class="breadcrumb">
                            <li><a href="index.php"><i class="fa fa-home"></i></a></li>
                            <li><a href="#">Contact</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- Fin du chemin -->
        <div class="contact-area">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                      <?php
                    if(isset($erreur)){
                    foreach($erreur as $erreur){
                    ?>
                             <div class="alert alert-danger">
                                <i class="glyphicon glyphicon-warning-sign"></i> &nbsp; <?php echo $erreur; ?>
                             </div>
                             <?php } } else if(isset($_GET['succes'])) { ?>
                         <div class="alert alert-success">
                              <i class="glyphicon glyphicon-log-in"></i> &nbsp; Votre message a bien été envoyé, nous vous répondrons très prochainement !
                         </div>
                       <?php } ?>
                        <form action="#" method="post" class="contact-form">
                            <fieldset>
                                <legend>Nous contacter</legend>
                                <div class="row">
                                    <div class="form-group required">
                                        <label class="col-sm-2 control-label">Votre nom</label>
                                        <div class="col-sm-10">
                                            <?php if($utilisateurConnecte->isConnecte()!=""): ?>
                                            <input name="nom" type="text" class="form-control" id="nom" placeholder="<?php echo $infoClient["Nom"]; ?>" value="<?php echo $infoClient["Nom"]; ?>" readonly>
                                          <?php else: ?>
                                            <input name="nom" type="text" class="form-control" id="nom" placeholder="Saisissez votre nom...">
                                          <?php endif ?>
                                        </div>
                                    </div>
                                    <div class="form-group required">
                                        <label class="col-sm-2 control-label">Votre adresse e-mail</label>
                                        <div class="col-sm-10">
                                          <?php if($utilisateurConnecte->isConnecte()!=""): ?>
                                            <input name="email" type="text" class="form-control" id="email" value="<?php echo $infoClient["Email"]; ?>" placeholder="<?php echo $infoClient["Email"]; ?>" readonly>
                                              <?php else: ?>
                                                <input name="email" type="text" class="form-control" id="email" placeholder="Saisissez votre e-mail...">
                                              <?php endif ?>

                                        </div>
                                    </div>
                                    <div class="form-group required">
                                        <label class="col-sm-2 control-label">Message</label>
                                        <div class="col-sm-10">
                                            <textarea name="message" class="form-control" id="message" rows="3" maxlength="499" placeholder="Saisissez votre message..."></textarea>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                            <div class="buttons">
                                <div class="pull-right">
                                    <?php if($utilisateurConnecte->isConnecte()!=""): ?>
                                    <input type="hidden" name="id_client" value="<?php echo $infoClient["IDClient"]; ?>">
                                  <?php endif ?>
                                    <input type="submit" name="addmessage" value="Envoyer" class="btn btn-primary">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
<?php include("inc/footer.php"); ?>
