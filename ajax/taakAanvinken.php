<?php
// bestanden toevoegen 
include_once("../classes/Database.php");
include_once("../classes/Gebruiker.php");
include_once("../classes/Taak.php");

// sessie starten
session_start();

if(isset($_POST)){
    $waarde = $_POST['taakId'];

    // Nieuwe taak
    $taak = new Taak();
    $taak->setTaakId($waarde);
    $taak->setGebruikersId($gebruikersId);

    // nieuwe gebruiker toevoegen
	$gebruiker = new Gebruiker();

    try {
        $taak->taakIsGedaan();
    } catch (Exception $e) {
        $foutmelding = $e->getMessage();
    }
}

?>