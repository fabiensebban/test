<?php 
session_start();
require 'include/connexion.php';

/**
 * Vérification des paramètres pour l'identification
 * et identification si tout est conforme
 */
if (isset($_POST['identifier'])) {
    if (isset($_POST['identifiant']) && isset($_POST['mdp'])) {
        //Preparing the SQL query
        $sRequeteSql = 'SELECT id, identifiant, mdp FROM utilisateur WHERE identifiant = ? AND mdp = ? LIMIT 1';
        $rStat = $oConnexion->prepare($sRequeteSql);
        //Executing the query
        $rStat->execute(array($_POST['identifiant'], $_POST['mdp']));
        $aUtilisateur = $rStat->fetch(PDO::FETCH_ASSOC);

        //If the result of the query is not empty, define a session for the user
        if (!empty($aUtilisateur)) {
            $_SESSION['utilisateur'] = $aUtilisateur;
            header('Location: index.php');
            exit();
        }
    }
}

//Redirection the the error page if there's no user.
header('Location: index.php?page=identification.php&error=1');