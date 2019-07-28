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


?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ToDo</title>
    
    <!-- css style -->
    <link rel="stylesheet" href="css/style.css">

    <!-- lettertypes -->
    <link href="https://fonts.googleapis.com/css?family=Lato&display=swap" rel="stylesheet">

</head>
<body>

    <!-- lijsten uit database halen -->
    <?php
        $lijst = new Lijst();
        $lijst->setGebruikersId($_SESSION['gebruiker']);
        $lijst->toonLijsten();
    ?>


<section id="container"> 
    <!-- profiel -->
    <header>
        <div class="profiel">
            <img src="images/profiel.png" alt="profielfoto" height="42" width="42">
            <p class="naam">Lisa Van Pamel<br><a href="uitloggen.php" id="uitloggen">Uitloggen</a></p>

            <!-- titel -->
            <h1>Mijn lijsten</h1>
        
        </div>
    </header>

    <!-- lijsten -->
    <div class="lijsten"><a href="inloggen.php">
        <img src="images/profiel.png" alt="lijst" height="33" width="33">
        <p class="lijst">School</p></a>
        <img src="images/verwijder.png" class="verwijder" alt="lijst" height="33" width="33">
    </div>

    <div class="lijsten">
        <img src="images/profiel.png" alt="lijst" height="33" width="33">
        <p class="lijst">Vakantie</p>
        <img src="images/verwijder.png" class="verwijder" alt="lijst" height="33" width="33">
    </div>

    <div class="lijsten">
        <img src="images/profiel.png" alt="lijst" height="33" width="33">
        <p class="lijst">Familie</p>
        <img src="images/verwijder.png" class="verwijder" alt="lijst" height="33" width="33">
    </div>

    <div class="lijsten">
        <img src="images/profiel.png" alt="lijst" height="33" width="33">
        <p class="lijst">Persoonlijk</p>
        <img src="images/verwijder.png" class="verwijder" alt="lijst" height="33" width="33">
    </div>

    <!-- BUTTON: nieuwe lijst toevoegen -->
    <div class="knopLijst">
        <a href="nieuweLijst.php">Nieuwe lijst</a>
        <!--<img src="images/nieuw.png" alt="foto" height="14" width="14">
        <input class="nieuweLijst" type="submit" value="Nieuwe lijst">-->
    </div>
</section>
</body>
</html>