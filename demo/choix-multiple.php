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
                <input type="checkbox" name="choix[]" value="V" <?php if(isset($_POST['choix']) and is_array($_POST['choix']) and in_array("V", $_POST['choix'])) echo 'checked="checked"'; ?>/>
                Vert
                <input type="checkbox" name="choix[]" value="B" <?php if(isset($_POST['choix']) and is_array($_POST['choix']) and in_array("B", $_POST['choix'])) echo 'checked="checked"'; ?>/>
                Blanc
                <input type="checkbox" name="choix[]" value="R" <?php if(isset($_POST['choix']) and is_array($_POST['choix']) and in_array("R", $_POST['choix'])) echo 'checked="checked"'; ?>/>
                Rouge
                <input type="submit" name="submit" />          
        </form>
        <?php
            //Si pas de formulaire envoyé, on stoppe.
            if(empty($_POST))
                exit("</body></html>"); 
            
            //Si aucune case cochée
            if(empty($_POST['choix']))
                 exit ("<h1>Choisir au moins une couleur !</h1></body></html>");

            //Initialisation de la variable de réponse
            $couleurs_choisies = "";
            
            /* Parcours le tableau des cases cochées 
             * et incrémente la réponse avec la valeur de la case */                 
            foreach ($_POST['choix'] as $couleur) {
                $couleurs_choisies .=$couleur."&nbsp;";
            }
            
            //Affiche la réponse, le choix de l'utilisateur
            echo "<h1>Votre choix : $couleurs_choisies</h1>";
        ?>
    </body>
</html>