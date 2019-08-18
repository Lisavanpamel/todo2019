<?php
// beheerder laten inloggen

// bestanden toevoegen
include_once("classes/Database.php");
include_once("classes/Gebruiker.php");

// connectie met db testen
$db = new Database(); 
$db->connecteren();

// Homepagina alleen laten tonen wanneer beheerder aangemeld is
session_start();

if (isset($_SESSION['gebruiker'])){
    $gebruiker = new Gebruiker();
    $gebruiker->setGebruikersId($_SESSION['gebruiker']);

} else {
    header('Location: inloggen.php');
}


// header toevoegen
include_once ("header.php");
?>
    
<section id="afmeting">  
    <div class="h1">
        <h1>Beheerdersscherm</h1>
    </div>
</section>