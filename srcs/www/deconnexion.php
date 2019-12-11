<?php
	require_once('inc/session.php');
	require_once('class/Client.php');
	$deconnexion = new CLIENT();

	if($deconnexion->isConnecte()!="")
	{
		$deconnexion->Redirection('index.php');
	}
		$deconnexion->Deconnexion();
