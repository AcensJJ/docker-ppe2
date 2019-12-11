<?php
require $_SERVER['DOCUMENT_ROOT']."/inc/head_addpanier.php";
$json = array('error' => true);
if(isset($_GET['id'])){
	$product = $DB->query('SELECT IDProduit FROM produit WHERE IDProduit=:id', array('id' => $_GET['id']));
	if(empty($product)){
		$json['message'] = "Ce produit n'existe pas";
	}else{
		$panier->add($product[0]->IDProduit);
		$json['error']  = false;
		$json['total']  = number_format($panier->total(),2,',',' ');
		$json['count']  = $panier->count();
		$json['message'] = 'Le produit a bien été ajouté à votre panier';
	}
}else{
	$json['message'] = "Vous n'avez pas sélectionné de produit à ajouter au panier";
}
echo json_encode($json);
