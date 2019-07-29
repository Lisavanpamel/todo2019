<?php
// bestanden toevoegen 
include_once("classes/Database.php");
include_once("classes/Gebruiker.php");
include_once("classes/Lijst.php");

// connectie met db testen
$db = new Database(); 
$db->connecteren();

// Homepagina alleen laten tonen wanneer gebruiker aangemeld is
// werken met sessions
// sessie starten met session_start()
session_start();

// we controleren of deze sessie de juiste sessie is
// bij het inloggen noemen we onze session $_SESSION['gebruiker] en geven we de gebruiker id mee;
if (isset($_SESSION['gebruiker'])){
    // nieuwe instantie maken van de klasse Gebruiker
    // aan deze instantie gaan we de gebruikers id toevoegen
    $gebruiker = new Gebruiker();
    $gebruiker->setGebruikersId($_SESSION['gebruiker']);

} else {
    // er is nog geen sessie opgestart, de gebruiker moet zich nog inloggen en mag deze pagina niet zien
    // we veranderen van locatie en gaan naar de pagina inloggen.php
    header('Location: inloggen.php');
}


// header toevoegen
include_once ("header.php");
?>
    
<section id="afmeting">  
    <div class="h1">
        <h1>Mijn lijsten</h1>
    </div>

    <!-- lijsten uit database halen -->
    <!-- Hiermee lijsten laten tonen op index.php -->
    <?php
        $lijst = new Lijst();
        $lijst->setGebruikersId($_SESSION['gebruiker']);
        $lijst->toonLijsten();
    ?>

    <!-- BUTTON: nieuwe lijst toevoegen -->
    <div class="knopLijst">
    <img src="images/nieuw.png" alt="foto" height="14" width="14">
        <a href="nieuweLijst.php">Nieuwe lijst</a>
        <!--<img src="images/nieuw.png" alt="foto" height="14" width="14">
        <input class="nieuweLijst" type="submit" value="Nieuwe lijst">-->
    </div>
</section>