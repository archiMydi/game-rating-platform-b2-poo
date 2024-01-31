<?php

// TODO Déclaration des paramètres de connexion
	$host = ""; 
	$user = "";
	$bdd = "";
	$passwd  = "";
// Connexion au serveur
	$connexion=mysqli_connect($host, $user,$passwd) or die("erreur de connexion au serveur");
	mysqli_select_db($connexion,$bdd) or die("erreur de connexion a la base de donnees");

?>