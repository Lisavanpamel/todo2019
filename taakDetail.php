<?php
// bestanden toevoegen 
include_once("classes/Database.php");
include_once("classes/Gebruiker.php");
include_once("classes/Taak.php");
include_once("classes/Commentaar.php");


// Sessie starten
session_start();

    if (isset($_POST['knopCommentaar'])){
        if (empty($_POST['reactie'])){
            // anders foutmelding
            $foutmelding = "Gelieve een reactie te schrijven."; 
        } else {
        $reactie = $_POST['reactie'];

        // gebruikersId ophalen
        $gebruiker = new Gebruiker();
        $gebruiker->setGebruikersnaam($_SESSION['gebruiker']);
        $gebruikersId = $gebruiker->getGebruikersId();

        // taakId ophalen
        // te doen

        }
    }


// header toevoegen
include_once ("header.php");
?>

<section id="afmeting">  
    <div class="h1T">
        <h1>Reacties</h1>
    </div>            


    <form method="post">
        <!-- foutmelding -->
        <?php if(isset($foutmelding) ): ?>
            <div class="error"><p>
        <?php echo $foutmelding ?></p></div>
        <?php endif; ?>

        <!-- commentaar weergeven -->
        <!-- te doen -->

        <textarea class="reactie" maxlength="150" name="reactie" placeholder="Voeg een reactie toe!"></textarea>

        <!-- BUTTON: commentaar toevoegen -->
        <div class="formuliergroep">
            <input class="nieuweTaak" type="submit" value="Voeg commentaar toe" name="knopCommentaar">
        </div>

        <!-- terugknop -->
        <div class="terugKnop">
            <a href="taken.php?lijst=1" class="knopTer">Terug</a>
        </div>    
    </form>
</section>

<?php 
// footer
include_once("footer.php"); 
?>