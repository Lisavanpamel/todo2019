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

// lijstId opvragen
$lijstId = $_GET['post'];

    // lijst verwijderen
    $lijst = new Lijst();
    $lijst->setLijstId($lijstId);
    //$lijst->setGebruikersId($gebruiker);

    // Verwijder alle taken binnen de lijst
    $taak = new Taak();
    $taak->setLijstId($id);

    // Verwijder alle reacties van de taakId
    $commentaar = new Commentaar(); 
    $commentaar->setLijstId($id);

    try {
        $lijst->lijstVerwijderen();
        $taak->takenVerwijderenBijLijstId();
        $commentaar->commentaarVerwijderenVanLijstId();
        header("Location: index.php");
    } catch (Exception $e) {
        $error = $e->getMessage();
        header("Location: index.php");
    }

?>