<?php
/**
 * Fichier de configuration du site
 * 
 * @author    	Steve Fallet <steve.fallet@divtec.ch>
 * @copyright	2013 - EMT Porrentruy
 * @version		15.05.2013
 */
 
//Site
define('SITE_NOM',		'Guitar Wars'); 
define('SITE_HTTP', 	'http://'.$_SERVER['HTTP_HOST'].'/guitarwars/');
define('SITE_IMAGES', 	SITE_HTTP.'images/');

//Upload de fichiers
define('UPLOAD_PHOTOS', dirname(__FILE__).'\..\images\\');
define('UPLOAD_MAX_SIZE', 2097152); //2 M

//Basse de données
define('BD_SERVEUR',	'');
define('BD_UTILISATEUR','');
define('BD_MDP',		'');
define('BD_BASE',		'');
define('BD_CHARSET',	'utf8');

//Mode débug
// Note : Ce mode débug n'a du sens que si display_errors=off dans php.ini, ce qui devrait toujours être le cas pour des raisons de sécurité
define('DEBUG_MODE', true);

//Définition du fuseau horaire et des paramètre de langue
date_default_timezone_set('Europe/Zurich');
setlocale(LC_TIME, 'fr_FR', 'fra');

// Améliore la configuration PHP (php.ini) pour éviter les problèmes
ini_set('default_charset', 'utf-8'); 	//Définit quel jeux de caractères PHP enverra à l'en-tête HTTP. Content-type: header
ini_set('memory_limit','64M'); 			// Cette option détermine la mémoire limite, en octets, qu'un script est autorisé à allouer. Cela permet de prévenir l'utilisation de toute la mémoire par un script mal codé
ini_set('max_execution_time', 3600); 	// Fixe le temps maximal d'exécution d'un script, en secondes. Cela permet d'éviter que des scripts en boucles infinies saturent le serveur.

// Force Apache a utiliser le bon charset
header('Content-Type: text/html; charset=utf-8');


//Affecte le mode d'affichage d'erreur définit.
if(DEBUG_MODE)
{
	ini_set('display_errors', '1');		// Active ou désactive l'affichage des message d'erreurs 
	error_reporting(E_ALL);				// Reporte toutes les erreurs PHP
}
else
{
	ini_set('display_errors', '0'); 	// Désactive l'affichage des message d'erreurs 
	error_reporting(E_ALL ^ E_NOTICE);	// Rapporte toutes les erreurs à part les E_NOTICE
}