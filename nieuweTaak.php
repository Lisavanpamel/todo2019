<?php
// header toevoegen
include_once ("header.php");
?>

<section id="afmeting">  
    <div class="h1T">
        <h1>Nieuwe taak</h1>
    </div>            

    <!-- (nieuwe) taak toevoegen -->
    <form method="post">
        <!-- foutmelding -->
        <?php if(isset($foutmelding) ): ?>
            <div class="error"><p>
        <?php echo $foutmelding ?></p></div>
        <?php endif; ?>

        <!-- naam taak veld -->
        <div class="formuliergroep">
            <input class="formulier" type="text" name="TaakNaam" placeholder="Naam taak">
        </div>

        <!-- werkuren -->
        <div class="formuliergroep">
            <input class="formulier" type="text" name="werkuren" placeholder="Werkuren">
        </div>

        <!-- deadline -->
        <div class="formuliergroep">
            <input class="formulier" type="text" name="deadline" placeholder="Deadline (JJJJ-mm-dd)">
        </div>

        <!-- BUTTON: nieuwe taak toevoegen -->
        <div class="formuliergroep">
            <img src="images/nieuw.png" alt="foto" height="14" width="14">
            <input class="nieuweTaak" type="submit" value="Nieuwe Taak" name="KnopTaak">
        </div>

        <!-- terugknop -->
        <div class="terugKnop">
            <a href="index.php" class="knopTer">Terug</a>
        </div>    
    </form>

             
        
    <?php
        // taken uit database halen
        // taken laten tonen op nieuweTaak.php
        /*$taak = new Taak();
        $lijst->setGebruikersId($_SESSION['gebruiker']);
        $lijst->toonTaken();*/
    ?>
</section>

<?php 
// footer
include_once("footer.php"); 
?>