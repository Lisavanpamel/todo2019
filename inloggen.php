<?php
// bestanden toevoegen
include_once("classes/Database.php");
include_once("classes/Gebruiker.php"); 

    if (!empty($_POST)){
        // Waarden uit tekstvelden halen
        $email = $_POST['email'];
        $wachtwoord = $_POST['wachtwoord'];

        // nieuwe instantie klasse gebruiker maken
        $gebruiker = new Gebruiker();

        // mail toevoegen aan $gebruiker
        $gebruiker->setEmail($email);

        //wachtwoord toevoegen aan $gebruiker
        $gebruiker->setWachtwoord($wachtwoord);

        //wachtwoord2 toevoegen aan $gebruiker
        // is niet nodig bij het inloggen
        //$gebruiker->setWachtwoord2($wachtwoord2);


        // controleren of beide waarden correct zijn
        // via try catch (try = proberen, catch = opvangen, exception = fouten/uitzonderingen)
        try {
            // functies uitvoeren om te kijken of gegevens van de $gebruiker correct zijn
            $gebruiker->controleerAanmelden();
            
            // functies uitvoeren om aan te melden
            // zoek gebruikersId via het gekregen email adres
            $gebruikerId = $gebruiker->zoekGebruikersIdViaEmail();

            // voeg het gekregen gebruikersid toe bij $gebruiker (de instantie van de klasse)
            $gebruiker->setGebruikersId($gebruikerId);

            // aanmelden
            $gebruiker->aanmelden();

            // naar de homepage
            echo "je ben aangemeld!";
            header("Location: index.php");

        } catch (Exception $e) {
            // toon foutmelding
            $foutmelding = $e->getMessage();
            }
    }


?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>inloggen</title>

    <!-- css style -->
    <link rel="stylesheet" href="css/style.css">

    <!-- lettertypes -->
    <link href="https://fonts.googleapis.com/css?family=Lato&display=swap" rel="stylesheet">

</head>
<body>

<section id="container">
<div class="inloggen">
    <form method="post">
        <!-- knoppen -->
        <a href="inloggen.php"><input class="aanmeldNav" type="button" value="Aanmelden"></a>
        <a href="registreren.php"><input class="registreerNav" type="button" value="Registreren"></a>

        <!-- error -->
        <?php if(isset($foutmelding) ): ?>
            <div class="error"><p>
            <?php echo $foutmelding ?></p></div>
        <?php endif; ?>
        
        <!--<div class="error">
            <p>Gelieve gegevens in te geven!</p>
        </div>-->

        <!-- email veld -->
        <div class="formuliergroep">
            <input class="formulier" type="text" name="email" placeholder="Email">
        </div>

        <!-- wachtwoord veld -->
        <div class="formuliergroep">
            <input class="formulier" type="password" name="wachtwoord" placeholder="Wachtwoord">
        </div>
        
        <!-- knop Bevestigen -->
        <div class="formuliergroep">
            <input class="knop" type="submit" value="Bevestigen">
        </div>

        <a href="#" class="wachtwoordver">Wachtwoord vergeten?</a>   
        <p class="geenAccount">Nog geen account?<a href="registreren.php" class="registreerlink"> Registreren</a></p>
    </form>

</div>
</section> 
</body>
</html>