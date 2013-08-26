<?php
/**
 * Fonctions base de données 
 * 
 * @author    	Steve Fallet <steve.fallet@divtec.ch>
 * @copyright	2013 - EMT Porrentruy
 * @version		15.05.2013
 */
 
 
/**
* Ouvre et retourne une connexion à la BD avec gestion des erreurs
*
* @return	object connexion à la base de données
*/
function bd_connexion()
{
	//Connexion à la BD
	$cnx = mysqli_connect(BD_SERVEUR, BD_UTILISATEUR, BD_MDP, BD_BASE)
		or die('<p>Erreur de connexion !</p>');
		
	//Définit le jeux de caractères de la connexion
	mysqli_set_charset($cnx,BD_CHARSET);
	
	//Retourne la connexion
	return $cnx;	
}

/**
* Ferme la connexion passée en paramètre
*
* @param	object	Connexion à la base de données
*/
function bd_ferme($cnx)
{
	mysqli_close($cnx);
}


/**
* Exécute et retourne le résultat d'une requête
*
* @param	object	Connexion à la base de données
* @param	string	Requête SQL
* @return	object	Résultat MySQL
*/
function bd_requete($cnx, $requete)
{
	//Exécution de la requête
	$cnx = mysqli_query($cnx, $requete)
		or die('<p>Erreur lors de l\'envoi de la requête !</p>');
	
	return $cnx;
}

/**
* Retourne un tableau HTML contenant le résultat d'une requête
*
* @param	object	Connexion à la base de données
* @param	string	Requête SQL
* @return	string	code HTML
*/
function bd_affiche_requete($cnx, $requete)
{
	//Exécution de la requête
	$resultat = bd_requete($cnx, $requete);
	$nombre_colonnes = mysqli_num_fields($resultat);
	
	//Début du tableau HTML
	echo '<table><tbody>';

	//Appel la fonction mysqli_fetch tant qu'elle retourne un résultat
	while($ligne = mysqli_fetch_array($resultat))
	{
		echo '<tr>';	
		
		for ($i = 0; $i < $nombre_colonnes ; $i++)
			echo '<td>'.$ligne[$i].'</td>';
			
		echo '</tr>';
	}	
	
	//Fin du tableau HTML
	echo '</tbody></table>';
}