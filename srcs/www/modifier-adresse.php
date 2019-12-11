<?php $titre = "Modifier une adresse"; ?>
<?php
ob_start();
session_start();
require_once ("class/Client.php");
require_once ("class/Adresse.php");
$client = new CLIENT();
$adresse = new ADRESSE();
if ($client->isConnecte() == "") {
    $client->Redirection('connexion.php');
}




if (isset($_POST["btn-editaddr"])) {
        $nom = utf8_decode(strip_tags($_POST['nom_addr']));
        $prenom = utf8_decode(strip_tags($_POST['prenom_addr']));
        $societe = utf8_decode(strip_tags($_POST['societe_addr']));
        $addr1 = utf8_decode(strip_tags($_POST['addr1_addr']));
        $addr2 = utf8_decode(strip_tags($_POST['addr2_addr']));
        $ville = utf8_decode(strip_tags($_POST['ville_addr']));
        $codepostal = strip_tags($_POST['cp_addr']);
        $pays = utf8_decode(strip_tags($_POST['pays_addr']));
        $type = strip_tags($_POST['type_addr']);
        $IDClient = strip_tags($_POST['id_client']);
        $id_adresse = strip_tags($_POST['id_adresse']);


        if($_POST['nom_addr']<>""){
          try  {  if($adresse->edit_adresse_nom($nom,$id_adresse,$IDClient)){ header('Location: modifier-adresse.php?id='. $id_adresse .'&succes=0'); }  } catch(PDOException $e) { echo $e->getMessage(); } }
        if($_POST['prenom_addr']<>""){
          try  {  if($adresse->edit_adresse_prenom($prenom,$id_adresse,$IDClient)){ header('Location: modifier-adresse.php?id='. $id_adresse .'&succes=0'); }  } catch(PDOException $e) { echo $e->getMessage(); } }
        if($_POST['societe_addr']<>""){
          try  {  if($adresse->edit_adresse_societe($societe,$id_adresse,$IDClient)){ header('Location: modifier-adresse.php?id='. $id_adresse .'&succes=0'); }  } catch(PDOException $e) { echo $e->getMessage(); } }
        if($_POST['addr1_addr']<>""){
          try  {  if($adresse->edit_adresse_addr1($addr1,$id_adresse,$IDClient)){ header('Location: modifier-adresse.php?id='. $id_adresse .'&succes=0'); }  } catch(PDOException $e) { echo $e->getMessage(); } }
        if($_POST['addr2_addr']<>""){
          try  {  if($adresse->edit_adresse_addr2($addr2,$id_adresse,$IDClient)){ header('Location: modifier-adresse.php?id='. $id_adresse .'&succes=0'); }  } catch(PDOException $e) { echo $e->getMessage(); } }
        if($_POST['ville_addr']<>""){
          try  {  if($adresse->edit_adresse_ville($ville,$id_adresse,$IDClient)){ header('Location: modifier-adresse.php?id='. $id_adresse .'&succes=0'); }  } catch(PDOException $e) { echo $e->getMessage(); } }
        if($_POST['cp_addr']<>""){
          try  {  if($adresse->edit_adresse_codepostal($codepostal,$id_adresse,$IDClient)){ header('Location: modifier-adresse.php?id='. $id_adresse .'&succes=0'); }  } catch(PDOException $e) { echo $e->getMessage(); } }
        if($_POST['pays_addr']<>""){
          try  {  if($adresse->edit_adresse_pays($pays,$id_adresse,$IDClient)){ header('Location: modifier-adresse.php?id='. $id_adresse .'&succes=0'); }  } catch(PDOException $e) { echo $e->getMessage(); } }
        if($_POST['type_addr']<>""){
          try  {  if($adresse->edit_adresse_type($type,$id_adresse,$IDClient)){ header('Location: modifier-adresse.php?id='. $id_adresse .'&succes=0'); }  } catch(PDOException $e) { echo $e->getMessage(); } }



      }

?>



