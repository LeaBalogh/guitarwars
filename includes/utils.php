<?php
/*
 * Ce fichier gère l'inclusion des différents fichiers de configuration 
 * et autres librairies 
 */
require_once(__DIR__.'/config.php'); //Constantes
require_once(__DIR__.'/bd.php'); //Fonctions base de données    
require_once(__DIR__.'/scores.php'); //Gestion de la table score 
require_once(__DIR__.'/pays.php'); //Gestion de la table pays 
?>