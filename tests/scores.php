<?php
/**
 * Tests des fonctions de gestion des scores
 * 
 * @author    	Steve Fallet <steve.fallet@divtec.ch>
 * @copyright	2013 - EMT Porrentruy
 * @version		15.05.2013 * 
 */
 
//Inclusion des librairies
require_once(__DIR__.'/../includes/utils.php');


//Simule $_POST
$_POST['id'] = 4;
$_POST['nom'] = "Jean";
$_POST['score'] = "10000000";
$_POST['screenshot'] = "test.jpg";


echo "<h1>score_charger()</h1>";	
var_dump(score_charger($_POST['id']));

echo "<h1>score_controle()</h1>";	
var_dump(score_controle($_POST));

echo "<h1>score_ajouter()</h1>";	
var_dump($last_id = score_ajouter($_POST));

echo "<h1>score_valider()</h1>";	
var_dump(score_valider($_POST['id']));

echo "<h1>score_supprimer()</h1>";	
var_dump(score_supprimer($last_id));

echo "<h1>score_supprime_screenshot()</h1>";	
var_dump(score_supprime_screenshot(2));