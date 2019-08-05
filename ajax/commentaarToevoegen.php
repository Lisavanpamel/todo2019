<?php
// bestanden toevoegen 
include_once("../classes/Database.php");
include_once("../classes/Gebruiker.php");
include_once("../classes/Taak.php");
include_once("../classes/Commentaar.php");

// sessie starten
session_start();

if(!empty($_POST)){

    // Toevoegen aan database
    $commentaar = new Commentaar();
    $commentaar->setReactie();
    $commentaar->setGebruikersId();
    $commentaar->setTaakId();

    // haalt de lijst-ID van taak op
    $taak = new Taak();
    $taak->setTaakId();

    try {
        $commentaar->voegNieuwCommentaarToe();
    } catch (Exception $e) {
        $foutmelding = $e->getMessage();
    }
}

?>