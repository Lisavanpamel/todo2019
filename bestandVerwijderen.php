<?php
// bestanden toevoegen 
include_once("classes/Database.php");
include_once("classes/Gebruiker.php");
include_once("classes/Taak.php");
include_once("classes/Lijst.php");

// sessie starten
session_start();

// taakId opvragen
$taakId = $_GET['post'];

// nieuwe taak
$taak = new Taak();
$taak->setTaakId($taakId);

try {
    $taak->verwijderBestandVanTaak();
    header("Location: index.php");
} catch (Exception $e) {
    $error = $e->getMessage();
    header("Location: index.php");
}
?>