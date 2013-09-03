<?php
/**
 * Fonctions pour la gestion de la table des pays
 * 
 * @author    	Steve Fallet <steve.fallet@divtec.ch>
 * @copyright	2013 - EMT Porrentruy
 * @version		03.09.2013 * 
 */

/**
* Retourne la liste des pays
*
* @param    boolean     Faut-il afficher les score invalides, par défaut non
* @param    string      Tri de la requête, par défaut score >, date <
* @return   array       Tableau associatif contenant les données du score, ou false
*/
function pays_liste($tri="libelle ASC")
{
    $cnx = bd_connexion();    
 
    $requete = "SELECT * FROM pays";
    
    $requete .=" ORDER BY $tri";
         
    $res = bd_requete($cnx, $requete);
    
    bd_ferme($cnx); 
   
    return $res;
}
