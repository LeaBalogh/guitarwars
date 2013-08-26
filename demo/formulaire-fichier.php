<?php
//Désactive l'affichage des notices
error_reporting(E_ALL ^ E_NOTICE);
?><!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="UTF-8">
		<title>PHP - Envoyer un fichier</title>
	</head>
	<body>
		<h1>PHP - Envoyer un fichier</h1>
		<form enctype="multipart/form-data" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <input type="hidden" name="MAX_FILE_SIZE" value="2097152" /> <!-- 2MO -->
            <!-- La limite est également fixée dans php.ini par : upload_max_filesize -->
			<p>
                <label for="fichier">Fichier à envoyer sur le serveur :</label>    		
                <input type="file" id="fichier" name="fichier" />
            </p>
			<p><input type="submit" value="Uploader le fichier" name="submit" /></p>
		</form>
        <?php
		//Si données de formulaire reçues
		if($_POST)
        {
			//Paramètres
			$extensions_valides = array( 'jpg' , 'jpeg', 'png' );    
            $taille_max = 2097152; //2 M 
            $dossier_images = "images/toto/titi/2/";  
                
			//Affiche les infos du fichier reçu    		
			var_dump($_FILES);
		
    		//Si erreur d'envoi
    		if ($_FILES['fichier']['error'] > 0) 
    			exit ("Erreur lors du transfert !<br/>Code erreur : ".$_FILES['fichier']['error']);
    		
    		//Récupère l'extension du fichier uploader
    		$extension_upload = pathinfo($_FILES['fichier']['name'], PATHINFO_EXTENSION);
    		
    		//Récupéer l'extension du fichier, variante avec substr
    		//$extension_upload = strtolower(  substr(  strrchr($_FILES['fichier']['name'], '.')  ,1)  );
    		//1. strrchr renvoie l'extension avec le point (« . »).
    		//2. substr(chaine,1) ignore le premier caractère de chaine.
    		//3. strtolower met l'extension en minuscules.
    		
    		//Si extension valide
    		if(!in_array($extension_upload,$extensions_valides))
    			exit("Extension non-autorisée !");
    
    		//Si taille valide
    		if($_FILES['fichier']['size'] > $taille_max)
    			exit("<p>Fichier trop volumineux !</p>");		

    		//Nom du fichier     
            $fichier_nom = $dossier_images.uniqid('photo_').".".$extension_upload;
            
            //Si dossier existant
            if(!file_exists($dossier_images))
                mkdir($dossier_images,777,true);
        
            //Transfert du fichier temporaire
            if(!move_uploaded_file($_FILES['fichier']['tmp_name'],$fichier_nom))
            exit("Transfert impossible pour l'instant !");
            
            //Message de confirmation
            echo "<h1>Fichier transféré avec succès !</h1>";
            
            //On affiche l'image transférée
            echo '<img src="'.$fichier_nom.'" alt="photo"/>';
		}// fin if($_POST)
		
		?>		
	</body>
</html>