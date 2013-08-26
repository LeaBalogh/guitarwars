<?php
//Inclusion des librairies
require_once(__DIR__.'/includes/utils.php');

// Si la page est appelée par le formulaire
if (isset($_POST['submit']))
{    		
	// Contrôle des données du formulaire
	if(!$erreurs = score_controle($_POST)) //Si pas d'erreur de saisie et screenshot valide
			//Insertion des données dans la BD
			if($id_score = score_ajouter($_POST)) // Si ajout ok
			{
				// Copie du screenshot		
				if(move_uploaded_file($_FILES['screenshot']['tmp_name'], UPLOAD_PHOTOS.$_FILES['screenshot']['name']))
				{
					//Suppression du fichier temporaire
					@unlink($_FILES['screenshot']['tmp_name']);	
					//Construction du message de confirmation
					$message = urlencode("Votre score a été ajouté !");	
					//Redirection vers la page d'accueil
					header("Location:".SITE_HTTP."index.php?message=$message");
					exit;
				}
				else //Si problème lors de la copie
				{
					//On supprime le score de la BD
					score_supprimer($id_score);
					//Message d'erreur
					$erreurs[] = "Erreur lors de la copie du screenshot";
				}
			}
	
	//Dans tous les cas on supprime le fichier temporaire
	@unlink($_FILES['screenshot']['tmp_name']);
    
    // Réinitialise les valeurs par défaut du formulaire
    // avec les valeurs précédemment saisies par l'utilisateru
    $form_nom = $_POST['nom'];
    $form_score = $_POST['score'];           
}

//Affiche le fomulaire
require_once ('score-formulaire.php');