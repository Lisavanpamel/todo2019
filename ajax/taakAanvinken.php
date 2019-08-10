<?php
// bestanden toevoegen 
include_once("../classes/Database.php");
include_once("../classes/Taak.php");

// sessie starten
session_start();

if(isset($_POST)){
    $waarde = $_POST['taakId'];
    // echo "taak id" . $waarde;

    // Nieuwe taak
    $taak = new Taak();
    $taak->setTaakId($waarde);
    $taak->setGebruikersId($_SESSION['gebruiker']);
    // echo "gebruiker" . $taak->getGebruikersId();

    try {
        $taak->taakIsGedaan();
        // feedback
        $response['status'] = 'success';
        $response['output'] = 'DONE';
    } catch (Exception $e) {
        $error = $e->getMessage();
    }
}

// geef antwoord terug
header('Content-type: application/json');
echo json_encode($response);

?>