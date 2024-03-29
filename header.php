<?php
// bestanden toevoegen
include_once("classes/Database.php");
include_once("classes/Gebruiker.php");
$gebruiker = new Gebruiker();
$gebruiker->setGebruikersId($_SESSION['gebruiker']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Do To</title>
    <!-- css style -->
    <link rel="stylesheet" href="css/style.css">
    <!-- lettertypes -->
    <link href="https://fonts.googleapis.com/css?family=Lato&display=swap" rel="stylesheet">
</head>
<body>
    <!-- profiel -->
        <header>
            <div class="profiel">
                <img src="images/profiel.png" alt="profielfoto" height="42" width="42">
                <p class="naam"><?php echo $gebruiker->zoekGebruikersNaamViaId(); ?><br><a href="uitloggen.php" id="uitloggen">Uitloggen</a></p>
            </div>
        </header>
</body>
</html>