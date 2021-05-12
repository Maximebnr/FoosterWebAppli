<?php
// CONTROLEUR FLEURS

/*require('Modeles/m_fleur.php');
require('Modeles/m_cat.php');

if (isset($_GET['a']))
    $action = $_GET['a'];
else
    $action = 'voirFleurs';

switch ($action) {

    case 'voirFleurs':

        $lesCategs = getLesCategories();

        if (isset($_GET['categ'])) {
            $lesFleurs = getLesFleursCat($_GET['categ']);
        } else {
            $lesFleurs = getLesFleurs();
        }

        include('Vues/fleurs/v_VoirFleurs.php');

        break;

    case 'gestionFleurs':

        $lesfleurs = getLesFleurs();

        // Appel de la vue
        include('Vues/fleurs/v_GestionFleurs.php');

        break;

    case 'ajoutFleurs':

        if (!isset($_POST['Ref'])) {
            $lesCat = getLesCategories();
            // Affichage de la news dans un formulaire


            $lesfleurs = getLesFleurs();

            include('Vues/fleurs/v_AjoutFleurs.php');
        } else {
            // Mise à jour du contenu de la page dans la base de données

            $resultats = setAjoutFleur($_POST['Ref'], $_POST['Desig'], $_POST['Prix'], $_POST['Photo'], $_POST['cat']);
            // Test du résultat de requête
            //if ($resultats == true)
            RechargerPage("index.php?page=fleurs&a=gestionFleurs");
            //else
            //echo "<script> alert('Erreur lors l\'ajout !'); </script>";
            //$resultats->closeCursor();
        }
        break;

    case 'modifierFleurs':

        if (!isset($_POST['Ref'])) {

            $lesCat = getLesCategories();

            // Affichage de la news dans un formulaire
            $UneFleur = getUneFleur($_GET['num']);
        } else {
            // Mise à jour du contenu de la page dans la base de données
            $resultats = setModifFleur($_POST['Desig'], $_POST['Prix'], $_POST['Photo'], $_POST['cat'], $_POST['Ref']);
            // Test du résultat de requête
            //if ($resultats == false)
            //echo "<script> alert('Erreur lors la modification !'); </script>"; 

            RechargerPage("index.php?page=fleurs&a=gestionFleurs");
        }
        include('Vues/fleurs/v_ModifierFleurs.php');

        break;

    case 'modifierFleursPhoto':

        require_once('vues/Fonctions.php');
        require_once("Modeles/m_fleur.php");
        require_once("Modeles/m_cat.php");

        if (!isset($_POST['Ref'])) {
            $lesCat = getLesCategories();
            // Affichage de la fleur dans un formulaire
            $UneFleur = getUneFleur($_GET['num']);
        } else {
            $msg = TransfertImage("Photo", $_POST['Ref'], "Public/Images/Fleurs");
            // Mise à jour du contenu dans la base de données
            $extension = pathinfo($_FILES["Photo"]['name'], PATHINFO_EXTENSION);
            if ($msg == "Upload réussi !") {
                $resultats = setModifFleurPhoto($_POST['Ref'] . "." . $extension, $_POST['Ref']);

                // Test du résultat de requête
                if ($resultats == false)
                    echo "<script> alert('Erreur lors la modification !'); </script>";
            } else {
                echo "<script> alert(<?php echo $msg; ?>); </script>";
            }

            RechargerPage("index.php?page=fleurs&a=gestionFleurs");
        }

        include('Vues/fleurs/v_ModifierFleursPhoto.php');

        break;

    case 'supprimerFleurs':

        
require_once("Modeles/m_fleur.php");
require_once("Modeles/m_cat.php");

if (!isset($_POST['Ref'])) {
	// Affichage de la fleur dans un formulaire
	$UneFleur = getUneFleur($_GET['num']);
} else {
	// Mise à jour du contenu de la page dans la base de données

	$resultats = setSupprimerFleur($_POST['Ref']);

	// Test du résultat de requête
	//if ($resultats == true)
	RechargerPage("index.php?page=fleurs&a=gestionFleurs");
	//else
	//echo "<script> alert('Erreur lors la suppression !'); </script>";
	//$resultats->closeCursor();
}
include('Vues/fleurs/v_SupprimerFleurs.php');

break;
}
*/