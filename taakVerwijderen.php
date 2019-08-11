<?php
// bestanden toevoegen 
include_once("classes/Database.php");
include_once("classes/Taak.php");
include_once("classes/Gebruiker.php");
include_once("classes/Commentaar.php");

// sessie starten
session_start();

// gebruikersId opvragen
$gebruiker = new Gebruiker();
$gebruiker->setGebruikersId($_SESSION['gebruiker']);

// taakId opvragen
$taakId = $_GET['post'];

    // taak verwijderen
    $taak = new Taak();
    $taak->setTaakId($taakId);
    $taak->setGebruikersId($gebruiker);

    // commentaar verwijderen van de taak
    $commentaar = new Commentaar();
    $commentaar->setTaakId($taakId);

    try {
        $taak->taakVerwijderen();
        $commentaar->CommentaarVerwijderenVanTaakId();
        header("Location: index.php");
    } catch (Exception $e) {
        $error = $e->getMessage();
        header("Location: index.php");
    }

?>