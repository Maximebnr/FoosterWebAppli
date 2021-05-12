<?php

function BDDConnexionPDO()
{
	$hote = 'localhost'; // le chemin vers le serveur
	$port = '3306';
	$nomBd = 'drunk'; // le nom de votre base de données
	$utilisateur = 'root'; // nom d'utilisateur pour se connecter à la base de données
	$motPasse = ''; // mot de passe de l'utilisateur pour se connecter
	try {
		$connexion = new PDO('mysql:host=' . $hote . '; dbname=' . $nomBd, $utilisateur, $motPasse);
		$connexion->exec("SET CHARACTER SET utf8");
		$connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	} catch (Exception $e) {
		// Ici se trouve le code à effectuer en cas d’échec de connexion
		echo 'Erreur : ' . $e->getMessage() . '<br />';
		echo 'N° : ' . $e->getCode();
		die;
	}
	return $connexion;
}



   




function Salage($pass)
{
	$Salage = "pkespoj5seg6sset64dems64zq7ef7s9aefsrdg";
	$pass = $pass . $Salage;
	return (hash("sha256", $pass));
}

function SessionOuverte()
{
	// Vérifie si une session a été ouverte par l'utilisateur
	if (isset($_SESSION["login"]))
		return true;
	else
		return false;
}

function EtreAdministrateur()
{
	// Vérifie si c'est un admin qui est connecté
	if (SessionOuverte()) {
		if ($_SESSION["admin"] == "1")
			return true;
		else
			return false;
	} else
		return false;
}



















