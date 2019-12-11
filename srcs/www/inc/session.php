<?php

if(!isset($_SESSION))
    {
        ob_start();
        session_start();
    }


	require_once $_SERVER['DOCUMENT_ROOT']."/class/Client.php";
	$session = new CLIENT();
