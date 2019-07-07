<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>inloggen</title>

    <!-- css style -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<section id="container">
<div class="inloggen">
    <form method="post">
        <!-- knoppen -->
        <input type="button" value="Aanmelden">
        <input type="button" value="Registreren">

        <!-- email veld -->
        <div class="formuliergroep">
            <input class="formulier" type="text" name="email" placeholder="Email">
        </div>

        <!-- wachtwoord veld -->
        <div class="formuliergroep">
            <input class="formulier" type="text" name="wachtwoord" placeholder="Wachtwoord">
        </div>
        
        <!-- knop Bevestigen -->
        <div class="formuliergroep">
            <input class="knop" type="submit" value="Bevestigen">
        </div>

        <a href="#" class="wachtwoordver">Wachtwoord vergeten?</a>    
        <a href="#" class="registreerlink">Nog geen account? <span>Registreren</span></a>
    </form>

</div>
</section> 
</body>
</html>