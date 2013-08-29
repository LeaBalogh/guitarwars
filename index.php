<?php
//Inclusion des librairies
require_once(__DIR__.'/includes/utils.php');
?><!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="UTF-8">
		<title>Meilleurs scores | Guitar Wars</title>
		<link rel="stylesheet" type="text/css" href="style.css" />
	</head>
	<body>
		<h1>Guitar Wars - Meilleurs scores !</h1>
		<p>Hé Guitar Warrior, es-tu le maître absolu de Guitar Wars ?</p>
		<p>Pour le savoir <a href="score-ajouter.php">ajoute ton score</a>.</p>
		<?php

		//Message de confirmation ou d'erreur 
		if(isset($_GET['message']))
			echo '<p>'.$_GET['message'].'</p>';
		
		//Récupère la liste des scores
		$res = score_liste();
		
		//Si aucun résultat
		if(mysqli_num_rows($res) < 1)
			exit("<p>Acun résultats</p></body></html>");
		?>		
		<table>
			<caption>Classement mondial Guitar Wars</caption>
			<tr>
				<th colspan="2">Score</th>
				<th>Nom</th>
				<th>Date</th>
			</tr>
		<?php
		//Charge la 1re ligne du résultat
		$ligne = mysqli_fetch_array($res);
        
        //Affiche le TOP Score (1re ligne)
        echo '<tr><td colspan="4" class="topscore">Top score ' . $ligne['score'] . ' pts</td></tr>';
		
		// Parcours le résultat MySQL et construit le tableau HTML
		do {     			 	
			
			//Test si un screenshot existe pour ce résultat
			//Ne pas utiliser file_exists() car si pas de nom d'image 
			//on testera le nom du dossier et il existe donc la fonction retournera VRAI
			if (!empty($ligne['screenshot']) and is_file(UPLOAD_PHOTOS.$ligne['screenshot'])) 
				$url_screenshot = SITE_IMAGES.$ligne['screenshot'];
			else //Sinon s'il n'existe pas on met une image par défaut
				$url_screenshot = SITE_IMAGES.'unverified.gif';
		?>	
			<tr>
				<td><img src="<?php echo $url_screenshot; ?>" class="screenshot" alt="screenshot" /></td>
				<td><?php echo $ligne['score']; ?></td>
				<td><?php echo $ligne['nom']; ?></td>
				<td><?php echo $ligne['date']; ?></td>
			</tr>	
		
		<?php
        } while ($ligne = mysqli_fetch_array($res));

		?>
		</table>
	</body>
</html>