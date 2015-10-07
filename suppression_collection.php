<?php
session_start();

require('include/connexion.php');

$bSupprimer = false;
/**
 * Vérifie si un identifiant de collection est fourni
 * et si celui-ci est bien un entier
 */
$iIdentifiant = filter_var($_GET['id'], FILTER_VALIDATE_INT);

/*
echo "le GET</br>";
var_dump($_GET['tokken']);

echo "le SESSION</br>";
var_dump($_SESSION['tokken']);

die;*/

if (isset($_GET['id']) && false !== $iIdentifiant && isset($_GET['tokken']) && $_GET['tokken'] == $_SESSION['tokken']) :
    /**
     * Supprime les ouvrages de la collection
     */
    $sRequeteSql = 'DELETE FROM ouvrage WHERE collection_id = ' . $iIdentifiant;
    $oConnexion->query($sRequeteSql);

    /**
     * Supprime la collection
     */
    $sRequeteSql = 'DELETE FROM collection WHERE id = ' . $iIdentifiant;
    $oConnexion->query($sRequeteSql);
    $bSupprimer = true;
endif;

header('Location: index.php?page=collection.php&etat_suppression=' . (int) $bSupprimer);