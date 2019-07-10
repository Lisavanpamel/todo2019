<?php
// bestanden toevoegen 
include_once("classes/Database.php");
include_once("classes/Gebruiker.php"); 

// connectie met db testen
$db = new Database(); 
$db->connecteren(); 
?>


<!DOCTYPE html>
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

<section id="container">
    <!-- profiel -->
    <header>
        <div class="profiel">
            <img src="images/profiel.png" alt="profielfoto" height="42" width="42">
            <p class="naam">Lisa Van Pamel<br><a href="inloggen.php" id="uitloggen">Uitloggen</a></p>

            <!-- titel -->
            <h1>Mijn lijsten</h1>
        
        </div>
    </header>


    <div class="lijsten">
        <img src="images/profiel.png" alt="lijst" height="33" width="33">
        <p class="lijst">School</p>
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

    <!-- nieuwe lijst toevoegen -->
    <div class="knopLijst">
        <img src="images/nieuw.png" alt="foto" height="14" width="14">
        <input class="nieuweLijst" type="submit" value="Nieuwe lijst"> 
    </div>
</section>
</body>
</html>