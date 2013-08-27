<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="UTF-8">
		<title>Ajouter un score | Guitar Wars</title>
		<link rel="stylesheet" type="text/css" href="style.css" />
	</head>
	<body>
		<h1>Guitar Wars - Ajoute ton meilleur score !</h1>
        <p><a href="<?php echo SITE_HTTP; ?>index.php">&lt;&lt; Retourner aux meilleurs scores</a></p>
		
		<?php 
		//Afficher message d'erreur
		if(isset($erreurs) and count($erreurs)>0)
		{
			$liste_erreurs = "<ul>";
			
			foreach($erreurs as $erreur)
				$liste_erreurs .= "<li>$erreur</li>";
				
			echo $liste_erreurs."</ul>";
		}
        ?>
		
		<form enctype="multipart/form-data" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
			<input type="hidden" name="MAX_FILE_SIZE" value="<?php echo UPLOAD_MAX_SIZE; ?>" />
			
			<label for="nom">Votre nom :</label>
			<input type="text" id="nom" name="nom"	value="<?php if (isset($form_nom))echo $form_nom; ?>" />
			<br />
			
			<label for="score">Ton meilleur score:</label>
			<input type="text" id="score" name="score" value="<?php if (isset($form_score)) echo $form_score; ?>" />
			<br />
			
			<label for="screenshot">Screen shot:</label>    		
    		<input type="file" id="screenshot" name="screenshot" />
    		<br/>
    		
    		<p>Note : Le screenshot doit être au format jpeg, png ou gif et ne doit pas dépasser les 20 MO !</p>
    		    	
			<input type="submit" value="Go Go Go !" name="submit" />
		</form>		
	</body>
</html>