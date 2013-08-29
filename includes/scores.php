<?php
/**
 * Fonctions pour la gestion de la table de scores et des screenshot
 * 
 * @author    	Steve Fallet <steve.fallet@divtec.ch>
 * @copyright	2013 - EMT Porrentruy
 * @version		12.05.2013 * 
 */

/**
* Sélectionne un score dans la BD et retourne ses données
*
* @param    boolean     Faut-il afficher les score invalides, par défaut non
* @param    string      Tri de la requête, par défaut score >, date <
* @return   array       Tableau associatif contenant les données du score, ou false
*/
function score_liste($afficher_invalides=false,$tri="score DESC, date ASC")
{
    $cnx = bd_connexion();    
 
    $requete = "SELECT * FROM score";
    
    if($afficher_invalides==false) 
        $requete .=" WHERE valider = 1"; 
    
    $requete .=" ORDER BY $tri";
         
    $res = bd_requete($cnx, $requete);
    
    bd_ferme($cnx);    
   
    return $res;
}

/**
* Sélectionne un score dans la BD et retourne ses données
*
* @param	int		Id du score
* @return	array	Tableau associatif contenant les données du score, ou false
*/
function score_charger($id)
{
	$cnx = bd_connexion();
	
	$requete = "SELECT * FROM score
				WHERE id = $id
				LIMIT 1"; 
			
	$res = bd_requete($cnx, $requete);
	
	bd_ferme($cnx);
	
	//Si un résultat a été trouvé, on le retourne
	if(mysqli_num_rows($res))
		return mysqli_fetch_assoc($res);
	
	return false;
}
 
/**
* Controle les données du score
*
* @param	array	Données du score, généralement la superglobale $_POST
* @return	array	Liste des erreurs
*/
function score_controle($tab_score)
{
	//Initialisation du tableau des erreurs
	$erreurs = array();	
	
	//Nom du joueur
	if(!isset($tab_score['nom']) or strlen($tab_score['nom']) < 4)
		$erreurs[] = 'Entrez un login valide ! Le login doit contenir au moins 4 caractères !';
	
	//Score
	if(!isset($tab_score['score']) or !is_numeric($tab_score['score']))
		$erreurs[] = 'Entrez un score valide !';
	
	//Si aucun fichier a été envoyé ou qu'il y a eu une erreur de transfert
	if(!isset($_FILES['screenshot']) or $_FILES['screenshot']['error'])
	{
		$erreurs[] = 'Aucun screenshot reçu ! Sélectionner une image valide !';
		return $erreurs; //on s'arrête la car les autres tests portent uniquement sur le fichier uploadé
	}

    //Liste des extensions valides
    $upload_extensions_valides = array( 'jpg' , 'jpeg', 'png' ); 
    //Extension du fichier uploadé
    $upload_extension = pathinfo($_FILES['screenshot']['name'], PATHINFO_EXTENSION);
             
    //Si extension pas valide
    if(!in_array($upload_extension,$upload_extensions_valides))
		$erreurs[] = 'Votre screenshot n\'est pas valide !';
	
	return $erreurs;
}

/**
* Ajoute un score dans la base de données 
*
* @param	array	Données du score, généralement la superglobale $_POST
* @return	int		l'id de l'enregistrement créé, 0 si erreur
*/
function score_ajouter($tab_score)
{
	//Génération d'un identifiant unique pour le nom du screenshot. Nom préfixé de "photo_"
    $screenshot = uniqid('photo_').".".pathinfo($_FILES['screenshot']['name'], PATHINFO_EXTENSION); 
    
    //Copie du screenshot dans le dossier images. 
    //Si erreur de transfert on retourne 0
	if(!move_uploaded_file($_FILES['screenshot']['tmp_name'], UPLOAD_PHOTOS.$screenshot))
        return 0;
    
	$cnx = bd_connexion();
    	
	//Préparation des données : cast, échappement
	$score 		= (int) $tab_score['score']; //Cast en entier
	$nom 		= mysqli_real_escape_string($cnx, $tab_score['nom']);
	
	$req = "INSERT INTO score VALUES 
	       (0, NOW(), '$nom', $score,'$screenshot',0)";
	bd_requete($cnx, $req);
	
	//Récupère l'id du denier enregistrement
	//ou 0 si erreur
	$id = mysqli_insert_id($cnx);        
	
	bd_ferme($cnx);
	
	return $id;
}

/**
* Valide un score dans la base de données 
*
* @param	int		Id du score à valider
* @return	int		le nombre d'enregistrements modifiés
*/
function score_valider($id)
{
	$cnx = bd_connexion();
	
	$req = "   UPDATE score SET valider = 1
	           WHERE id = $id
	           LIMIT 1";
	
	bd_requete($cnx, $req);
	
	$res = mysqli_affected_rows($cnx);
	
	bd_ferme($cnx);

	return $res;
}

/**
* Supprime un score dans la base de données 
*
* @param	int		Id du score à supprimer
* @return	int		le nombre d'enregistrements supprimés
*/
function score_supprimer($id)
{        		
	$cnx = bd_connexion();
    
    //Récupération du nom de fichier du screenshot à supprimer
    $score = score_charger($id);    
    $screenshot = $score['screenshot'];
	
	//Suppression du score dans la BD
	$requete = "DELETE FROM score WHERE id = $id LIMIT 1";			
	bd_requete($cnx, $requete);
	
	$res = mysqli_affected_rows($cnx);
    
    //Si la suppression est ok, et que le fichier screenshot existe, on le supprime
	if($res and !empty($screenshot) and is_file(UPLOAD_PHOTOS.$screenshot))                               
       @unlink(UPLOAD_PHOTOS.$screenshot);
   
	bd_ferme($cnx);
	
    //Retourne le nombre de résultats supprimés
	return $res;
}




