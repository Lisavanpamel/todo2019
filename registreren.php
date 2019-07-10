<?php
// bestanden toevoegen 
include_once("classes/Database.php");
include_once("classes/Gebruiker.php");


if (!empty($_POST)){
    // foute ingeving gegevens
    if (empty($_POST['email'])){
        $error = "Gelieve een e-mailadres in te voeren."; 
    } else if (empty($_POST['wachtwoord'])){
        $error = "Gelieve een wachtwoord(en) in te geven."; 
    } else if (empty($_POST['wachtwoord2'])){
        $error = "Herhaal je wachtwoord alstublieft."; 
    } else {
        // waarden toevoegen aan variabelen
        $mail = $_POST['email'];
        $wachtwoord = $_POST['wachtwoord'];
        $wachtwoord2 = $_POST['wachtwoord2'];
        
        $beheerderValue = 0;
        
            try {
                // Nieuwe gebruiker maken 
                $gebruiker = new Gebruiker;
                $gebruiker->setBeheerder($beheerderValue); 
                $gebruiker->setBeheerderId(0); 
    
                // wijs waarden toe aan de gebruiker
                $gebruiker->setEmail($email); 
                $gebruiker->setWachtwoord($wachtwoord);
                $gebruiker->setWachtwoord2($wachtwoord2);
    
                try {
                    // Sterk wachwoord -> meer dan 8 tekens
                    $gebruiker->sterkWachtwoord(); 
    
                    // controleer wachtwoorden
                    $user->controleerWachtwoord();
    
                    // check register
                    $user->checkRegistreren();
    
                    // hash password
                    $hashed = $user->hashWachtwoord();
                    $user->setHash($hashed);
                                
                    // registreren
                    $user->registreren();
                    header('Location: inloggen.php'); 
    
                } catch (Exception $e){
                    // error
                    $error = $e->getMessage();
                }
    
            } catch (Exception $e){
                // error
                $error = $e->getMessage();        
            }
        }    
    
}



// Als tekstvelden niet leeg zijn
/*if(!empty($_POST)) {
    try {
        $gebruiker = new Gebruiker();
        $gebruiker->setEmail($_POST['email']);
        $gebruiker->setWachtwoord($_POST['wachtwoord']);
        $gebruiker->setWachtwoord2($_POST['wachtwoord2']);
        if($gebruiker->register()){
            session_start();
            $_SESSION['email'] = $gebruiker->getEmail();
            header('location: index.php');
        }
        }
        catch (Exception $e) {
            $message = $e->getMessage();
        }
    }*/


?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>registreren</title>

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
        <a href="inloggen.php"><input class="aanmeldNav2" type="button" value="Aanmelden"></a>
        <a href="registreren.php"><input class="registreerNav2" type="button" value="Registreren"></a>

        <!-- error -->
        <?php if(isset($error) ): ?>
            <div class="error"><p>
            <?php echo $error ?></p></div>
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

        <!-- bevestig wachtwoord veld -->
        <div class="formuliergroep">
            <input class="formulier" type="password" name="wachtwoord2" placeholder="Bevestig wachtwoord">
        </div>
        
        <!-- knop Bevestigen -->
        <div class="formuliergroep">
            <input class="knop" type="submit" value="Account Bevestigen">
        </div>

        <a href="#" class="wachtwoordver">Wachtwoord vergeten?</a>   
        <p class="geenAccount">Heb je al een account?<a href="inloggen.php" class="inloglink"> Aanmelden</a></p>
    </form>

</div>
</section> 
</body>
</html>