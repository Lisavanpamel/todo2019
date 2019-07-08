<!DOCTYPE html>
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
        <input class="aanmeldNav" type="button" value="Aanmelden">
        <input class="registreerNav" type="button" value="Registreren">

        <!-- error -> hier komt nog php script -->
        <div class="error">
            <p>Gelieve gegevens in te geven!</p>
        </div>

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