<?php include("inc/header.php"); ?>
<?php  if($_GET["id"] == null){
    header('Location: index.php');

}else{
  $id_adresse = $_GET["id"];
  $adresses=$DB->query('SELECT * FROM adresse WHERE IDAdresse = '. $id_adresse .'');
  if(!$adresse == null){

  }else{
      header("Location: index.php");
  }
}?>
<!--Chemin -->
        <div class="breadcrumb-area">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <ul class="breadcrumb">
                            <li><a href="index.php"><i class="fa fa-home"></i></a></li>
                            <li><a href="compte.php">Mon Compte</a></li>
                            <li><a href="#">Modifier une adresse</a></li>
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
                              <i class="glyphicon glyphicon-log-in"></i> &nbsp; Adresse modifiée !
                         </div>
                         <?php
                    }
                    ?>
                        <form action="" method="post">
                            <fieldset>
                                <legend>Adresse</legend>
                                <div class="row">
                                    <?php foreach ( $adresses as $adresse ):?>
                                  <div class="form-group required">
                                      <label class="col-md-2 col-sm-3 control-label"> Type </label>
                                      <div class="col-md-10 col-sm-9">
                                          <select class="form-control" name="type_addr">
                                              <option value="Livraison">Livraison</option>
                                              <option value="Facturation">Facturation</option>
                                          </select>
                                      </div>
                                  </div>
                                  <div class="form-group required">
                                      <label class="col-md-2 col-sm-3 control-label">Nom</label>
                                      <div class="col-md-10 col-sm-9">
                                          <input type="text" class="form-control" placeholder="<?= $adresse->Nom ?>" value="" name="nom_addr">
                                      </div>
                                  </div>
                                  <div class="form-group required">
                                      <label class="col-md-2 col-sm-3 control-label">Prénom</label>
                                      <div class="col-md-10 col-sm-9">
                                          <input type="text" class="form-control" placeholder="<?= $adresse->Prenom ?>" value="" name="prenom_addr">
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-md-2 col-sm-3 control-label">Société</label>
                                      <div class="col-md-10 col-sm-9">
                                          <input type="text" class="form-control" placeholder="<?= $adresse->Societe ?>" value="" name="societe_addr">
                                      </div>
                                  </div>
                                  <div class="form-group required">
                                      <label class="col-md-2 col-sm-3 control-label">Adresse 1</label>
                                      <div class="col-md-10 col-sm-9">
                                          <input type="text" class="form-control" placeholder="<?= $adresse->Adresse1 ?>" value="" name="addr1_addr">
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-md-2 col-sm-3 control-label">Adresse 2</label>
                                      <div class="col-md-10 col-sm-9">
                                          <input type="text" class="form-control" placeholder="<?= $adresse->Adresse2 ?>"value="" name="addr2_addr">
                                      </div>
                                  </div>
                                  <div class="form-group required">
                                      <label class="col-md-2 col-sm-3 control-label">Ville</label>
                                      <div class="col-md-10 col-sm-9">
                                          <input type="text" class="form-control" placeholder="<?= $adresse->Ville ?>" value="" name="ville_addr">
                                      </div>
                                  </div>
                                  <div class="form-group required">
                                      <label class="col-md-2 col-sm-3 control-label">CP</label>
                                      <div class="col-md-10 col-sm-9">
                                          <input type="text" class="form-control" placeholder="<?= $adresse->CodePostal ?>" value="" name="cp_addr">
                                      </div>
                                  </div>
                                  <div class="form-group required">
                                      <label class="col-md-2 col-sm-3 control-label"> Pays </label>
                                      <div class="col-md-10 col-sm-9">
                                          <select class="form-control" name="pays_addr">
                                              <option value=""> --- Sélectionnez votre pays --- </option>
                                              <option value="Aaland Islands">Aaland Islands</option>
                                              <option value="Afghanistan">Afghanistan</option>
                                              <option value="Algeria">Algeria</option>
                                              <option value="American Samoa">American Samoa</option>
                                              <option value="Andorra">Andorra</option>
                                              <option value="Angola">Angola</option>
                                              <option value="Antigua and Barbuda">Antigua and Barbuda</option>
                                              <option value="Ascension Island (British)">Ascension Island (British)</option>
                                              <option value="Australia">Australia</option>
                                              <option value="Bangladesh">Bangladesh</option>
                                              <option value="Barbados">Barbados</option>
                                              <option value="Canada">Canada</option>
                                              <option value="Chad">Chad</option>
                                              <option value="Chile">Chile</option>
                                              <option value="China">China</option>
                                              <option value="Colombia">Colombia</option>
                                              <option value="Denmark">Denmark</option>
                                              <option value="Egypt">Egypt</option>
                                              <option value="Ethiopia">Ethiopia</option>
                                              <option value="France">France</option>
                                              <option value="Germany">Germany</option>
                                              <option value="Hong Kong">Hong Kong</option>
                                              <option value="Lesotho">Lesotho</option>
                                              <option value="Liberia">Liberia</option>
                                              <option value="Luxembourg">Luxembourg</option>
                                              <option value="Malawi">Malawi</option>
                                              <option value="Malaysia">Malaysia</option>
                                              <option value="Maldives">Maldives</option>
                                              <option value="Mongolia">Mongolia</option>
                                              <option value="Montenegro">Montenegro</option>
                                              <option value="Montserrat">Montserrat</option>
                                              <option value="Morocco">Morocco</option>
                                              <option value="Panama">Panama</option>
                                              <option value="Papua New Guinea">Papua New Guinea</option>
                                              <option value="Paraguay">Paraguay</option>
                                              <option value="Peru">Peru</option>
                                              <option value="Philippines">Philippines</option>
                                              <option value="Puerto Rico">Puerto Rico</option>
                                              <option value="Qatar">Qatar</option>
                                              <option value="Zambia">Zambia</option>
                                              <option value="Zimbabwe">Zimbabwe</option>
                                          </select>
                                      </div>
                                  </div>
                                    <div class="col-md-12">
                                        <div class="buttons">
                                            <input type="hidden" name="id_client" value="<?php echo $infoClient["IDClient"]; ?>">
                                            <input type="hidden" name="id_adresse" value="<?= $adresse->IDAdresse ?>">
                                            <button type="submit" class="btn btn-primary" name="btn-editaddr">Modifier l'adresse</button>
                                        </div>
                                    </div>
                                </div>
                              <?php endforeach ?>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
<?php include("inc/footer.php"); ?>
