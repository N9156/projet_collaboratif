<?php

// Connexion à la BDD
$pdo = new PDO('mysql:host=localhost;dbname=boutique','root','', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));

// variable globale
$content = "";

// Ouverture d'une session
session_start();


//définition de constante
define("RACINE_SITE", $_SERVER['DOCUMENT_ROOT'] . '/boutique12/');
define("URL", "http://" .$_SERVER['HTTP_HOST'] . "/boutique12/");

echo "RACINE_SITE : " . RACINE_SITE ."<br>";
echo "URL : " . URL ."<br>";


require_once("fonction.php");
?>