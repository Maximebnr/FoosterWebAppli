<?php

function TransfertImage($nomInput, $nouveauNomFichier, $chemin)
{
    /************************************************************
     * Definition des constantes / tableaux et variables
     *************************************************************/
    // Constantes
    $car = substr($chemin, -1, 1);
    if ($car <> '/')
        $chemin = $chemin . '/';
    define('REPERTOIRE', $chemin); // Repertoire cible
    define('TAILLE_MAX', 5000000); // Taille max en octets du fichier
    define('LARGEUR_MAX', 5000); // Largeur max de l'image en pixels
    define('HAUTEUR_MAX', 5000); // Hauteur max de l'image en pixels
    // Tableaux de donnees
    $tabExt = array('jpg', 'gif', 'png', 'jpeg'); // Extensions autorisees
    $infosImg = array();
    // Variables
    $extension = '';
    $message = '';
    $nomImage = '';
    /************************************************************
     * Creation du repertoire cible si inexistant
     *************************************************************/
    //var_dump($_FILES);
    if (!is_dir(REPERTOIRE)) {
        if (!mkdir(REPERTOIRE, 0755)) {
            exit('Erreur : le répertoire cible ne peut être créé ! Vérifiez que vous disposez des droits suffisants pour le faire ou créez le manuellement !');
        }
    }
    /************************************************************
     * Script d'upload
     *************************************************************/
    // On verifie si le champ est rempli
    if (!empty($_FILES["$nomInput"]['name'])) {
        // Recuperation de l'extension du fichier
        $extension = pathinfo($_FILES["$nomInput"]['name'], PATHINFO_EXTENSION);
        // On verifie l'extension du fichier
        if (in_array(strtolower($extension), $tabExt)) {
            // On recupere les dimensions du fichier
            $infosImg = getimagesize($_FILES["$nomInput"]['tmp_name']);
            // On verifie le type de l'image :
            // L'index 2 est une constante parmi IMAGETYPE_XXX (https://www.php.net/manual/fr/image.constants.php) constants, indiquant le type de l'image

            //var_dump($infosImg);
            /*Exemple : array (size=7)
 0 => int 4000
 1 => int 2248
 2 => int 2
 3 => string 'width="4000" height="2248"' (length=26)
 'bits' => int 8
 'channels' => int 3
 'mime' => string 'image/jpeg' (length=10)
 */

            if ($infosImg[2] >= 1 && $infosImg[2] <= 14) {
                // On verifie les dimensions et taille de l'image : L'index 0 contient la largeur. L'index 1 contient la hauteur.
                if (($infosImg[0] <= LARGEUR_MAX) && ($infosImg[1] <= HAUTEUR_MAX) && (filesize($_FILES["$nomInput"]['tmp_name']) <= TAILLE_MAX)) {
                    // Parcours du tableau d'erreurs
                    if (isset($_FILES["$nomInput"]['error']) && UPLOAD_ERR_OK === $_FILES["$nomInput"]['error']) {
                        // On renomme le fichier :
                        $nomImage = $nouveauNomFichier . '.' . $extension; // uniqid : Génère un identifiant unique, préfixé, basé sur la date et heure courante en microsecondes.

                        // Si c'est OK, on teste l'upload
                        if (move_uploaded_file($_FILES["$nomInput"]['tmp_name'], REPERTOIRE . $nomImage)) {
                            $message = 'Upload réussi !';
                        } else {
                            // Sinon on affiche une erreur systeme
                            $message = 'Problème lors de l\'upload !';
                        }
                    } else {
                        $message = 'Une erreur interne a empêché l\'uplaod de l\'image';
                    }
                } else {
                    // Sinon erreur sur les dimensions et taille de l'image
                    $message = 'Erreur dans les dimensions de l\'image !';
                }
            } else {
                // Sinon erreur sur le type de l'image
                $message = 'Le fichier à uploader n\'est pas une image !';
            }
        } else {
            // Sinon on affiche une erreur pour l'extension
            $message = 'L\'extension du fichier est incorrecte !';
        }
    } else {
        // Sinon on affiche une erreur pour le champ vide
        $message = 'Veuillez remplir le formulaire svp !';
    }
    return $message;
}

function EnvoiMailHtml($destinataire,$message,$sujet)
{
 $headers = "Date: ".date("r")."\n";
 $headers .='From: "La Fleur, une passion à fleur de peau"<lafleur@orange.fr>'."\n";
 $headers .= "MIME-Version: 1.0\n";
 $headers .='Reply-To: nepasrepondre@nepasrepondre.fr'."\n";
 $headers .='Content-Type: text/html; charset="utf-8"'."\n";
 $headers .= "Content-Transfer-Encoding: 8bit\n";
 $random_hash = md5(date('r', time()));
 // $headers .= "Bcc: ton-email-copie@example.com" . "\r\n";

 if(mail($destinataire, $sujet, $message, $headers))
 {
 return true;
 }
 else
 {
 return false;
 }
}
