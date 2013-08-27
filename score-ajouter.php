<?php
//Inclusion des librairies
require_once(__DIR__.'/includes/utils.php');

// Page appelée par le formulaire ?
if (isset($_POST['submit']))
{    		
	// Contrôle des données du formulaire
	if(!$erreurs = score_controle($_POST))
	{
			//Ajout du score dans la BD
			if($id_score = score_ajouter($_POST)) // Si ajout ok
			{			        
		        //Construction du message de confirmation
				$message = urlencode("Votre score a été ajouté !");	
				//Redirection vers la page d'accueil
				header("Location:".SITE_HTTP."index.php?message=$message");
				exit; //Fin
			}         
           
           //Sinon il y a eu un problème lors de l'ajout ou de la copie 
           $erreurs[] = "Ajout impossible pour l'instant, merci de réessayer ultérieurement !";           
    }        
    //Récuéprer les données saisies et les mettre
    //comme valeur par défaut du formulaire
    $form_nom = $_POST['nom'];
    $form_score = $_POST['score'];           
}
//Affiche le fomulaire
require_once ('score-formulaire.php');